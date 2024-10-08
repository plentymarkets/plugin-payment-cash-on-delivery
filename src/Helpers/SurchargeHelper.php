<?php

namespace CashOnDelivery\Helpers;


use Plenty\Modules\Accounting\Contracts\DetermineShopCountryContract;
use Plenty\Modules\Basket\Contracts\BasketRepositoryContract;
use Plenty\Modules\Basket\Models\Basket;

class SurchargeHelper
{
    protected BasketRepositoryContract $basketRepository;

    protected DetermineShopCountryContract $determineShopCountry;

    protected SettingsHelper $settingsHelper;

    public function __construct(
        BasketRepositoryContract $basketRepository,
        DetermineShopCountryContract $determineShopCountry,
        SettingsHelper $settingsService
    ) {
        $this->basketRepository = $basketRepository;
        $this->determineShopCountry = $determineShopCountry;
        $this->settingsHelper = $settingsService;
    }

    public function getSurchargeForBasket(): float
    {
        /** @var Basket $basket */
        $basket = $this->basketRepository->load();
        $shippingCountryId = $basket->shippingCountryId;
        $case = $this->isDomesticOrForeign($shippingCountryId);
        $currentSurchargeSettings = $this->settingsHelper->getSurchargeSettings();
        if ($currentSurchargeSettings[$case]['type'] == 'flatRate') {
            return $currentSurchargeSettings[$case]['value'];
        } elseif ($currentSurchargeSettings[$case]['type'] == 'percentage') {
            return $basket->basketAmount * ((100 + $currentSurchargeSettings[$case]['value']) / 100);
        }
        return 0;
    }

    private function isDomesticOrForeign(int $shippingCountryId): string
    {
        $shopCountryId = $this->determineShopCountry->getCountryId();
        if ($shopCountryId == $shippingCountryId) {
            return 'domestic';
        }
        return 'foreign';
    }
}