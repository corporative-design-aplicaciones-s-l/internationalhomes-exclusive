import './bootstrap';
import 'bootstrap';
import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';
import Alpine from 'alpinejs';
import GLightbox from 'glightbox';
import 'glightbox/dist/css/glightbox.css';

window.Alpine = Alpine;
Alpine.start();
window.Swiper = Swiper;
document.addEventListener('DOMContentLoaded', function() {
    const lightbox = GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true,
        closeButton: true
    });
});
