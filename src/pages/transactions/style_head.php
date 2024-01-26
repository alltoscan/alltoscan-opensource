<?php 

$url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$parsedUrl = parse_url($url);
$path = explode('/', $parsedUrl['path']);
$blockchain = $path[2];

?>
<title>Transactions on eth, bsc, fantom, polygon, syscoin, matic, arbitrum, avalanche, optimism, wan - Alltoscan</title>
<meta name="description" content="View the transactions, NFTs, balances token holdings, transfers and more of transactions on all blockchains.">
<meta name="keywords" content="blockchain explorer, wallet explorer, wallet check, search, blockchain, crypto, currency">