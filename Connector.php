<?php


class Connector
{
	private $crl;
	private $connParameters;
	public function __construct(ArrayObject $connParameters = null) {
		$this->crl = curl_init();
		$this->setParameters($connParameters);
		print_r(curl_exec($this->crl));
	}

	private function setParameters(ArrayObject $data = null) {
		if (count($data)) {
			$this->connParameters = [

			];
		} else {
			$this->connParameters = [
				CURLOPT_POST => 1,
				CURLOPT_HEADER => 0,
				CURLOPT_URL => 'xkcd.com/33/info.0.json',
				CURLOPT_FRESH_CONNECT => 1,
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_FORBID_REUSE => 1,
				CURLOPT_TIMEOUT => 4,
				CURLOPT_POSTFIELDS => http_build_query($data['fields'])
			];
		}
		curl_setopt_array($this->crl, $this->connParameters);
	}



}
