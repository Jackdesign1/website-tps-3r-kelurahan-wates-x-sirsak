<?php

if (!function_exists('formatRupiah')) {
    function formatRupiah(float|int|string $amount): string
    {
        return 'Rp ' . number_format((float) $amount, 0, ',', '.');
    }
}

if (!function_exists('formatKg')) {
    function formatKg(float|int|string $kg): string
    {
        return number_format((float) $kg, 2, ',', '.') . ' kg';
    }
}
