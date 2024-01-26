<?php
$url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$parsedUrl = parse_url($url);
$path = explode('/', $parsedUrl['path']);
$blockChain = $path[2];
$txHash = $path[3];

$pageData = json_decode(json_encode($atsData->getTxInfo($blockChain, $txHash)));
$dataError = $pageData->error ? true : false;

?>
<div class="container">
    <div class="row">
        <!-- // Address Details -->
        <div class="col-12 col-lg-12">
            <div class="row g-0">
                <div class="col ps-2 position-relative">
                    <span id="squareIcon" class="identicon position-absolute d-none d-lg-block" style="top:20px;"></span>
                    <span id="squareIconMobile" class="identicon position-absolute d-block d-md-none" style="top:9px;"></span>
                    <h1 class="d-inline-block">
                        <span class="ps-4 ms-2 h5 fw-bold">Transaction</span>
                        <span id="copyAddress" class="text-opacity-50 text-break text-muted h5 txHash"><?php echo $path[3]; ?></span>
                        <span id="copy-button" class="ps-2 pt-0 h5">
                            <i class="fa-light fa-copy text-muted" style="cursor: pointer;"></i>
                        </span>
                    </h1>
                    <input id="bep20Address" class="txHash" type="hidden" value="" />
                </div>

            </div>
        </div>
    </div>
</div>