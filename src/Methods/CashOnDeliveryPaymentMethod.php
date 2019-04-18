<?php

namespace CashOnDelivery\Methods;

use Plenty\Modules\Frontend\Services\AccountService;
use Plenty\Modules\Payment\Method\Contracts\PaymentMethodService;
use Plenty\Plugin\ConfigRepository;
use Plenty\Modules\Order\Shipping\Contracts\ParcelServicePresetRepositoryContract;
use Plenty\Modules\Order\Shipping\ParcelService\Models\ParcelServicePreset;
use Plenty\Modules\Frontend\Contracts\Checkout;
use Plenty\Plugin\Application;
use Plenty\Modules\Basket\Contracts\BasketRepositoryContract;
use Plenty\Modules\Account\Contact\Contracts\ContactRepositoryContract;

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

    /**
     * @var BasketRepositoryContract
     */
    protected $basketRepo;

    /**
     * @var ContactRepositoryContract
     */
    protected $contactRepository;

    public function __construct(
        ConfigRepository $config,
        Checkout $checkout, 
        ParcelServicePresetRepositoryContract $parcelServicePresetRepoContract,
        BasketRepositoryContract $basketRepo,
        ContactRepositoryContract $contactRepository)
    {
        $this->config = $config;
        $this->checkout = $checkout;
        $this->parcelServicePresetRepoContract = $parcelServicePresetRepoContract;
        $this->basketRepo = $basketRepo;
        $this->contactRepository = $contactRepository;
    }

    /**
     * @param ConfigRepository $config
     * @return bool
     */
    public function isActive():bool
    {
        $codAvailable = false;

        if($shippingProfileId = $this->checkout->getShippingProfileId()) {
            /** @var ParcelServicePreset */
            $parcelPreset = $this->parcelServicePresetRepoContract->getPresetById($shippingProfileId);

            if ($parcelPreset instanceof ParcelServicePreset) {
                if ((bool)$parcelPreset->isCod) {
                    $this->checkout->setPaymentMethodId(1);

                    return true;
                }
            }
        }
        
        $contact = null;

        /** @var AccountService $accountService */
        $accountService = pluginApp(AccountService::class);
        $contactId = $accountService->getAccountContactId();
        if($contactId > 0) {
            $contact = $this->contactRepository->findContactById($contactId);
        }

        $params  = [
            'countryId'  => $this->checkout->getShippingCountryId(),
            'webstoreId' => pluginApp(Application::class)->getWebstoreId(),
        ];
        $list    = $this->parcelServicePresetRepoContract->getLastWeightedPresetCombinations($this->basketRepo->load(), $contact->classId, $params);
        
        foreach($list as $id => $parcelService) {
            $parcelPreset = $this->parcelServicePresetRepoContract->getPresetById($parcelService['parcelServicePresetId']);
            if($parcelPreset instanceof ParcelServicePreset) {
                if((bool)$parcelPreset->isCod) {
                    $codAvailable = true;
                }
            }
        }

        return $codAvailable;
    }

    /**
     * @return bool
     */
    public function isSelectable()
    {
        return false;
    }

    public function getName($lang='de')
    {
        $trans = pluginApp(\Plenty\Plugin\Translation\Translator::class);
        $paymentMethodName = $trans->trans('CashOnDelivery::PaymentMethod.name');
        if(strlen($paymentMethodName)){
            return $paymentMethodName;
        }
        $name = $this->config->get('CashOnDelivery.name');
        if(strlen($name) > 0) {
            return $name;
        } 
        return 'cash on delivery';
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
        return false;
    }

    public function isSwitchableTo()
    {
        return false;
    }
}
