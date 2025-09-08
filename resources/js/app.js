import './bootstrap';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse'
import carouselFactory from './carousel.js';
import countdownTimerFactory from './countdownTimer.js';

Alpine.data('carousel', carouselFactory);
Alpine.data('countdownTimer', countdownTimerFactory);
Alpine.plugin(collapse)
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
