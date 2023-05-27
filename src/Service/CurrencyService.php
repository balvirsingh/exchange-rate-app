<?php

namespace App\Service;

class CurrencyService
{
    public static function getCurrencies()
    {
        return [
            array('code' => 'USD', 'name' => 'United States Dollar', 'symbol' => '$'),
            array('code' => 'EUR', 'name' => 'Euro', 'symbol' => '€'),
            array('code' => 'GBP', 'name' => 'British Pound', 'symbol' => '£'),
            array('code' => 'JPY', 'name' => 'Japanese Yen', 'symbol' => '¥'),
            array('code' => 'CAD', 'name' => 'Canadian Dollar', 'symbol' => 'CA$'),
            array('code' => 'AUD', 'name' => 'Australian Dollar', 'symbol' => 'AU$'),
            array('code' => 'CHF', 'name' => 'Swiss Franc', 'symbol' => 'CHF'),
            array('code' => 'CNY', 'name' => 'Chinese Yuan', 'symbol' => '¥'),
            array('code' => 'INR', 'name' => 'Indian Rupee', 'symbol' => '₹'),
            array('code' => 'MXN', 'name' => 'Mexican Peso', 'symbol' => 'MX$'),
            array('code' => 'BRL', 'name' => 'Brazilian Real', 'symbol' => 'R$'),
            array('code' => 'ZAR', 'name' => 'South African Rand', 'symbol' => 'R'),
            array('code' => 'RUB', 'name' => 'Russian Ruble', 'symbol' => '₽'),
            array('code' => 'SAR', 'name' => 'Saudi Riyal', 'symbol' => '﷼'),
            array('code' => 'AED', 'name' => 'United Arab Emirates Dirham', 'symbol' => 'د.إ'),
            array('code' => 'SGD', 'name' => 'Singapore Dollar', 'symbol' => 'S$'),
            array('code' => 'HKD', 'name' => 'Hong Kong Dollar', 'symbol' => 'HK$'),
            array('code' => 'NZD', 'name' => 'New Zealand Dollar', 'symbol' => 'NZ$'),
            array('code' => 'SEK', 'name' => 'Swedish Krona', 'symbol' => 'kr'),
            array('code' => 'NOK', 'name' => 'Norwegian Krone', 'symbol' => 'kr')
        ];
    }
}