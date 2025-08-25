import './bootstrap';
import Alpine from 'alpinejs';
import carouselFactory from './carousel.js';
import countdownTimerFactory from './countdownTimer.js';

Alpine.data('carousel', carouselFactory);
Alpine.data('countdownTimer', countdownTimerFactory);

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
