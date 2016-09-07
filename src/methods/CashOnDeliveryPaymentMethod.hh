<?hh // strict

namespace CashOnDelivery\Methods;

use Plenty\Modules\Payment\Method\Contracts\PaymentMethodService;

/**
 * Class CashOnDeliveryPaymentMethod
 * @package CashOnDelivery\Methods
 */
class CashOnDeliveryPaymentMethod extends PaymentMethodService
{
    /**
     * @return bool
     */
    public function isActive():bool
    {
        return true;
    }
}
