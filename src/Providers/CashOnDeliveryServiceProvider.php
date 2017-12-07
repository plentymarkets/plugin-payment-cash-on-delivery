<?php

namespace CashOnDelivery\Providers;

use CashOnDelivery\Methods\CashOnDeliveryPaymentMethod;
use CashOnDelivery\Helper\CashOnDeliveryHelper;

use Plenty\Plugin\ServiceProvider;
use Plenty\Plugin\Events\Dispatcher;
use Plenty\Modules\Basket\Events\Basket\AfterBasketChanged;
use Plenty\Modules\Basket\Events\BasketItem\AfterBasketItemAdd;
use Plenty\Modules\Basket\Events\Basket\AfterBasketCreate;
use Plenty\Modules\Payment\Events\Checkout\GetPaymentMethodContent;
use Plenty\Modules\Payment\Events\Checkout\ExecutePayment;
use Plenty\Modules\Order\Shipping\Events\AfterShippingCostCalculated;
use Plenty\Modules\Payment\Method\Contracts\PaymentMethodContainer;

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
            function(GetPaymentMethodContent $event) use( $paymentHelper)
            {
                if($event->getMop() == $paymentHelper->getMop())
                {
                    $event->setValue('');
                    $event->setType('continue');
                }
            });

            // Listen for the event that executes the payment
            $eventDispatcher->listen(ExecutePayment::class,
                function(ExecutePayment $event) use( $paymentHelper)
                {
                    if($event->getMop() == $paymentHelper->getMop())
                    {
                        $event->setValue('<h1>Rechungskauf<h1>');
                        $event->setType('htmlContent');
                    }
                });
    }
}
