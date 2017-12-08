<?php

namespace CashOnDelivery\Methods;

use Plenty\Modules\Payment\Method\Contracts\PaymentMethodService;
use Plenty\Plugin\ConfigRepository;
use Plenty\Modules\Order\Shipping\Contracts\ParcelServicePresetRepositoryContract;
use Plenty\Modules\Order\Shipping\ParcelService\Models\ParcelServicePreset;
use Plenty\Modules\Frontend\Contracts\Checkout;
use Plenty\Plugin\Application;

/**
 * Class CashOnDeliveryPaymentMethod
 * @package CashOnDelivery\Methods
 */
class CashOnDeliveryPaymentMethod extends PaymentMethodService
{
    /**
     * @var ConfigRepository
     */
    protected $config;

    /**
     * @var Checkout;
     */
    protected $checkout;

    /**
     * @var ParcelServicePresetRepositoryContract
     */
    protected $parcelServicePresetRepoContract;

    public function __construct(
        ConfigRepository $config,
        Checkout $checkout, 
        ParcelServicePresetRepositoryContract $parcelServicePresetRepoContract)
    {
        $this->config = $config;
        $this->checkout = $checkout;
        $this->parcelServicePresetRepoContract = $parcelServicePresetRepoContract;
    }

    /**
     * @param ConfigRepository $config
     * @return bool
     */
    public function isActive():bool
    {
        $shippingProfilId = $this->checkout->getShippingProfileId();
        /** @var ParcelServicePreset */
        $parcelPreset = $this->parcelServicePresetRepoContract->getPresetById($shippingProfilId);
        
        if($parcelPreset instanceof ParcelServicePreset) {
            if((bool)$parcelPreset->isCod) {
                $this->checkout->setPaymentMethodId(1);
                return true;
            }
        }

        return false;
    }

    public function getName($lang='de')
    {
        $name = $this->config->get('CashOnDelivery.name');
        if(strlen($name) > 0) {
            return $name;
        } 
        return 'Cash on Delivery';
    }

    public function getIcon()
    {
        $logo = $this->config->get('CashOnDelivery.logo');
        if(strlen($logo) > 0) {
            return $logo;
        }
        /** @var Application */
        $app = pluginApp(Application::class);
        return $app->getUrlPath('cashondelivery').'/images/logos/nachnahme.png';
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
