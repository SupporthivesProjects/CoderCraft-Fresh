<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Currency extends Model
{
    protected $fillable = [
        'name',
        'symbol',
        'exchange_rate',
        'status',
        'code'
    ];

    public function getFormattedExchangeRateAttribute()
    {
        return number_format($this->exchange_rate, 5);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public static function getDefaultCurrency()
    {
        $default_currency_code = BusinessSetting::getSystemDefaultCurrency();
        return Currency::findOrFail($default_currency_code)->code;
    }

    public static function getActiveCurrencies()
    {
        return self::where('status', 1)->get();
    }

    public function scopeGetByCode($query, $code)
    {
        return $query->where('code', $code)->first();
    }

    public static function getDefaultCurrencyCode()
    {
        $defaultCurrencyId = BusinessSetting::where('type', 'system_default_currency')->first()->value;
        return Currency::findOrFail($defaultCurrencyId)->code;
    }

    public static function convertPrice($price)
    {
        $defaultCurrency = self::getByCode(self::getDefaultCurrencyCode());

        if (!$defaultCurrency) {
            return $price;
        }
        $price = floatval($price) / floatval($defaultCurrency->exchange_rate);

        $targetCurrencyCode = Session::get('currency_code', self::getDefaultCurrencyCode());
        $targetCurrency = self::getByCode($targetCurrencyCode);

        return floatval($price) * floatval($targetCurrency->exchange_rate);
    }

    public static function convertPricePayment($price)
    {
        $defaultCurrency = self::getByCode(self::getDefaultCurrencyCode());

        if (!$defaultCurrency) {
            return $price;
        }

        $price = floatval($price) / floatval($defaultCurrency->exchange_rate);

        $targetCurrencyCode = Session::get('currency_code', self::getDefaultCurrencyCode());
        $targetCurrency = self::getByCode($targetCurrencyCode);

        return floatval($price) * floatval($targetCurrency->exchange_rate);
    }
}
