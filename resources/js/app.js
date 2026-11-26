document.addEventListener('DOMContentLoaded', () => {
    // Toggle menu navigasi mobile (publik)
    const mobileMenuButton = document.querySelector('[data-mobile-menu-toggle]');
    const mobileMenu = document.querySelector('[data-mobile-menu]');
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            const isExpanded = !mobileMenu.classList.contains('hidden');
            mobileMenuButton.setAttribute('aria-expanded', String(isExpanded));
        });
    }

    // Toggle sidebar mobile (admin)
    const adminSidebarToggle = document.querySelector('[data-admin-sidebar-toggle]');
    const adminSidebar = document.querySelector('[data-admin-sidebar]');
    const adminBackdrop = document.querySelector('[data-admin-backdrop]');
    const toggleAdminSidebar = (forceClose = false) => {
        if (!adminSidebar || !adminBackdrop) return;
        const shouldClose = forceClose || !adminSidebar.classList.contains('-translate-x-full');
        adminSidebar.classList.toggle('-translate-x-full', shouldClose);
        adminBackdrop.classList.toggle('hidden', shouldClose);
    };

    if (adminSidebarToggle) {
        adminSidebarToggle.addEventListener('click', () => toggleAdminSidebar(false));
    }
    if (adminBackdrop) {
        adminBackdrop.addEventListener('click', () => toggleAdminSidebar(true));
    }

    // Tutup alert notifikasi
    document.querySelectorAll('[data-dismiss-alert]').forEach((btn) => {
        btn.addEventListener('click', () => {
            btn.closest('[data-alert-box]')?.remove();
        });
    });

    // Live preview upload gambar di form admin
    const imageInput = document.querySelector('[data-image-input]');
    const imagePreview = document.querySelector('[data-image-preview]');
    const imagePlaceholder = document.querySelector('[data-image-placeholder]');
    const fileNameLabel = document.querySelector('[data-image-filename]');

    if (imageInput && imagePreview) {
        imageInput.addEventListener('change', (event) => {
            const file = event.target.files?.[0];
            if (!file) return;

            if (fileNameLabel) {
                fileNameLabel.textContent = `${file.name} (${(file.size / 1024).toFixed(0)} KB)`;
            }

            const reader = new FileReader();
            reader.onload = (e) => {
                imagePreview.src = e.target?.result;
                imagePreview.classList.remove('hidden');
                if (imagePlaceholder) {
                    imagePlaceholder.classList.add('hidden');
                }
            };
            reader.readAsDataURL(file);
        });
    }

    // Auto-generate slug saat mengetik nama jika slug belum diedit manual
    const nameSource = document.querySelector('[data-slug-source]');
    const slugTarget = document.querySelector('[data-slug-target]');
    if (nameSource && slugTarget) {
        let manualEdit = slugTarget.value.trim().length > 0;
        slugTarget.addEventListener('input', () => {
            manualEdit = slugTarget.value.trim().length > 0;
        });
        nameSource.addEventListener('input', () => {
            if (manualEdit) return;
            slugTarget.value = nameSource.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
        });
    }
});
