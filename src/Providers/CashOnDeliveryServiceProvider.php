<?php

namespace CashOnDelivery\Providers;

use CashOnDelivery\Methods\CashOnDeliveryPaymentMethod;
use CashOnDelivery\Helper\CashOnDeliveryHelper;

use Plenty\Modules\Frontend\Contracts\Checkout;
use Plenty\Modules\Order\Shipping\Contracts\ParcelServicePresetRepositoryContract;
use Plenty\Modules\Order\Shipping\ParcelService\Models\ParcelServicePreset;
use Plenty\Plugin\ServiceProvider;
use Plenty\Plugin\Events\Dispatcher;
use Plenty\Modules\Basket\Events\Basket\AfterBasketChanged;
use Plenty\Modules\Basket\Events\BasketItem\AfterBasketItemAdd;
use Plenty\Modules\Basket\Events\Basket\AfterBasketCreate;
use Plenty\Modules\Payment\Events\Checkout\GetPaymentMethodContent;
use Plenty\Modules\Payment\Events\Checkout\ExecutePayment;
use Plenty\Modules\Order\Shipping\Events\AfterShippingCostCalculated;
use Plenty\Modules\Payment\Method\Contracts\PaymentMethodContainer;
use Plenty\Plugin\Translation\Translator;

class CashOnDeliveryServiceProvider extends ServiceProvider
{
    /**
     * @param CashOnDeliveryHelper $paymentHelper
     * @param PaymentMethodContainer $payContainer
     * @param Dispatcher $eventDispatcher
     */
    public function boot(
        CashOnDeliveryHelper $paymentHelper,
        PaymentMethodContainer $payContainer,
        Dispatcher $eventDispatcher
        ) 
    {
         // Register the Invoice payment method in the payment method container
        $payContainer->register('plenty::COD', CashOnDeliveryPaymentMethod::class,
            [ AfterBasketChanged::class, AfterBasketItemAdd::class, AfterBasketCreate::class, AfterShippingCostCalculated::class ]
        );

        // Listen for the event that gets the payment method content
        $eventDispatcher->listen(GetPaymentMethodContent::class,
            function(GetPaymentMethodContent $event) use( $paymentHelper) {
                if($event->getMop() == $paymentHelper->getMop()) {

                    $event->setType('errorCode');
                    $translator = pluginApp(Translator::class);
                    $event->setValue( $translator->trans('CashOnDelivery::error.errorInvalidParcelService'));

                    /** @var Checkout $checkoutService */
                    $checkoutService = pluginApp(Checkout::class);
                    if($shippingProfileId = $checkoutService->getShippingProfileId()) {
                        $parcelServicePresetRepoContract = pluginApp(ParcelServicePresetRepositoryContract::class);

                        $parcelPreset = $parcelServicePresetRepoContract ->getPresetById($shippingProfileId);
                        if ($parcelPreset instanceof ParcelServicePreset) {
                            if ((bool)$parcelPreset->isCod) {
                                $event->setValue('');
                                $event->setType('continue');
                            }
                        }
                    }
                }
            });

            // Listen for the event that executes the payment
            $eventDispatcher->listen(ExecutePayment::class,
                function(ExecutePayment $event) use( $paymentHelper)
                {
                    if($event->getMop() == $paymentHelper->getMop())
                    {
                        $event->setValue('<h1>Nachnahme<h1>');
                        $event->setType('htmlContent');
                    }
                });
    }
}
