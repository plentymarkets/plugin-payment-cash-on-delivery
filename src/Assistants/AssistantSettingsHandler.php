<?php

namespace CashOnDelivery\Assistants;

use CashOnDelivery\Models\Database\Settings;
use Plenty\Modules\Plugin\Contracts\PluginRepositoryContract;
use Plenty\Modules\Plugin\PluginSet\Contracts\PluginSetRepositoryContract;
use Plenty\Modules\System\Contracts\WebstoreRepositoryContract;
use Plenty\Modules\Wizard\Contracts\WizardSettingsHandler;
use Plenty\Modules\Plugin\DataBase\Contracts\DataBase;
use Plenty\Plugin\Log\Loggable;

class AssistantSettingsHandler implements WizardSettingsHandler
{
    use Loggable;

    protected PluginSetRepositoryContract $pluginSetRepository;

    protected PluginRepositoryContract $pluginRepository;

    public function handle(
        array $parameters
    ) {
        $data = $parameters['data'];
        $webstore = $data['webstore'];

        /** @var PluginSetRepositoryContract $pluginSetRepo */
        $this->pluginSetRepository = pluginApp(PluginSetRepositoryContract::class);
        /** @var PluginRepositoryContract pluginRepository */
        $this->pluginRepository = pluginApp(PluginRepositoryContract::class);

        $pluginSetId = $this->pluginSetRepository->getCurrentPluginSetId();

        if (!is_numeric($webstore) || $webstore <= 0) {
            $webstore = $this->getWebstore($webstore)->storeIdentifier;
        }

        $this->saveSettings($pluginSetId, $webstore, $data);

        return true;
    }

    private function getWebstore(mixed $webstoreId)
    {
        /** @var WebstoreRepositoryContract $webstoreRepository */
        $webstoreRepository = pluginApp(WebstoreRepositoryContract::class);
        return $webstoreRepository->findByStoreIdentifier($webstoreId);
    }

    private function saveSettings(int $pluginSetId, mixed $webstoreId, mixed $data)
    {
        /** @var DataBase $database */
        $database = pluginApp(DataBase::class);
        $existingSettings = null;
        /** @var Settings[] $settings */
        $settings = $database->query(Settings::class)
            ->where('webstore', '=', $webstoreId)
            ->where('pluginSetId', '=', $pluginSetId)
            ->limit(1)
            ->get();
        if (is_array($settings) && $settings[0] instanceof Settings) {
            $existingSettings = $settings[0];
        }

        if (!$existingSettings) {
            $newSettings = pluginApp(Settings::class);
            $newSettings->create([
                'webstore' => $webstoreId,
                'pluginSetId' => $pluginSetId,
                'value' => $data
            ]);
            $this->getLogger(__CLASS__ . "::" . __METHOD__)->report(
                'CashOnDelivery::Assistant.creatingNewSettings',
                [
                    'newSettings' => $data
                ]
            );
        } else {
            $existingSettings->updateValues($data);

            $this->getLogger(__CLASS__ . "::" . __METHOD__)->report(
                'CashOnDelivery::Assistant.updatingExistingSettings',
                [
                    'newSettings' => $data
                ]
            );
        }
    }
}