<?php

function toCurrency($value, $currency, $fractionDigits = 0)
{
    $acceptedCurencies = ["USD" => "en_US", "IDN" => "id_ID"];

    if (!in_array($currency, array_keys($acceptedCurencies)))
        return $value;

    if (!is_numeric($value))
        return $value;

    $formatter = new NumberFormatter($acceptedCurencies[$currency], NumberFormatter::CURRENCY);
    $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, $fractionDigits);
    $formattedNumber = $formatter->format($value);

    return $formattedNumber;
}
;


?>