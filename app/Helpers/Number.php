<?php
if (!function_exists("currencyFormat")) {
    function currencyFormat($number, $currency = "VNĐ")
    {
        return number_format($number, 0, ",", ".") . " " . $currency;
    }
}


/* Handle Build Query Param To Roter New */
if (!function_exists("setParamUrl")) {
    function setParamUrl($router, $onlyKey = "")
    {
        return $router . "?" . http_build_query(request()->only($onlyKey));
    }
}
