import './bootstrap';
import Alpine from 'alpinejs';
import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.css';

window.Alpine = Alpine;
Alpine.start();

flatpickr('#date', {
    dateFormat: 'd/m/Y',
    minDate: 'today',
    maxDate: new Date()
});
