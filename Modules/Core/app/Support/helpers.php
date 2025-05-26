<?php

use Illuminate\Support\Facades\Schema;
use Modules\Core\Models\Setting;
use Nwidart\Modules\Facades\Module;

if (!function_exists('setting')) {
    function setting(string $key, $default = null)
    {
        return \Modules\Core\Models\Setting::get($key, $default);
    }
}

if (!function_exists('isModuleActive')) {
    function isModuleActive(string $moduleName): bool
    {
        $module = Module::find($moduleName);
        return $module && $module->isEnabled();
    }
}

if (!function_exists('isPluginActive')) {
    function isPluginActive(string $pluginName): bool
    {
        try {
            if (!Schema::hasTable('settings')) {
                return false;
            }

            return Setting::get($pluginName . '::is_active') == 1;
        } catch (\Throwable $e) {
            return false;
        }
    }
}

if (!function_exists('formatCurrency')) {
    function formatCurrency(float $amount, string $currency = 'EUR', string $locale = 'nl'): string
    {
        $formatter = new \NumberFormatter($locale, \NumberFormatter::CURRENCY);

        return $formatter->formatCurrency($amount, $currency);
    }
}

if (!function_exists('parseToNumber')) {
    function parseToNumber(string $formatted): int
    {
        $cleaned = preg_replace('/[^\d,.-]/', '', $formatted);

        if (strpos($cleaned, ',') !== false && strpos($cleaned, '.') !== false) {
            if (strrpos($cleaned, ',') > strrpos($cleaned, '.')) {
                $cleaned = str_replace('.', '', $cleaned);
                $cleaned = str_replace(',', '.', $cleaned);
            } else {
                $cleaned = str_replace(',', '', $cleaned);
            }
        } elseif (strpos($cleaned, ',') !== false) {
            $cleaned = str_replace(',', '.', $cleaned);
        } else {
            //
        }

        return (int) $cleaned;
    }
}

