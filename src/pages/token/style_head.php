<?php 

$url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$parsedUrl = parse_url($url);
$path = explode('/', $parsedUrl['path']);
$address = $path[2];

?>

<title><?php echo $address; ?> - Alltoscan</title>
<meta name="description" content="View the transactions, NFTs, balances token holdings, transfers and more of <?php echo $address; ?> on all blockchains.">