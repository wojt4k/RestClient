<?php
require('Connector.php');

class RestClient
{
    private $conn;
    private string $address;

    public function __construct($address)
    {
        $this->conn = new Connector();
        $this->address = $address;
    }

    public function get($request)
    {
        $this->conn->setOptionalParams([
            CURLOPT_URL => $this->address . '/' . $request
        ]);
        return $this->conn->execute();
    }

    public function post($data)
    {
        $this->conn->setOptionalParams([
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $data
        ]);
        return $this->conn->execute();
    }

    public function put($data)
    {
        $this->conn->setOptionalParams([
            CURLOPT_PUT => 1,
            CURLOPT_POSTFIELDS => $data
        ]);
    }

    public function delete()
    {

    }
}
