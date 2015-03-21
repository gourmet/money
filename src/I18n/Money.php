<?php
namespace Gourmet\Money\I18n;

use SebastianBergmann\Money\IntlFormatter;

class Money extends \SebastianBergmann\Money\Money
{
    public static $defaultCurrency = 'USD';
    public static $defaultLocale;

    public function __construct($amount, $currency, $locale = null)
    {
        if (!empty($locale)) {
            static::$defaultLocale = $locale;
        }
        parent::__construct($amount, $currency);
    }

    public function format($locale = null)
    {
        $locale = $locale ?: static::$defaultLocale;
        return (new IntlFormatter($locale))->format($this);
    }

    public function __toString()
    {
        return $this->format();
    }
}
