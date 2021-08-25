<?php
require 'RestClient.php';

class xkcd
{
	private $client;
	public function __construct()
	{
		$this->client = new RestClient('xkcd.com');
	}

	public function getMeme( int $id )
	{
		$this->client->
	}
}
