<?php

namespace CashOnDelivery\Helpers;


use Plenty\Log\Traits\Loggable;
use Plenty\Modules\Accounting\Contracts\DetermineShopCountryContract;
use Plenty\Modules\Basket\Contracts\BasketRepositoryContract;
use Plenty\Modules\Basket\Models\Basket;

class SurchargeHelper
{
    use Loggable;

    protected BasketRepositoryContract $basketRepository;

    protected DetermineShopCountryContract $determineShopCountry;

    protected SettingsHelper $settingsHelper;

    public function __construct(
        BasketRepositoryContract $basketRepository,
        DetermineShopCountryContract $determineShopCountry,
        SettingsHelper $settingsHelper
    ) {
        $this->basketRepository = $basketRepository;
        $this->determineShopCountry = $determineShopCountry;
        $this->settingsHelper = $settingsHelper;
    }

    public function getSurchargeForBasket(): float
    {
        $fee = 0;

        /** @var Basket $basket */
        $basket = $this->basketRepository->load();
        $shippingCountryId = $basket->shippingCountryId;
        $case = $this->isDomesticOrForeign($shippingCountryId);
        $currentSurchargeSettings = $this->settingsHelper->getSurchargeSettings();
        if ($currentSurchargeSettings[$case]['type'] == 'flatRate') {
            $fee = $currentSurchargeSettings[$case]['value'];
        } elseif ($currentSurchargeSettings[$case]['type'] == 'percentage') {
            $fee = $basket->basketAmount * ((100 + $currentSurchargeSettings[$case]['value']) / 100);
        }

        $this->getLogger(__CLASS__ . '::' . __METHOD__)->critical(__METHOD__, [
            'fee' => $fee
        ]);

        return $fee;
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