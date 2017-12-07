<?php

namespace CashOnDelivery\Methods;

use Plenty\Modules\Payment\Method\Contracts\PaymentMethodService;
use Plenty\Plugin\ConfigRepository;
use Plenty\Modules\Order\Shipping\Contracts\ParcelServicePresetRepositoryContract;
use Plenty\Modules\Order\Shipping\ParcelService\Models\ParcelServicePreset;
use Plenty\Modules\Frontend\Contracts\Checkout;

/**
 * Class CashOnDeliveryPaymentMethod
 * @package CashOnDelivery\Methods
 */
class CashOnDeliveryPaymentMethod extends PaymentMethodService
{
    /**
     * @var Checkout;
     */
    protected $checkout;

    /**
     * @var ParcelServicePresetRepositoryContract
     */
    protected $parcelServicePresetRepoContract;

    public function __construct(
        Checkout $checkout, 
        ParcelServicePresetRepositoryContract $parcelServicePresetRepoContract)
    {
        $this->checkout = $checkout;
        $this->parcelServicePresetRepoContract = $parcelServicePresetRepoContract;
    }

    /**
     * @param ConfigRepository $config
     * @return bool
     */
    public function isActive():bool
    {
        $status = false;

        $shippingProfilId = $this->checkout->getShippingProfileId();
        /** @var ParcelServicePreset */
        $parcelPreset = $this->parcelServicePresetRepoContract->getPresetById($shippingProfilId);
        
        if($parcelPreset instanceof ParcelServicePreset) {
            $status = (bool)$parcelPreset->isCod;
        }

        return $status;
    }

    public function getName($lang='de')
    {
        return 'Cash on Delivery';
    }

    public function getIcon()
    {
        return '';
    }

    public function isSwitchableFrom()
    {
        return true;
    }

    public function isSwitchableTo()
    {
        return false;
    }
}
