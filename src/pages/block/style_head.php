<?php 

$url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$parsedUrl = parse_url($url);
$path = explode('/', $parsedUrl['path']);
$blockchainName = $path[2];
$blockNumber = $path[3];

?>

<title><?php echo $blockchainName; ?> Block <?php echo $blockNumber; ?> - Alltoscan</title>
<meta name="description" content="View the transactions, NFTs, balances token holdings, transfers and more of block <?php echo $blockNumber; ?> on all blockchains.">