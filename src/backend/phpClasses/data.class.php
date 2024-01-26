<?php

include_once "mcache.class.php";

class AtsData
{
    private $baseURL = ""; // nodejs url
    private $mem;
    private $cacheTime = 1800; // 10 minutes;

    public function __construct()
    {
        $this->mem = new Memcached();
        $this->mem->addServer('localhost', 11211);
    }

    public function fetchData($endpoint)
    {
        $url = $this->baseURL . $endpoint;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    public function getHomeData()
    {
        $endpoint = "/blocks";
        if ($this->mem->get($endpoint)) {
            return $this->mem->get($endpoint);
        } else {
            $data = $this->fetchData($endpoint);
            $this->mem->set($endpoint, $data, $this->cacheTime);
            return $data;
        }
    }

    public function getBlockList()
    {
        $endpoint = "/search/undefined";
        if ($this->mem->get($endpoint)) {
            return $this->mem->get($endpoint);
        } else {
            $data = $this->fetchData($endpoint);
            $this->mem->set($endpoint, $data, $this->cacheTime);
            return $data;
        }
    }

    public function getWalletData($address)
    {
        $endpoint = "/search/" . $address;
        if ($this->mem->get($endpoint)) {
            return $this->mem->get($endpoint);
        } else {
            $data = $this->fetchData($endpoint);
            $this->mem->set($endpoint, $data, $this->cacheTime);
            return $data;
        }
    }

    public function getBlockInfo($blockChain, $blockNumber)
    {
        $endpoint = "/block/" . $blockChain . "/" .  $blockNumber;
        if ($this->mem->get($endpoint)) {
            return $this->mem->get($endpoint);
        } else {
            $data = $this->fetchData($endpoint);
            $this->mem->set($endpoint, $data, $this->cacheTime);
            return $data;
        }
    }

    public function getTxInfo($blockChain, $txHash)
    {
        $endpoint = "/tx/" . $blockChain . "/" . $txHash;
        if ($this->mem->get($endpoint)) {
            return $this->mem->get($endpoint);
        } else {
            $data = $this->fetchData($endpoint);
            $this->mem->set($endpoint, $data, $this->cacheTime);
            return $data;
        }
    }

    public function getTxList($address, $token = 0, $chain = "all")
    {
        $endpoint = "/txList/" . $address . "/" . $token . "/" . $chain;
        if ($this->mem->get($endpoint)) {
            return $this->mem->get($endpoint);
        } else {
            $data = $this->fetchData($endpoint);
            $this->mem->set($endpoint, $data, $this->cacheTime);
            return $data;
        }
    }

    public function getDomainInfo($domainName)
    {
        $result = array(
            'unstoppable' => $this->queryUnstoppable($domainName),
            'freename' => $this->queryFreeName($domainName),
            'bonfida' => $this->queryBonfida($domainName),
            'spaceid' => $this->querySpaceid($domainName)
        );

        return $result;
    }

    /// ---------- PRIVATE FUNCTIONS
    private function queryUnstoppable($domainName)
    {

        $url = "https://resolve.unstoppabledomains.com/domains/" . $domainName;

        $headers = [
            "Authorization: Bearer 27e19871-76f6-4978-a805-0cf587a7b591" //api key
        ];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            return "Hata: " . $error;
        }

        curl_close($ch);

        return json_decode($response);
    }

    private function queryFreeName($domainName)
    {

        $json_url = "https://rslvr.freename.io/domain/resolve?q=$domainName";
        $jsondata = file_get_contents($json_url);
        $quoteJson = json_decode($jsondata, true);

        return $quoteJson;
    }

    private function queryBonfida($domainName)
    {

        $json_url = "https://localhost.com/sns/$domainName"; // nodejs url
        $jsondata = file_get_contents($json_url);
        $quoteJson = json_decode($jsondata, true);

        return $quoteJson;
    }

    private function querySpaceid($domainName)
    {

        $json_url = "https://api.prd.space.id/v1/getAddress?tld=bnb&domain=$domainName";
        $jsondata = file_get_contents($json_url);
        $quoteJson = json_decode($jsondata, true);

        return $quoteJson;
    }
}
