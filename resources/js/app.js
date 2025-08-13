// import './bootstrap'
// import Alpine from 'alpinejs'
// import carouselFactory from './carousel.js'

// window.Alpine = Alpine

// console.log('app.js loaded, Alpine', !!window.Alpine)
// document.addEventListener('alpine:init', () => {
//   console.log('alpine:init fired — store register next')
//   Alpine.data('carousel', carouselFactory)

//   Alpine.store('sidebar', {
//     pinned: localStorage.getItem('sidebarPinned') === 'true' || false,
//     toggle() {
//       this.pinned = !this.pinned
//       localStorage.setItem('sidebarPinned', this.pinned)
//     }
//   })
// })

// Alpine.start()


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
