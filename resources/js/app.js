import './bootstrap';
import Alpine from 'alpinejs';
import mask from '@alpinejs/mask';
import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.css';

window.Alpine = Alpine;
Alpine.plugin(mask);
Alpine.start();

window.flatpickr = flatpickr;

flatpickr('.date', {
    altInput: true,
    altFormat: 'd/m/Y',
    dateFormat: 'Y-m-d',
    minDate: 'today',
});
