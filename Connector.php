<?php


class Connector
{
    private CurlHandle $crl;
    private Auth $auth;
    private array $defaultParams;

    public function __construct()
    {
        $this->auth = new Auth();
        $this->crl = curl_init();
        $this->setDefaultParams();
    }

    private function authenticate(string $secret, array $payload, array $header = null) {
        $this->auth->setTokenData($secret, $payload, $header);
    }

    public function setCustomHttpHeaders(array $headers = null)
    {
        if (empty($headers)) {
            $headers = [
                'Accept: application/json',
                $this->getBearer()
            ];
        }

        $this->setOptionalParams([
            CURLOPT_HEADER => 1,
            CURLOPT_HTTPHEADER => $headers
        ]);
    }

    private function getBearer(): string
    {
        return 'Authorization: Bearer '.$this->auth->getToken();
    }

    private function setDefaultParams()
    {
        $this->defaultParams = [
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
        ];
    }

    public function setOptionalParams($data = [])
    {
        curl_setopt_array($this->crl, $this->defaultParams + $data);
    }

    public function execute(): string
    {
        return curl_exec($this->crl);
    }

}
