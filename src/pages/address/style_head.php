<?php 

$url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$parsedUrl = parse_url($url);
$path = explode('/', $parsedUrl['path']);
$address = $path[2];
$network = $path[3];

?>

<title><?php echo $network; ?> Address <?php echo $address; ?> - Alltoscan</title>
<meta name="description" content="View the transactions, NFTs, balances token holdings, transfers and more of address <?php echo $address; ?> on all blockchains.">
<meta name="keywords" content="blockchain explorer, wallet explorer, wallet check, search, blockchain, crypto, currency">