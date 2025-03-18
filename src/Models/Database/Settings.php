<?php

namespace CashOnDelivery\Models\Database;

use Plenty\Modules\Plugin\DataBase\Contracts\DataBase;
use Plenty\Modules\Plugin\DataBase\Contracts\Model;

/**
 * Class Settings
 *
 * @property int $id
 * @property int $webstore
 * @property int $pluginSetId
 * @property array $value
 */
class Settings extends Model
{
    public $id = 0;
    public $webstore = 0;
    public $pluginSetId = 0;
    public $value = array();

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data)
    {
        $this->webstore = $data['webstore'];
        $this->pluginSetId = $data['pluginSetId'];
        $this->value = $data['value'];

        return $this->save();
    }

    /**
     * @return Model
     */
    public function save()
    {
        /** @var DataBase $database */
        $database = pluginApp(DataBase::class);

        return $database->save($this);
    }

    /**
     * @param array $data
     * @return Model
     */
    public function updateValues(array $data)
    {
        if (isset($data['deliveryCountries'])) {
            $this->value['deliveryCountries'] = $data['deliveryCountries'];
        }

        if (isset($data['domesticSurchargeType'])) {
            $this->value['domesticSurchargeType'] = $data['domesticSurchargeType'];
        }
        if (isset($data['domesticSurchargeValue'])) {
            $this->value['domesticSurchargeValue'] = $data['domesticSurchargeValue'];
        }
        if (isset($data['foreignSurchargeType'])) {
            $this->value['foreignSurchargeType'] = $data['foreignSurchargeType'];
        }
        if (isset($data['foreignSurchargeValue'])) {
            $this->value['foreignSurchargeValue'] = $data['foreignSurchargeValue'];
        }

        return $this->save();
    }

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return 'CashOnDelivery::settings';
    }
}
