<?php
$url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$parsedUrl = parse_url($url);
$path = explode('/', $parsedUrl['path']);
$blockChain =  $path[2];
$blockNumber =  $path[3];
$pageData = json_decode(json_encode($atsData->getBlockInfo($blockChain, $blockNumber)));
$dataError = $pageData->error ? true : false;
?>
<div class="container">
    <div class="row">
        <div class="col-12 col-lg-8 my-auto py-3">
            <div class="row g-0">
                <div class="col ps-2 position-relative">
                    <span id="squareIcon" class="identicon position-absolute d-none d-lg-block" style="top: 20px"></span>
                    <span id="squareIconMobile" class="identicon position-absolute d-block d-md-none" style="top: 9px"></span>
                    <h1 class="d-inline-block">
                        <span class="ps-4 ms-2 h5 fw-bold">Block</span>
                        <span class="text-muted text-break h5">#</span>
                        <span id="copyAddress" class="text-opacity-50 text-break text-muted h5 blockNum"><?php echo $path[3]; ?></span>
                        <span id="copy-button" class="ps-2 pt-0 h5">
                            <i class="fa-light fa-copy text-muted" style="cursor: pointer"></i>
                        </span>
                    </h1>
                    <input id="hiddenAddress" type="hidden" value="16845785" />
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
                    
        </div>
    </div>
</div>