<?php

if (!function_exists("format_price")) {
    function format_price($price)
    {
        return "Rp " . number_format($price, 0, ",", ".");
    }
}
