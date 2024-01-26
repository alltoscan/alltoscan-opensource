<?php 

$url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$parsedUrl = parse_url($url);
$path = explode('/', $parsedUrl['path']);
$blockchainName = $path[2];
$domainName = $path[3];

?>

<title>Domain Search : <?php echo $blockchainName; ?> - Alltoscan</title>
<meta name="description" content="Search for your perfect Web3 domain name on alltoscan.">