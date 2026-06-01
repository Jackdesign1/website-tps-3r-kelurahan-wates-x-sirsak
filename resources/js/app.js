import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

window.Alpine = Alpine;
Alpine.plugin(collapse);
Alpine.start();

import Chart from 'chart.js/auto';
window.Chart = Chart;

Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
Chart.defaults.color = '#6b7280';