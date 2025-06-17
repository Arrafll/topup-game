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

function getStatusLabel($value)
{
    switch ($value) {
        case 'Unpaid':
            $label = '<span class="badge text-bg-danger">Belum Dibayar</span>';
            break;
        case 'Processed':
            $label = '<span class="badge text-bg-info text-white"> Dalam Proses</span>';
            break;
        case 'Done':
            $label = '<span class="badge text-bg-success"> Dibatalkan</span>';
            break;
        case 'Cancelled':
            $label = '<span class="badge text-bg-danger"> Dibatalkan</span>';
            break;
        case 'Paid':
            $label = '<span class="badge text-bg-success"> Dibayar</span>';
            break;
        default:
            $label = '<span class="badge text-bg-warning text-white">Menunggu Pembayaran</span>';
            break;
    }

    return $label;
}


function getPayMethod($value)
{
    switch ($value) {
        case 'echannel':
            $method = 'Bank Transfer';
            break;
        case 'bank_transfer':
            $method = 'Bank Transfer';
            break;
        case 'bca_klikpay':
            $method = 'Bank Transfer';
            break;
        case 'bca_klikbca':
            $method = 'Bank Transfer';
            break;
        case 'bri_epay':
            $method = 'Bank Transfer';
            break;
        case 'credit_card':
            $method = 'Kartu Kredit';
            break;
        default:
            $method = 'E-Wallets';
            break;
    }

    return $method;
}




?>