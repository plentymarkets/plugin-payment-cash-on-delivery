<?php

namespace CashOnDelivery\Assistants;

use Plenty\Modules\Order\Shipping\Countries\Contracts\CountryRepositoryContract;
use Plenty\Modules\Order\Shipping\Countries\Models\Country;
use Plenty\Modules\System\Contracts\SystemInformationRepositoryContract;
use Plenty\Modules\System\Contracts\WebstoreRepositoryContract;
use Plenty\Modules\System\Models\Webstore;
use Plenty\Modules\Wizard\Services\WizardProvider;
use Plenty\Plugin\Application;

class ConfigurationAssistant extends WizardProvider
{
    private WebstoreRepositoryContract $webstoreRepository;

    private CountryRepositoryContract $countryRepository;

    private SystemInformationRepositoryContract $systemInformationRepository;

    public function __construct(
        WebstoreRepositoryContract $webstoreRepository,
        CountryRepositoryContract $countryRepository,
        SystemInformationRepositoryContract $systemInformationRepository
    ) {
        $this->webstoreRepository = $webstoreRepository;
        $this->countryRepository = $countryRepository;
        $this->systemInformationRepository = $systemInformationRepository;
    }

    protected function structure(): array
    {
        return [
            "title" => 'Assistant.title',
            "shortDescription" => 'Assistant.shortDescription',
            "iconPath" => $this->getIcon(),
            "settingsHandlerClass" => AssistantSettingsHandler::class,
            "translationNamespace" => "CashOnDelivery",
            "key" => "payment-cashOnDelivery-assistant",
            "topics" => ["payment"],
            "priority" => 990,
            "options" => [
                "webstore" => [
                    "type" => 'select',
                    'defaultValue' => $this->getMainWebstore(),
                    "options" => [
                        'name' => 'Assistant.storeName',
                        'required' => true,
                        'listBoxValues' => $this->getWebstoreList(),
                    ],
                ],
            ],

            "steps" => [
                "stepOne" => [
                    "title" => "Assistant.stepOneTitle",
                    "sections" => [
                        [
                            "title" => 'Assistant.deliveryCountriesTitle',
                            "description" => 'Assistant.deliveryCountriesDescription',
                            "form" => [
                                "deliveryCountries" => [
                                    'type' => 'checkboxGroup',
                                    'defaultValue' => [],
                                    'options' => [
                                        'name' => 'Assistant.deliveryCountries',
                                        'checkboxValues' => $this->getCountriesList(),
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                "stepTwo" => [
                    "title" => "Assistant.stepTwoTitle",
                    "sections" => [
                        [
                            "title" => 'Assistant.surcharge',
                            "description" => 'Assistant.surchargeDescription',
                            "form" => [
                                "domesticSurchargeType" => [
                                    'type' => 'select',
                                    'options' => [
                                        'name' => 'Assistant.domesticSurchargeType',
                                        'listBoxValues' => [
                                            [
                                                "caption" => "Assistant.flatRate",
                                                "value" => 'flatRate'
                                            ],
                                            [
                                                "caption" => "Assistant.percentage",
                                                "value" => "percentage"
                                            ],
                                        ],
                                    ],
                                ],
                                "domesticSurchargeValue" => [
                                    'type' => 'number',
                                    'defaultValue' => 0.00,
                                    'options' => [
                                        'name' => 'Assistant.domesticSurchargeValue',
                                        'minValue' => 0.00
                                    ],
                                ],
                                "foreignSurchargeType" => [
                                    'type' => 'select',
                                    'options' => [
                                        'name' => 'Assistant.foreignSurchargeType',
                                        'listBoxValues' => [
                                            [
                                                "caption" => "Assistant.flatRate",
                                                "value" => 'flatRate'
                                            ],
                                            [
                                                "caption" => "Assistant.percentage",
                                                "value" => "percentage"
                                            ],
                                        ],
                                    ],
                                ],
                                "foreignSurchargeValue" => [
                                    'type' => 'number',
                                    'defaultValue' => 0.00,
                                    'options' => [
                                        'name' => 'Assistant.foreignSurchargeValue',
                                        'minValue' => 0.00
                                    ],
                                ],
                            ],
                        ],
                    ],
                ]
            ]
        ];
    }

    private function getIcon()
    {
        $app = pluginApp(Application::class);
        return $app->getUrlPath('cashondelivery') . '/images/logos/nachnahme.png';
    }

    private function getMainWebstore()
    {
        /** @var Webstore $webstore */
        $webstore = $this->webstoreRepository->findById(0);
        return $webstore->storeIdentifier;
    }

    private function getWebstoreList(): array
    {
        $webstoreList = [];

        $webstores = $this->webstoreRepository->loadAll();
        /** @var Webstore $webstore */
        foreach ($webstores as $webstore) {
            $webstoreList[] = [
                "caption" => $webstore->name,
                "value" => $webstore->storeIdentifier,
            ];
        }
        usort($webstoreList, function ($a, $b) {
            return ($a['value'] <=> $b['value']);
        });

        return $webstoreList;
    }

    private function getCountriesList(): array
    {
        $deliveryCountries = [];

        $countries = $this->countryRepository->getCountriesList(null, ['names']);
        $systemLanguage = $this->systemInformationRepository->loadValue('systemLang');
        /** @var Country $country */
        foreach ($countries as $country) {
            $name = $country->names->where('lang', $systemLanguage)->first()->name;
            $deliveryCountries[] = [
                'caption' => $name ?? $country->name,
                'value' => $country->id
            ];
        }

        return $deliveryCountries;
    }
}
