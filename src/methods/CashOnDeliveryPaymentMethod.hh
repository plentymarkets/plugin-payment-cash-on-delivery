<?hh // strict

namespace CashOnDelivery\Methods;

use Plenty\Modules\Payment\Method\Contracts\PaymentMethodService;
use Plenty\Plugin\ConfigRepository;

/**
 * Class CashOnDeliveryPaymentMethod
 * @package CashOnDelivery\Methods
 */
class CashOnDeliveryPaymentMethod extends PaymentMethodService
{
    /**
     * @param ConfigRepository $config
     * @return bool
     */
    public function isActive(ConfigRepository $config):bool
    {
        if ( $config->get('CashOnDelivery.active') == "1" )
        {
            return true;
        }
        return false;
    }
}
