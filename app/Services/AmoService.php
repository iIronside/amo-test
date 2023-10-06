<?php

namespace App\Services;

class AmoService
{
    private AmoApiService $amoApiService;

    private string $tokenFile;

    public function __construct(AmoApiService $amoApiService)
    {
        $this->amoApiService = $amoApiService;
        $this->tokenFile = base_path() . '/config/token.txt';
    }

    public function createLead(array $data)
    {
        $dataToken = $this->getDataToken();

        if (empty($dataToken['access_token'])) {
            $this->getToken();
        } elseif ($dataToken['endTokenTime'] - 60 < time()) {
            $this->refreshToken();
        }

        $dataToken = $this->getDataToken();

        $data = [
            [
                "price" => (int)$data['price'],
                "_embedded" => [
                    "contacts" => [
                        [
                            "name" => $data['name'],
                            "custom_fields_values" => [
                                [
                                    "field_code" => "EMAIL",
                                    "values" => [
                                        [
                                            "enum_code" => "WORK",
                                            "value" => $data['email']
                                        ]
                                    ]
                                ],
                                [
                                    "field_code" => "PHONE",
                                    "values" => [
                                        [
                                            "enum_code" => "WORK",
                                            "value" => $data['phone']
                                        ]
                                    ]
                                ],
                            ]
                        ]
                    ],
                ],
            ]
        ];

        return $this->amoApiService->addDeal($dataToken['access_token'], $data);
    }

    private function getDataToken()
    {
        $dataToken = file_get_contents($this->tokenFile);
        return json_decode($dataToken, true);
    }

    private function getToken()
    {
        $response = $this->amoApiService->sendTokenRequest($this->getTokenRequestParams());
        $this->saveResponseParameters($response);
    }

    private function refreshToken()
    {
        $response = $this->amoApiService->sendTokenRequest($this->getTokenRequestParams(true));
        $this->saveResponseParameters($response);
    }

    private function getTokenRequestParams(bool $refresh = false)
    {
        $data = [
            'client_id'     => config('amo_config.client_id'),
            'client_secret' => config('amo_config.client_secret'),
            'grant_type'    => 'authorization_code',
            'redirect_uri'  => config('amo_config.redirect_uri'),
        ];

        if ($refresh) {
            $data['grant_type'] = 'refresh_token';
            $data['refresh_token'] = $this->getDataToken()['refresh_token'];
        } else {
            $data['grant_type'] = 'authorization_code';
            $data['code'] = config('amo_config.authorization_code');
        }

        return $data;
    }

    private function saveResponseParameters(array $data)
    {
        $arrParamsAmo = json_encode($data);

        $f = fopen($this->tokenFile, 'w');
        fwrite($f, $arrParamsAmo);
        fclose($f);
    }
}
