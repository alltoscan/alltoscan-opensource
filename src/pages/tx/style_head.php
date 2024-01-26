<?php 

$url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$parsedUrl = parse_url($url);
$path = explode('/', $parsedUrl['path']);
$blockchainName = $path[2];
$txNumber = $path[3];



?>

<title><?php echo strtoupper($blockchainName); ?> Transaction <?php echo $txNumber; ?> Details - Alltoscan</title>
<meta name="description" content="View details of <?php echo ucfirst($blockchainName); ?> transaction <?php echo $txNumber; ?> on Alltoscan. Explore transactions, NFTs, token holdings and balances across all blockchains."/>
<meta name="keywords" content="<?php echo strtoupper($blockchainName); ?>, Blockchain, Transaction, Alltoscan, NFTs, Token Holdings, Balances, Blockchains, <?php echo $txNumber; ?>">
<meta property="og:title" content="<?php echo strtoupper($blockchainName); ?> Transaction <?php echo $txNumber; ?> Details - Alltoscan" />
<meta property="og:description" content="View details of <?php echo strtoupper($blockchainName); ?> transaction <?php echo $txNumber; ?> on Alltoscan. Explore transactions, NFTs, token holdings and balances across all blockchains." />
<meta property="og:url" content="<?php echo $url; ?>" />
<meta property="og:image" content="https://alltoscan.com/assets/img/logo/all-to-scan-favicon.png" />
<meta property="og:type" content="website" />
<meta property="og:site_name" content="Alltoscan" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="<?php echo strtoupper($blockchainName); ?> Transaction <?php echo $txNumber; ?> Details - Alltoscan" />
<meta name="twitter:description" content="View details of <?php echo strtoupper($blockchainName); ?> transaction <?php echo $txNumber; ?> on Alltoscan. Explore transactions, NFTs, token holdings and balances across all blockchains." />
<meta name="twitter:image" content="https://alltoscan.com/assets/img/logo/all-to-scan-favicon.png" />
<meta name="twitter:site" content="@alltoscan" />