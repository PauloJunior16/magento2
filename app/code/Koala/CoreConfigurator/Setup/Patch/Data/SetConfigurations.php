<?php

namespace Koala\CoreConfigurator\Setup\Patch\Data;

use Exception;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class SetConfigurations implements DataPatchInterface
{
    /**
     * Path to be configured
     */
    const FIELDS_PATHS = [
        'general_country_default' => 'general/country/default',
        'general_country_allow' => 'general/country/allow',
        'general_region_state_required' => 'general/region/state_required',
        'general_locale_code' => 'general/locale/code',
        'general_locale_timezone' => 'general/locale/timezone',
        'general_locale_weight_unit' => 'general/locale/weight_unit',
        'currency_options_base' => 'currency/options/base',
        'currency_options_default' => 'currency/options/default',
        'currency_options_allow' => 'currency/options/allow',
        'wishlist_general_multiple_enabled' => 'wishlist/general/multiple_enabled',
        'system_currency_installed' => 'system/currency/installed',
        'system_bulk_lifetime' => 'system/bulk/lifetime',
    ];

    /**
     * Data to be configured
     */
    const FIELDS_VALUES = [
        'general_country_default' => 'BR',
        'general_country_allow' => 'BR',
        'general_region_state_required' => 'BR',
        'general_locale_code' => 'pt_BR',
        'general_locale_timezone' => 'America/Sao_Paulo',
        'general_locale_weight_unit' => 'kgs',
        'currency_options_base' => 'BRL',
        'currency_options_default' => 'BRL',
        'currency_options_allow' => 'BRL',
        'wishlist_general_multiple_enabled' => '1',
        'system_currency_installed' => 'BRL',
        'system_bulk_lifetime' => '7',
    ];

    /**
     * @var WriterInterface
     */
    private $configWriter;

    /**
     * SetLanguageCurrencyLogsConfigurations constructor.
     *
     * @param WriterInterface $writerInterface
     */
    public function __construct(WriterInterface $writerInterface)
    {
        $this->configWriter = $writerInterface;
    }

    /**
     * Adds default settings
     *
     * @return void
     * @throws Exception
     */
    public function apply(): void
    {
        foreach (self::FIELDS_VALUES as $key => $value) {
            $this->setData($key, $value);
        }
    }

    /**
     * Save configuration data
     *
     * @param string $key
     * @param string $value
     * @return void
     * @throws Exception
     */
    private function setData(string $key, string $value): void
    {
        $path = self::FIELDS_PATHS[$key];
        if (empty($path)) {
            throw new Exception('Value not found in constant "FIELDS_PATH": ' . $key . ' value: ' . $value);
        }
        $this->configWriter->save(
            $path,
            $value,
            ScopeConfigInterface::SCOPE_TYPE_DEFAULT,
            0
        );
    }

    /**
     * Get array of patches that have to be executed prior to this.
     *
     * @return array
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * Get aliases (previous names) for the patch.
     *
     * @return array
     */
    public function getAliases(): array
    {
        return [];
    }
}
