<?hh // strict

namespace CashOnDelivery\Providers;

use Plenty\Plugin\ServiceProvider;
use Plenty\Modules\Payment\Method\Contracts\PaymentMethodRepositoryContract;
use Plenty\Modules\Basket\Contracts\BasketRepositoryContract;
use Plenty\Modules\Frontend\Session\Storage\Contracts\FrontendSessionStorageFactoryContract;
use Plenty\Plugin\Events\Dispatcher;
use Plenty\Modules\Payment\Method\Contracts\PaymentMethodContainer;
use CashOnDelivery\Methods\CashOnDeliveryPaymentMethod;
use CashOnDelivery\Helper\CashOnDeliveryHelper;


/**
 * Class CashOnDeliveryServiceProvider
 * @package CashOnDelivery\Providers
 */
 class CashOnDeliveryServiceProvider extends ServiceProvider
 {
     public function register():void
     {

     }

     public function boot(CashOnDeliveryHelper $paymentHelper,
                          PaymentMethodContainer $payContainer):void
     {
       $paymentHelper->createMopIfNotExists();

       $payContainer->register('plenty_cashondelivery::CASHONDELIVERY', CashOnDeliveryPaymentMethod::class,
           [ \Plenty\Modules\Basket\Events\Basket\AfterBasketChanged::class,
             \Plenty\Modules\Basket\Events\Basket\AfterBasketCreate::class]);
     }
 }
