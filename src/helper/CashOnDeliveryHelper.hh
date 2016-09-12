<?hh //strict

namespace CashOnDelivery\Helper;

use Plenty\Modules\Payment\Method\Contracts\PaymentMethodRepositoryContract;
use Plenty\Modules\Payment\Method\Models\PaymentMethod;

class CashOnDeliveryHelper
{
    private PaymentMethodRepositoryContract $paymentMethodRepository;

    public function __construct(PaymentMethodRepositoryContract $paymentMethodRepository)
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    public function createMopIfNotExists():void
    {
        if($this->getMop() == 'no_paymentmethod_found')
        {
            $paymentMethodData = array( 'pluginKey' => 'plenty_cashondelivery',
                'paymentKey' => 'CASHONDELIVERY',
                'name' => 'Nachnahme');

            $this->paymentMethodRepository->createPaymentMethod($paymentMethodData);
        }
    }

    public function getMop():mixed
    {
        $paymentMethods = $this->paymentMethodRepository->allForPlugin('plenty_cashondelivery');

        if( !is_null($paymentMethods) )
        {
            foreach($paymentMethods as $paymentMethod)
            {
                if($paymentMethod->paymentKey == 'CASHONDELIVERY')
                {
                    return $paymentMethod->id;
                }
            }
        }

        return 'no_paymentmethod_found';
    }

}
