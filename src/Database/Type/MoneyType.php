<?php
namespace Gourmet\Money\Database\Type;

use Cake\Database\Driver;
use Cake\Database\Type;
use Gourmet\Money\I18n\Money;

class MoneyType extends Type
{
    public function toDatabase($value, Driver $driver)
    {
        if ($value === null) {
            $value = 0;
        }

        return json_encode($this->_toMoney($value, Money::$defaultCurrency));
    }

    public function toPHP($value, Driver $driver)
    {
        if ($value === null) {
            return $value;
        }

        $value = json_decode($value, true);
        return $this->_toMoney($value['amount'], $value['currency']);
    }

    public function marshal($value)
    {
        if ($value instanceof Money) {
            return $value;
        }

        try {
            return $this->_toMoney($value, Money::$defaultCurrency);
        } catch (\Exception $e) {
            return null;
        }
    }

    protected function _toMoney($value, $currency)
    {
        if (is_int($value)) {
            $value = new Money($value, $currency);
        }

        if (is_bool($value) || empty($value)) {
            return null;
        }

        if (is_string($value)) {
            $value = Money::fromString($value, $currency);
        }

        if (is_array($value)) {
            $value = $this->_toMoney($value['amount'], $value['currency']);
        }

        return $value;
    }
}
