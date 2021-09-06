<?php

class Auth
{
    private array $header, $payload, $payloadFields;
    private string $secret;

    public function __construct()
    {
        $this->payloadFields = ['iss','sub','aud','exp','nbf','iat','jti'];
    }

    public function setCustomPayloadField($field, $value)
    {
        $this->payloadFields[$field] = $value;
    }

    private function setSecret($secret)
    {
        $this->secret = $secret;
    }

    private function setHeader(array $header = null)
    {
        $this->header = [
            'alg' => !empty($header['alg']) ? $header['alg'] : 'HS256',
            'typ' => !empty($header['typ']) ? $header['typ'] : 'JWT'
        ];
    }

    public function setPayload(array $payload)
    {
        foreach ($this->payloadFields as $field) {
            if (!empty($payload[$field])) {
                $this->payload[$field] = $payload[$field];
            }
        }
    }

    public function setTokenData(string $secret, array $payload, array $header = null) {
        $this->setSecret($secret);
        $this->setPayload($payload);
        $this->setHeader($header);
    }

    private function getHeader(): string
    {
        return json_encode($this->header);
    }

    private function getPayload(): string
    {
        return json_encode($this->payload);
    }

    private function getSignature(): string
    {
        return hash_hmac('sha256', $this->getHeader().'.'.$this->getPayload(), $this->secret);
    }

    public function getToken(): string
    {
        return base64_encode($this->getHeader()) . '.' .
            base64_encode($this->getPayload()) . '.' .
            base64_encode($this->getSignature());
    }

//    public function setIss($issuer)
//    {
//        $this->payload['iss'] = $issuer;
//    }
//
//    public function setSub($subject)
//    {
//        $this->payload['sub'] = $subject;
//    }
//
//    public function setAud($audience)
//    {
//        $this->payload['aud'] = $audience;
//    }
//
//    public function setExp($expiriation)
//    {
//        $this->payload['exp'] = $expiriation;
//    }
//
//    public function setNbf($notBefore)
//    {
//        $this->payload['nbf'] = $notBefore;
//    }
//
//    public function setIat($issuedAt)
//    {
//        $this->payload['iat'] = $issuedAt;
//    }
//
//    public function setJti($jwtID)
//    {
//        $this->payload['jti'] = $jwtID;
//    }
}