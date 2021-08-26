<?php


class Connector
{
	private $crl;
	private $defaultParams;

	public function __construct() {
		$this->crl = curl_init();
		$this->setDefaultParams();
	}

	private function setDefaultParams() {
	    $this->defaultParams = [
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
        ];
    }

	public function setOptionalParams($data = []) {
		curl_setopt_array($this->crl, $this->defaultParams + $data);
	}

    public function execute(): string {
        return curl_exec($this->crl);
    }

}
