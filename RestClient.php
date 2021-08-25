<?php
require 'Connector.php';

class RestClient
{
	private Connector $conn;
	public function __construct($url)
	{
		$this->conn = new Connector(['url' => $url]);
	}

	public function get(int $id)
	{
		curl_exec($this->conn);
	}

	public function post()
	{

	}

	public function put()
	{

	}

	public function delete()
	{

	}
}
