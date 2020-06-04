<?php

namespace CashOnDelivery\Methods;

use Plenty\Modules\Basket\Models\Basket;
use Plenty\Modules\Frontend\Services\AccountService;
use Plenty\Modules\Payment\Method\Services\PaymentMethodBaseService;
use Plenty\Modules\System\Contracts\WebstoreConfigurationRepositoryContract;
use Plenty\Plugin\ConfigRepository;
use Plenty\Modules\Order\Shipping\Contracts\ParcelServicePresetRepositoryContract;
use Plenty\Modules\Order\Shipping\ParcelService\Models\ParcelServicePreset;
use Plenty\Modules\Frontend\Contracts\Checkout;
use Plenty\Plugin\Application;
use Plenty\Modules\Basket\Contracts\BasketRepositoryContract;
use Plenty\Modules\Account\Contact\Contracts\ContactRepositoryContract;
use Plenty\Plugin\Translation\Translator;

/**
 * Class CashOnDeliveryPaymentMethod
 * @package CashOnDelivery\Methods
 */
class CashOnDeliveryPaymentMethod extends PaymentMethodBaseService
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

    /** @var Translator */
    protected $translator;

    public function __construct(
        ConfigRepository $config,
        Checkout $checkout, 
        ParcelServicePresetRepositoryContract $parcelServicePresetRepoContract,
        BasketRepositoryContract $basketRepo,
        ContactRepositoryContract $contactRepository,
        Translator $translator)
    {
        $this->config = $config;
        $this->checkout = $checkout;
        $this->parcelServicePresetRepoContract = $parcelServicePresetRepoContract;
        $this->basketRepo = $basketRepo;
        $this->contactRepository = $contactRepository;
        $this->translator = $translator;
    }

    /**
     * @param ConfigRepository $config
     * @return bool
     */
    public function isActive():bool
    {
        $codAvailable = false;
        $contact = null;
        $contactClassId = 0;

        /** @var Basket $basket */
        $basket = $this->basketRepo->load();

        $accountService = pluginApp(AccountService::class);
        $isGuest = !($accountService->getIsAccountLoggedIn() && $basket->customerId > 0);
        $contact = null;
        if(!$isGuest) {
            try {
                $contact = $this->contactRepository->findContactById($basket->customerId);
            } catch(\Exception $ex) {}
        }

        $application = pluginApp(Application::class);
        $params  = [
            'countryId'  => $this->checkout->getShippingCountryId(),
            'webstoreId' => $application->getWebstoreId(),
            'skipCheckForMethodOfPaymentId' => true
        ];

        if($contact !== null)
        {
            $contactClassId = $contact->classId;
        }
        else
        {
            /** @var WebstoreConfigurationRepositoryContract $webstoreConfigRepo */
            $webstoreConfigRepo = pluginApp(WebstoreConfigurationRepositoryContract::class);
            $webstoreConfig     = $webstoreConfigRepo->findByWebstoreId($application->getWebstoreId());
            $contactClassId = $webstoreConfig->defaultCustomerClassId ?? 0;
        }

        $list    = $this->parcelServicePresetRepoContract->getLastWeightedPresetCombinations($this->basketRepo->load(), $contactClassId, $params);

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
        return true;
    }

    /**
     * Get name of the payment method
     *
     * @param  string  $lang
     * @return string
     */
    public function getName(string $lang = 'de'): string
    {
        return $this->translator->trans('CashOnDelivery::PaymentMethod.name',[],$lang);
    }

    /**
     * Get the payment method icon
     *
     * @param  string  $lang
     * @return string
     */
    public function getIcon(string $lang = 'de'): string
    {
        $logo = $this->config->get('CashOnDelivery.logo');
        if(strlen($logo) > 0) {
            return $logo;
        }
        /** @var Application */
        $app = pluginApp(Application::class);
        return $app->getUrlPath('cashondelivery').'/images/logos/nachnahme.png';
    }

    public function isSwitchableFrom(): bool
    {
        return false;
    }

    public function isSwitchableTo(): bool
    {
        return false;
    }

    /**
     * Check if this payment method should be searchable in the backend
     *
     * @return bool
     */
    public function isBackendSearchable():bool
    {
        return true;
    }

    /**
     * Check if this payment method should be active in the backend
     *
     * @return bool
     */
    public function isBackendActive():bool
    {
        return true;
    }

    /**
     * Get the name for the backend
     *
     * @param string $lang
     * @return string
     */
    public function getBackendName(string $lang = 'de'):string
    {
        return $this->getName($lang);
    }

    /**
     * Get the url for the backend icon
     *
     * @return string
     */
    public function getBackendIcon(): string
    {
        $app = pluginApp(Application::class);
        $icon = $app->getUrlPath('cashondelivery').'/images/logos/cashondelivery_backend_icon.svg';
        return $icon;
    }
}
