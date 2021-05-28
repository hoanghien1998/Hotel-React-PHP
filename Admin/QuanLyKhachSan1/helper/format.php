<?php
function currency_format($number, $suffix = 'vnd'){
    return number_format($number).$suffix;
}