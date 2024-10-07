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

        if (isset($data['domesticSurchargeFlatRate'])) {
            $this->value['domesticSurchargeFlatRate'] = $data['domesticSurchargeFlatRate'];
        }
        if (isset($data['domesticSurchargePercentage'])) {
            $this->value['domesticSurchargePercentage'] = $data['domesticSurchargePercentage'];
        }
        if (isset($data['foreignSurchargeFlatRate'])) {
            $this->value['foreignSurchargeFlatRate'] = $data['foreignSurchargeFlatRate'];
        }
        if (isset($data['foreignSurchargePercentage'])) {
            $this->value['foreignSurchargePercentage'] = $data['foreignSurchargePercentage'];
        }

        if (isset($data['domesticStatisticsFlatRate'])) {
            $this->value['domesticStatisticsFlatRate'] = $data['domesticStatisticsFlatRate'];
        }
        if (isset($data['domesticStatisticsPercentage'])) {
            $this->value['domesticStatisticsPercentage'] = $data['domesticStatisticsPercentage'];
        }
        if (isset($data['foreignStatisticsFlatRate'])) {
            $this->value['foreignStatisticsFlatRate'] = $data['foreignStatisticsFlatRate'];
        }
        if (isset($data['foreignStatisticsPercentage'])) {
            $this->value['foreignStatisticsPercentage'] = $data['foreignStatisticsPercentage'];
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
