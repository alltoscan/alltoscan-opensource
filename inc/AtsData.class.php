<?php

class AtsData
{
    private $baseURL = ""; //nodejs url

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
        return $this->fetchData($endpoint);
    }

    public function getBlockList()
    {
        $endpoint = "/search/undefined";
        return $this->fetchData($endpoint);
    }

    public function search()
    {
        /// TODO: get search term from url
        $searchTerm = "0x1f9090aaE28b8a3dCeaDf281B0F12828e676c326"; //address
        $endpoint = "/search" . $searchTerm;
        return $this->fetchData($endpoint);
    }
}
