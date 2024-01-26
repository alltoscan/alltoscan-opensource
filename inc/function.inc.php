<?php

function removeSolExtension($domainName) {
    $extension = '.sol';
    if (substr($domainName, -strlen($extension)) === $extension) {
        $domainWithoutExtension = str_ireplace($extension, '', $domainName);
        global $isSNS;
        $isSNS = true;
        return $domainWithoutExtension;
    }
    return $domainName;
}

function sendPostRequest($url, $data) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
      'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
    $response = curl_exec($ch);
  
    if (curl_errno($ch)) {
      $error = curl_error($ch);
      curl_close($ch);
      throw new Exception("Curl error: $error");
    }
  
    curl_close($ch);
  
    return $response;
}


function walletAddressShort($walletAddress, $start = 8, $end = 8)
{
    $length = strlen($walletAddress);
    $startLength = substr($walletAddress, 0, $start);
    $endLength = substr($walletAddress, $length - $end, $end);
    return $startLength . "..." . $endLength;
}

function hexConverter($hex)
{
    return hexdec(substr($hex, 2)) / 1000000000000000000;
}

function hexToDate($hex)
{
    return hexdec(substr($hex, 2));
}

function timeAgo($timestamp)
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

    return $timeAgo;
}

$blockchainToCoinName = array(
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

function cryptoNumberFormat($value, $decimal)
{
    $dividend = (string)$value;
    $divisor = (string)'1' . str_repeat('0', $decimal);
    return bcdiv($value, $divisor, $decimal);
}

function tagClear($data)
{
    $data = preg_replace("/<style .*?<\/style>/is", "", $data);
    $data = preg_replace("/<script .*?<\/script>/is", "", $data);
    $data = preg_replace("/<br \s*\/?\/>/i", "\n", $data);
    $data = preg_replace("/<\/?p>/i", "\n\n", $data);
    $data = preg_replace("/<\/?td>/i", "\n", $data);
    $data = preg_replace("/<\/?div>/i", "\n", $data);
    $data = preg_replace("/<\/?blockquote>/i", "\n", $data);
    $data = preg_replace("/<\/?li>/i", "\n", $data);
    $data = preg_replace("/\&nbsp\;/i", " ", $data);
    $data = preg_replace("/\&nbsp/i", " ", $data);
    $data = preg_replace("/\&amp\;/i", "&", $data);
    $data = preg_replace("/\&amp/i", "&", $data);
    $data = preg_replace("/\&lt\;/i", "<", $data);
    $data = preg_replace("/\&lt/i", "<", $data);
    $data = preg_replace("/\&ldquo\;/i", '"', $data);
    $data = preg_replace("/\&ldquo/i", '"', $data);
    $data = preg_replace("/\&lsquo\;/i", "'", $data);
    $data = preg_replace("/\&lsquo/i", "'", $data);
    $data = preg_replace("/\&rsquo\;/i", "'", $data);
    $data = preg_replace("/\&rsquo/i", "'", $data);
    $data = preg_replace("/\&gt\;/i", ">", $data);
    $data = preg_replace("/\&gt/i", ">", $data);
    $data = preg_replace("/\&rdquo\;/i", '"', $data);
    $data = preg_replace("/\&rdquo/i", '"', $data);
    $data = trim($data);
    $data = strip_tags($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function clear_html($str)
{
    $str = preg_replace("/<style .*?<\/style>/is", "", $str);
    $str = preg_replace("/<script .*?<\/script>/is", "", $str);
    $str = preg_replace("/<br \s*\/?\/>/i", "\n", $str);
    $str = preg_replace("/<\/?p>/i", "\n\n", $str);
    $str = preg_replace("/<\/?td>/i", "\n", $str);
    $str = preg_replace("/<\/?div>/i", "\n", $str);
    $str = preg_replace("/<\/?blockquote>/i", "\n", $str);
    $str = preg_replace("/<\/?li>/i", "\n", $str);
    $str = preg_replace("/\&nbsp\;/i", " ", $str);
    $str = preg_replace("/\&nbsp/i", " ", $str);
    $str = preg_replace("/\&amp\;/i", "&", $str);
    $str = preg_replace("/\&amp/i", "&", $str);
    $str = preg_replace("/\&lt\;/i", "<", $str);
    $str = preg_replace("/\&lt/i", "<", $str);
    $str = preg_replace("/\&ldquo\;/i", '"', $str);
    $str = preg_replace("/\&ldquo/i", '"', $str);
    $str = preg_replace("/\&lsquo\;/i", "'", $str);
    $str = preg_replace("/\&lsquo/i", "'", $str);
    $str = preg_replace("/\&rsquo\;/i", "'", $str);
    $str = preg_replace("/\&rsquo/i", "'", $str);
    $str = preg_replace("/\&gt\;/i", ">", $str);
    $str = preg_replace("/\&gt/i", ">", $str);
    $str = preg_replace("/\&rdquo\;/i", '"', $str);
    $str = preg_replace("/\&rdquo/i", '"', $str);
    $str = preg_replace("/\&\#.*?\;/i", "", $str);
    $str = trim($str);
    $str = strip_tags($str);
    $str = stripslashes($str);
    $str = html_entity_decode($str, ENT_QUOTES);
    return $str;
}

function formatMoney($number, $cents = 2)
{ // cents: 0=no cents added, 1=add if needed, 2=always add cents even if zero
    if (is_numeric($number)) { // if it's a number
        if (!$number) { // if the incoming value is not Zero
            $money = ($cents == 2 ? '0,00' : '0'); // output zero
        } else { // value
            if (floor($number) == $number) { // whole number
                $money = number_format($number, ($cents == 2 ? 2 : 0)); // format
            } else { // cents
                $money = number_format(round($number, 2), ($cents == 0 ? 0 : 2)); // format
            } // integer or decimal
        } // value
        return $money; // can also be used like this: return '$'. $money
    } // numeric
} // formatMoney

function decimalZeroClear($price)
{
    $price = preg_replace("/\.?0*$/", '', $price);
    return $price;
}

function isMobile() {
    return preg_match("/\b(?:a(?:ndroid|vantgo)|b(?:lackberry|olt|o?ost)|cricket|docomo|hiptop|i(?:emobile|p[ao]d)|kitkat|m(?:ini|obi)|palm|oneplus|(?:i|smart|windows )phone|symbian|up\.(?:browser|link)|tablet(?: browser| pc)|(?:hp-|rim |sony )tablet|w(?:ebos|indows ce|os))/i", $_SERVER["HTTP_USER_AGENT"]);
}

function printr($var) {
    $output = print_r($var, true);
    $output = str_replace("\n", "<br>", $output);
    $output = str_replace(' ', '&nbsp;', $output);
    echo "<div style='font-family:courier;'>$output</div>";
}
