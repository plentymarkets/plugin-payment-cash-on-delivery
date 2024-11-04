<?php

namespace CashOnDelivery\Helpers;

use CashOnDelivery\Models\Database\Settings;
use Plenty\Modules\Plugin\DataBase\Contracts\DataBase;
use Plenty\Modules\Plugin\PluginSet\Contracts\PluginSetRepositoryContract;
use Plenty\Plugin\Application;
use Plenty\Plugin\CachingRepository;

class SettingsHelper
{
    private const CACHE_KEY = 'cash_on_delivery_plugin_settings';

    protected Application $application;

    protected PluginSetRepositoryContract $pluginSetRepository;

    protected CachingRepository $cachingRepository;

    protected DataBase $dataBase;

    public function __construct(
        Application $application,
        PluginSetRepositoryContract $pluginSetRepository,
        CachingRepository $cachingRepository,
        DataBase $dataBase
    ) {
        $this->application = $application;
        $this->pluginSetRepository = $pluginSetRepository;
        $this->cachingRepository = $cachingRepository;
        $this->dataBase = $dataBase;
    }

    public function getSurchargeSettings()
    {
        $currentSettings = $this->getCurrentSettings();
        return [
            'domestic' => [
                'type' => $currentSettings['domesticSurchargeType'],
                'value' => $currentSettings['domesticSurchargeValue']
            ],
            'foreign' => [
                'type' => $currentSettings['foreignSurchargeType'],
                'value' => $currentSettings['foreignSurchargeValue']
            ],
        ];
    }

    public function getCurrentSettings()
    {
        $webstoreId = $this->application->getPlentyId();
        $pluginSetId = $this->pluginSetRepository->getCurrentPluginSetId();

        if (!$this->cachingRepository->has(self::CACHE_KEY . '_' . $webstoreId . '_' . $pluginSetId)) {
            /** @var Settings $setting */
            $setting = $this->dataBase->query(Settings::class)
                ->where('webstore', '=', $webstoreId)
                ->where('pluginSetId', '=', $pluginSetId)
                ->limit(1)
                ->get();
            if (is_array($setting) && $setting[0] instanceof Settings) {
                $this->cachingRepository->add(
                    self::CACHE_KEY . '_' . $webstoreId . '_' . $pluginSetId,
                    (array)$setting[0]->value,
                    1440
                );
                return (array)$setting[0]->value;
            }
        }

        return $this->cachingRepository->get(self::CACHE_KEY . '_' . $webstoreId . '_' . $pluginSetId, []);
    }

    public function getDeliveryCountryIds(): array
    {
        $currentSettings = $this->getCurrentSettings();
        if (isset($currentSettings['deliveryCountries']) && is_array($currentSettings['deliveryCountries'])) {
            return $currentSettings['deliveryCountries'];
        };
        return [];
    }
}