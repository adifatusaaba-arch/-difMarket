<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DifMarketTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
        $this->seed();
    }

    public function test_public_pages_render_successfully_with_seeded_data(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('@difMarket')
            ->assertSee('Keripik Tempe Renyah Daun Jeruk');

        $this->get(route('products.index'))
            ->assertOk()
            ->assertSee('Jelajahi Produk UMKM');

        $product = Product::firstOrFail();
        $this->get(route('products.show', $product->slug))
            ->assertOk()
            ->assertSee($product->name)
            ->assertSee('Hubungi Penjual via WhatsApp');

        $category = Category::firstOrFail();
        $this->get(route('categories.index'))
            ->assertOk()
            ->assertSee($category->name);

        $this->get(route('categories.show', $category->slug))
            ->assertOk()
            ->assertSee($category->name);

        $this->get(route('about'))
            ->assertOk()
            ->assertSee('Visi @difMarket');

        $this->get(route('contact'))
            ->assertOk()
            ->assertSee('Kirim Pesan kepada Kami');
    }

    public function test_product_search_and_category_filter_work(): void
    {
        $this->get(route('products.index', ['q' => 'Arabika Gayo']))
            ->assertOk()
            ->assertSee('Kopi Arabika Gayo Honey Roast 250g')
            ->assertDontSee('Keripik Tempe Renyah Daun Jeruk');

        $this->get(route('products.index', ['kategori' => 'fashion-batik']))
            ->assertOk()
            ->assertSee('Kemeja Batik Tulis Modern Parang')
            ->assertDontSee('Kopi Arabika Gayo Honey Roast 250g');
    }

    public function test_eloquent_category_product_relationship(): void
    {
        $category = Category::with('products')->where('slug', 'kuliner-camilan')->firstOrFail();

        $this->assertGreaterThanOrEqual(2, $category->products->count());
        $this->assertSame($category->id, $category->products->first()->category->id);
    }

    public function test_contact_form_validates_and_saves_message(): void
    {
        $this->post(route('contact.send'), [
            'name' => '',
            'email' => 'bukan-email',
            'subject' => '',
            'message' => 'pendek',
        ])->assertSessionHasErrors(['name', 'email', 'subject', 'message']);

        $this->post(route('contact.send'), [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'phone' => '08123456789',
            'subject' => 'Kemitraan UMKM',
            'message' => 'Saya ingin mendaftarkan produk kerajinan bambu ke @difMarket.',
        ])->assertRedirect(route('contact'));

        $this->assertDatabaseHas('contact_messages', [
            'email' => 'budi@example.com',
            'subject' => 'Kemitraan UMKM',
        ]);
    }

    public function test_admin_routes_require_authenticated_admin_user(): void
    {
        $this->get(route('admin.dashboard'))->assertRedirect(route('admin.login'));

        $regularUser = User::factory()->create([
            'password' => Hash::make('secret123'),
            'is_admin' => false,
        ]);

        $this->actingAs($regularUser)
            ->get(route('admin.dashboard'))
            ->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_login_and_logout(): void
    {
        $this->post(route('admin.login.submit'), [
            'email' => 'admin@difmarket.id',
            'password' => 'password123',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticated();

        $this->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Dashboard Statistik');

        $this->post(route('admin.logout'))
            ->assertRedirect(route('admin.login'));

        $this->assertGuest();
    }

    public function test_admin_can_crud_product_with_image_upload_replacement_and_deletion(): void
    {
        $admin = User::where('email', 'admin@difmarket.id')->firstOrFail();
        $category = Category::firstOrFail();

        $this->actingAs($admin);

        // Validation check (missing required fields & invalid file)
        $this->post(route('admin.products.store'), [
            'name' => '',
            'price' => 'bukan-angka',
        ])->assertSessionHasErrors(['category_id', 'name', 'description', 'price', 'image']);

        // Create product with image
        $firstImage = UploadedFile::fake()->image('produk-pertama.png', 600, 600);
        $this->post(route('admin.products.store'), [
            'category_id' => $category->id,
            'name' => 'Gula Aren Organik Semut',
            'description' => 'Gula aren murni produksi petani lokal Jawa Barat.',
            'price' => 32000,
            'stock' => 25,
            'image' => $firstImage,
        ])->assertRedirect(route('admin.products.index'));

        $product = Product::where('slug', 'gula-aren-organik-semut')->firstOrFail();
        $oldImagePath = $product->image;
        Storage::disk('public')->assertExists($oldImagePath);

        // Update product with new image -> old image must be deleted
        $newImage = UploadedFile::fake()->image('produk-kedua.webp', 600, 600);
        $this->put(route('admin.products.update', $product), [
            'category_id' => $category->id,
            'name' => 'Gula Aren Organik Premium',
            'description' => 'Gula aren murni kemasan pouch 500 gram kualitas ekspor.',
            'price' => 38000,
            'stock' => 30,
            'image' => $newImage,
        ])->assertRedirect(route('admin.products.index'));

        $product->refresh();
        $this->assertSame('Gula Aren Organik Premium', $product->name);
        $this->assertNotSame($oldImagePath, $product->image);
        Storage::disk('public')->assertMissing($oldImagePath);
        Storage::disk('public')->assertExists($product->image);

        // Delete product -> image must be removed from storage
        $imageToDelete = $product->image;
        $this->delete(route('admin.products.destroy', $product))
            ->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        Storage::disk('public')->assertMissing($imageToDelete);
    }

    public function test_admin_can_crud_category(): void
    {
        $admin = User::where('email', 'admin@difmarket.id')->firstOrFail();
        $this->actingAs($admin);

        // Create
        $this->post(route('admin.categories.store'), [
            'name' => 'Aksesoris & Souvenir',
            'description' => 'Beragam souvenir pernikahan dan aksesoris lokal.',
        ])->assertRedirect(route('admin.categories.index'));

        $category = Category::where('slug', 'aksesoris-souvenir')->firstOrFail();

        // Update
        $this->put(route('admin.categories.update', $category), [
            'name' => 'Souvenir & Hadiah',
            'description' => 'Paket hampers dan souvenir UMKM.',
        ])->assertRedirect(route('admin.categories.index'));

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Souvenir & Hadiah',
            'slug' => 'souvenir-hadiah',
        ]);

        // Delete
        $this->delete(route('admin.categories.destroy', $category))
            ->assertRedirect(route('admin.categories.index'));

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
