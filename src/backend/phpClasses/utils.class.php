<?php
class AtsUtils
{
    private $searchString = "";
    private $decimals = 18;
    private $divider = 1000000000000000000;


    /// Looks for the searchString from url
    /// and determines the search type
    public function determineSearchType($searchString)
    {
        /// set incoming searcTerm
        $this->searchString = $searchString;

        if ($this->isDomain()) {
            // domain search
            return "domain";
        } elseif ($this->isTransaction()) {
            // transaction search
            return "tx";
        } elseif ($this->isBlockNumber()) {
            // block id search
            return "blocklist";
        } elseif ($this->isWalletAddress()) {
            // wallet address search
            return "address";
        } else {
            return "token";
        }
    }

    /// ---------- Public Methods

    public function walletAddressShort($walletAddress, $start = 8, $end = 8)
    {
        $length = strlen($walletAddress);
        $startLength = substr($walletAddress, 0, $start);
        $endLength = substr($walletAddress, $length - $end, $end);
        return $startLength . "..." . $endLength;
    }

    public function decodeHex($hex)
    {
        return hexdec(substr($hex, 2));
    }

    public function hexToAmount($hex)
    {
        $decoded = $this->decodeHex($hex) / $this->divider;
        return $this->cryptoNumberFormat($decoded);
        // return number_format($this->cryptoNumberFormat($decoded), 9, '.', ',');
    }

    public function hexToUSD($hex)
    {
        $decoded = $this->decodeHex($hex) / $this->divider;
        return '$' . number_format($this->cryptoNumberFormat($decoded), 2, '.', ',');
    }

    public function toUSD($num)
    {
        return '$' . number_format($num, 2, '.', ',');
    }

    public function hexToTimeAgo($hex)
    {
        return $this->timeAgo($this->decodeHex($hex));
    }

    public function fixStatus($status)
    {
        return $status === 1 ? "🟢 Success" : "🔴 Failed";
    }


    public function getCoinNameFromBlockchain($blockchain)
    {
        $names = array(
            "eth" => "ETH",
            "bsc" => "BNB",
            "fantom" => "FTM",
            "polygon" => "MATIC",
            "syscoin" => "SYS",
            "arbitrum" => "ETH",
            "avalanche" => "AVAX",
            "optimism" => "OP",
            "wan" => "WAN",
        );

        if (in_array($blockchain, array_keys($names))) {
            return $names[$blockchain];
        } else {
            return "";
        }
    }

    public function timeAgo($timestamp)
    {
        $currentTimestamp = time();
        $diff = $currentTimestamp - $timestamp;

        $minute = 60;
        $hour = 60 * $minute;
        $day = 24 * $hour;
        $week = 7 * $day;
        $month = 30 * $day;
        $year = 365 * $day;

        if ($diff < $minute) {
            $timeAgo = $diff . ' seconds ago';
        } elseif ($diff < $hour) {
            $timeAgo = floor($diff / $minute) . ' minutes ago';
        } elseif ($diff < $day) {
            $timeAgo = floor($diff / $hour) . ' hours ago';
        } elseif ($diff < $week) {
            $timeAgo = floor($diff / $day) . ' days ago';
        } elseif ($diff < $month) {
            $timeAgo = floor($diff / $week) . ' weeks ago';
        } elseif ($diff < $year) {
            $timeAgo = floor($diff / $month) . ' months ago';
        } else {
            $timeAgo = floor($diff / $year) . ' years ago';
        }

        return ($timeAgo === "53 years ago") ? "-" : $timeAgo;
    }

    /// ---------- Private Methods
    private function isDomain()
    {
        if (strpos($this->searchString, '.') !== false) return true;
        return false;
    }
    private function isTransaction()
    {
        $term = strtolower($this->searchString);
        return (strpos($term, "0x") !== false && strlen($term) > 60) ? true : false;
    }
    private function isBlockNumber()
    {
        if (preg_match('/^\d{8,10}$/', $this->searchString)) return true;
        return false;
    }
    private function isWalletAddress()
    {
        if (preg_match('/^(0x)?[0-9a-f]{40}$/i', $this->searchString)) return true;
        return false;
    }

    private function cryptoNumberFormat($value)
    {
        $divisor = (string)'1' . str_repeat('0', $this->decimals);

        return number_format($value, 18);
        // return bcdiv($value, $divisor, $this->decimals);
    }
}
