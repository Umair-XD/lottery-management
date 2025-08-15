import './bootstrap';
import Alpine from 'alpinejs';
import carouselFactory from './carousel.js';

Alpine.data('carousel', carouselFactory);

window.Alpine = Alpine;

Alpine.store('sidebar', {
    pinned: localStorage.getItem('sidebarPinned') === 'true' || false,
    mobileOpen: false,
    togglePin() {
        this.pinned = !this.pinned;
        localStorage.setItem('sidebarPinned', this.pinned);
    },
    toggleMobile() {
        this.mobileOpen = !this.mobileOpen;
    }
});

Alpine.start();
