<?php
$url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$parsedUrl = parse_url($url);
$path = explode('/', $parsedUrl['path']);
$address = $path[2];
$chain = ($path[3]) ? $path[3] : "all";

$adsAddress = "0x1e9d349cec77fea6481f009593101d0e20a69490";
$adsAddress2 = "0x4603180bbb8221157880afaa84638e0fc467738d";

if($address != $adsAddress && $address != $adsAddress2){
    $pageData = json_decode(json_encode($atsData->getWalletData($address)));
    $dataError = $pageData->error ? true : false;
    $count = 0;

    $transactionList = json_decode(json_encode($atsData->getTxList($address, 0, $chain)));
    $transactionsDataError = $transactionList->error ? true : false;
    $nextPageToken = $transactionList->result->nextPageToken;
}


?>
<div class="container">
    <div class="row">
        <div class="col-12 my-auto">
            <div class="row">
                <div class="col-lg-7 ps-2 position-relative">
                    <span id="squareIcon" class="identicon position-absolute d-none d-lg-block" style="top: 20px"></span>
                    <span id="squareIconMobile" class="identicon position-absolute d-block d-md-none" style="top: 9px"></span>
                    <h1 class="d-inline-block">
                        <span class="ps-4 ms-2 h6 fw-bold">Address</span>
                        <span id="copyAddress" class="text-muted text-opacity-50 text-break h6"><?php echo $path[2]; ?></span>
                        <span id="copy-button" class="ps-2 pt-0 h6">
                            <i class="fa-light fa-copy text-muted" style="cursor: pointer"></i>
                        </span>
                    </h1>
                    <input id="hiddenAddress" type="hidden" value="" />
                </div>
                <div class="col-lg-5 text-center text-lg-end my-auto">
                    <div class="btn-group">
                        <a aria-expanded="false" class="btn btn-sm btn-primary fw-600 dropdown-toggle" data-bs-toggle="dropdown" href="#" rel="nofollow noopener">Earn</a>
                        <ul class="dropdown-menu dropdown-menu-end p-0 mt-2 sponsored">
                            <span class="small text-muted position-absolute top-0 end-0 pt-1 pe-2" style="
                                        z-index: inherit;
                                        font-size: 10px;
                                    ">Sponsored</span>
                            <li>
                                <div class="card px-3 py-0 border-0">
                                    <div class="card-body p-2" style="
                                                font-size: 12px;
                                            ">
                                        <p class="mb-0 text-primary">
                                            Advertise
                                            your brand
                                            here
                                        </p>
                                        <p class="mb-1 text-justify">
                                            Promote your
                                            products and
                                            services
                                            readily on
                                            the pages of
                                            alltoscan
                                            with Button
                                            Sponsorship.
                                            Call To
                                            Action (CTA)
                                            button
                                            allows users
                                            to engage
                                            with you
                                            from a click
                                            of a button
                                        </p>
                                        <a class="badge text-bg-success stretched-link" href="mailto:info@alltoscan.com" rel="nofollow noopener">Start
                                            Today</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="card px-3 py-0 border-0">
                                    <div class="card-body p-2" style="
                                                font-size: 12px;
                                            ">
                                        <p class="mb-0 text-primary">
                                            Advertise
                                            your brand
                                            here
                                        </p>
                                        <p class="mb-1 text-justify">
                                            Promote your
                                            products and
                                            services
                                            readily on
                                            the pages of
                                            alltoscan
                                            with Button
                                            Sponsorship.
                                            Call To
                                            Action (CTA)
                                            button
                                            allows users
                                            to engage
                                            with you
                                            from a click
                                            of a button
                                        </p>
                                        <a class="badge text-bg-success stretched-link" href="mailto:info@alltoscan.com" rel="nofollow noopener">Start
                                            Today</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="btn-group">
                        <a aria-expanded="false" class="btn btn-sm btn-primary fw-600 dropdown-toggle" data-bs-toggle="dropdown" href="#" rel="nofollow noopener">Gaming</a>
                        <ul class="dropdown-menu dropdown-menu-end p-0 mt-2 sponsored">
                            <span class="small text-muted position-absolute top-0 end-0 pt-1 pe-2" style="
                                        z-index: inherit;
                                        font-size: 10px;
                                    ">Sponsored</span>
                            <li>
                                <div class="card px-3 py-0 border-0">
                                    <div class="card-body p-2" style="
                                                font-size: 12px;
                                            ">
                                        <p class="mb-0 text-primary">
                                            Advertise
                                            your brand
                                            here
                                        </p>
                                        <p class="mb-1 text-justify">
                                            Promote your
                                            products and
                                            services
                                            readily on
                                            the pages of
                                            alltoscan
                                            with Button
                                            Sponsorship.
                                            Call To
                                            Action (CTA)
                                            button
                                            allows users
                                            to engage
                                            with you
                                            from a click
                                            of a button
                                        </p>
                                        <a class="badge text-bg-success stretched-link" href="mailto:info@alltoscan.com" rel="nofollow noopener">Start
                                            Today</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="btn-group">
                        <a aria-expanded="false" class="btn btn-sm btn-primary fw-600 dropdown-toggle" data-bs-toggle="dropdown" href="#" rel="nofollow noopener">Exchange</a>
                        <ul class="dropdown-menu dropdown-menu-end p-0 mt-2 sponsored">
                            <span class="small text-muted position-absolute top-0 end-0 pt-1 pe-2" style="
                                        z-index: inherit;
                                        font-size: 10px;
                                    ">Sponsored</span>
                            <li>
                                <div class="card px-3 py-0 border-0">
                                    <div class="card-body p-2" style="
                                                font-size: 12px;
                                            ">
                                        <p class="mb-0 text-primary">
                                            Advertise
                                            your brand
                                            here
                                        </p>
                                        <p class="mb-1 text-justify">
                                            Promote your
                                            products and
                                            services
                                            readily on
                                            the pages of
                                            alltoscan
                                            with Button
                                            Sponsorship.
                                            Call To
                                            Action (CTA)
                                            button
                                            allows users
                                            to engage
                                            with you
                                            from a click
                                            of a button
                                        </p>
                                        <a class="badge text-bg-success stretched-link" href="mailto:info@alltoscan.com" rel="nofollow noopener">Start
                                            Today</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="btn-group">
                        <a aria-expanded="false" class="btn btn-sm btn-primary fw-600 dropdown-toggle" data-bs-toggle="dropdown" href="#" rel="nofollow noopener">Buy</a>
                        <ul class="dropdown-menu dropdown-menu-end p-0 mt-2 sponsored">
                            <span class="small text-muted position-absolute top-0 end-0 pt-1 pe-2" style="
                                        z-index: inherit;
                                        font-size: 10px;
                                    ">Sponsored</span>
                            <li>
                                <div class="card px-3 py-0 border-0">
                                    <div class="card-body p-2" style="
                                                font-size: 12px;
                                            ">
                                        <p class="mb-0 text-primary">
                                            Advertise
                                            your brand
                                            here
                                        </p>
                                        <p class="mb-1 text-justify">
                                            Promote your
                                            products and
                                            services
                                            readily on
                                            the pages of
                                            alltoscan
                                            with Button
                                            Sponsorship.
                                            Call To
                                            Action (CTA)
                                            button
                                            allows users
                                            to engage
                                            with you
                                            from a click
                                            of a button
                                        </p>
                                        <a class="badge text-bg-success stretched-link" href="mailto:info@alltoscan.com" rel="nofollow noopener">Start
                                            Today</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr class="my-1 border-dark-subtle" />
            <div class="row">
                <div class="col-12">
                    <p class="py-3 mb-0">
                        <span class="fw-bold">Alltoscan</span> - Sponsored slots available.
                        <a class="nav-link d-inline-block text-muted" href="https://URL.COM/" target="_blank" rel="nofollow noopener">
                            <span id="topTextAds" style="color: royalblue;">Book your slot here!</span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 pb-5 pt-0 pb-lg-5 text-right">
            <div class="row h-100">
                <div class="col-12">
                    <div class="card h-100 bg-white">
                        <div class="card-header border-0 border-bottom fw-bolder small">Overview</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row g-1 border-bottom pb-2">
                                        <div class="col-md-4 my-auto">
                                            <span class="text-dark">Total Value:</span>
                                        </div>
                                        <div class="col-md-8 my-auto">
                                            <span class="walletBalance">
                                                <?php if($address != $adsAddress && $address != $adsAddress2){ ?>
                                                <?= !$dataError ? $atsUtils->toUSD($pageData->result->totalBalanceUsd) : 0; ?>
                                                <?php } ?>
                                            </span>
                                            <?php /*
                                            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapseExample">
                                                <i class="fa-solid fa-arrows-rotate"></i>
                                            </button>
                                            */ ?>
                                        </div>
                                        <?php /*
                                        <div class="col my-auto">
                                            <div class="form-check form-check-reverse">
                                                <input class="form-check-input p-2 border-info" type="checkbox" value="" id="flexCheckDefault" />
                                                <label class="form-check-label text-muted pe-2" for="flexCheckDefault">
                                                    Hide Small
                                                    Balances
                                                </label>
                                            </div>
                                        </div>
                                        */ ?>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="row">
                                        <div class="col-md-4 my-auto">
                                            <span class="text-dark">Token:</span>
                                        </div>
                                        <div class="col-md-8 my-auto ps-lg-0">
                                            <?php if($address != $adsAddress && $address != $adsAddress2){ ?>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-white border dropdown-toggle w-100 text-start" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                                                    <span style="font-size: 0.925em;"><?= count($pageData->result->assets); ?> Token</span>
                                                </button>
                                                <div class="dropdown-menu p-2 text-body-secondary dropdown-menu-lg-end w-100 overflow-y-auto" style="max-height: 220px;">
                                                    <ul class="list-group">
                                                        
                                                        <?php if ($dataError) : ?>
                                                        <?php else : ?>
                                                            <?php foreach ($pageData->result->assets as $row) : ?>
                                                                <li class="list-group-item d-flex justify-content-between align-items-start border-0 border-top p-1">
                                                                    <div class="ms-2 me-auto">
                                                                        <div class="text-start">
                                                                            <?php if ($row->thumbnail !== "") : ?>
                                                                                <img src="<?= $row->thumbnail; ?>" style="width:15px; height:15px;">
                                                                            <?php else : ?>
                                                                                <img src="assets/img/icon/coin-no-logo.svg" style="width:15px; height:15px;">
                                                                            <?php endif; ?>
                                                                            <?= $row->tokenSymbol; ?> <br />
                                                                            <small class="fw-normal" style="font-size:11px;"><?= bcdiv($row->balance, 1, 4); ?> <?= $row->tokenSymbol; ?></small>
                                                                        </div>
                                                                    </div>
                                                                    <span class="text-muted text-end small">
                                                                        <?= $atsUtils->toUSD($row->balanceUsd); ?> <br />
                                                                        <small class="fw-normal" style="font-size:11px;"><?= $atsUtils->toUSD($row->tokenPrice); ?></small>
                                                                    </span>
                                                                </li>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                        
                                                    </ul>


                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 pb-5 pt-0 pb-lg-5 text-right">
            <div class="row h-100">
                <div class="col-12">
                    <div class="card h-100 bg-white">
                        <div class="card-header border-0 border-bottom small fw-bolder">More Info</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row g-0">
                                        <div class="col-md-4 my-auto">
                                            <span class="text-dark">Last TXN Sent:</span>
                                        </div>
                                        <div class="col-md-8 my-auto">
                                            <p class="mb-0">
                                                <?php if($address != $adsAddress && $address != $adsAddress2){ ?>
                                                <?php foreach ($transactionList->result->transactions as $last) { ?>
                                                    <span class="walletBalance pe-2">
                                                        <img src="assets/img/networkLogo/<?= $last->blockchain; ?>.webp" width="24" height="24" alt="<?= $last->blockchain; ?> logo">
                                                        <a href="/tx/<?= $last->blockchain; ?>/<?= $last->hash; ?>"><?= substr($last->hash, 0, 12); ?>...</a>
                                                        <small><?= $atsUtils->hexToTimeAgo($last->timestamp); ?></small>
                                                    </span>
                                                <?php break;
                                                } ?>
                                                <?php } ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 pb-5 pt-0 pb-lg-5 text-right">
            <div class="row h-100">
                <div class="col-12">
                    <div class="card h-100 bg-white">
                        <div class="card-header border-0 border-bottom small fw-bolder">Sponsored</div>
                        <div class="card-body">
                            <div class="ads-center text-center">
                                <div id="bannerSlot" class="d-flex justify-content-center"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12 tabs-to-dropdown">
            <ul class="nav nav-tabs nav-pills nav-fill" id="pills-tab" role="tablist">
                <li class="nav-item ps-1 pe-1 py-1 py-lg-0" role="presentation">
                    <a href="/address/<?= $address; ?>" class="nav-link<?= $chain === "all" ? " active" : "" ?>" data-filter="all" id="pills-all-tab" aria-controls="pills-all" aria-selected="true">
                        ALL Chains
                    </a>
                </li>
                <li class="nav-item ps-1 pe-1 py-1 py-lg-0" role="presentation">
                    <a href="/address/<?= $address; ?>/bsc" class="nav-link<?= $chain === "bsc" ? " active" : "" ?>" data-filter="bsc" id="pills-bsc-tab" aria-selected="false">
                        <img src="assets/img/networkLogo/bsc.webp" width="24" height="24" alt="Binance Smart Chain logo" />
                        Bsc
                    </a>
                </li>
                <li class="nav-item ps-1 pe-1 py-1 py-lg-0" role="presentation">
                    <a href="/address/<?= $address; ?>/eth" class="nav-link<?= $chain === "eth" ? " active" : "" ?>" data-filter="eth" id="pills-eth-tab" aria-controls="pills-eth" aria-selected="false">
                        <img src="assets/img/networkLogo/eth.webp" width="24" height="24" alt="Ethereum logo" />
                        Ethereum
                    </a>
                </li>
                <li class="nav-item ps-1 pe-1 py-1 py-lg-0" role="presentation">
                    <a href="/address/<?= $address; ?>/avalanche" class="nav-link<?= $chain === "avalanche" ? " active" : "" ?>" data-filter="avalanche" id="pills-avalanche-tab" aria-controls="pills-avalanche" aria-selected="false">
                        <img src="assets/img/networkLogo/avalanche.webp" width="24" height="24" alt="Avalance logo" />
                        Avalanche
                    </a>
                </li>
                <li class="nav-item ps-1 pe-1 py-1 py-lg-0" role="presentation">
                    <a href="/address/<?= $address; ?>/polygon" class="nav-link<?= $chain === "polygon" ? " active" : "" ?>" data-filter="polygon" id="pills-polygon-tab" aria-controls="pills-polygon" aria-selected="false">
                        <img src="assets/img/networkLogo/polygon.webp" width="24" height="24" alt="Polygon logo" />
                        Polygon
                    </a>
                </li>
                <li class="nav-item ps-1 pe-1 py-1 py-lg-0" role="presentation">
                    <a href="/address/<?= $address; ?>/arbitrum" class="nav-link<?= $chain === "arbitrum" ? " active" : "" ?>" data-filter="arbitrum" id="pills-arbitrum-tab" aria-controls="pills-arbitrum" aria-selected="false">
                        <img src="assets/img/networkLogo/arbitrum.webp" width="24" height="24" alt="Arbitrum logo" />
                        Arbitrum
                    </a>
                </li>
                <li class="nav-item ps-1 pe-1 py-1 py-lg-0" role="presentation">
                    <a href="/address/<?= $address; ?>/fantom" class="nav-link<?= $chain === "fantom" ? " active" : "" ?>" data-filter="fantom" id="pills-fantom-tab" aria-controls="pills-fantom" aria-selected="false">
                        <img src="assets/img/networkLogo/fantom.webp" width="24" height="24" alt="Fantom logo" />
                        Fantom
                    </a>
                </li>
                <li class="nav-item ps-1 pe-0 py-1 py-lg-0" role="presentation">
                    <a href="/address/<?= $address; ?>/optimism" class="nav-link<?= $chain === "optimism" ? " active" : "" ?>" data-filter="optimism" id="pills-optimism-tab" aria-controls="pills-optimism" aria-selected="false">
                        <img src="assets/img/networkLogo/optimism.webp" width="24" height="24" alt="optimism logo" />
                        Optimism
                    </a>
                </li>
                <li class="nav-item ps-1 pe-0 py-1 py-lg-0" role="presentation">
                    <a href="/address/<?= $address; ?>/syscoin" class="nav-link<?= $chain === "syscoin" ? " active" : "" ?>" data-filter="syscoin" id="pills-syscoin-tab" aria-controls="pills-syscoin" aria-selected="false">
                        <img src="assets/img/networkLogo/syscoin.webp" width="24" height="24" alt="syscoin logo" />
                        syscoin
                    </a>
                </li>
                <li class="nav-item ps-1 pe-0 py-1 py-lg-0" role="presentation">
                    <a href="/address/<?= $address; ?>/opbnb" class="nav-link<?= $chain === "opbnb" ? " active" : "" ?>" data-filter="opbnb" id="pills-opbnb-tab" aria-controls="pills-opbnb" aria-selected="false">
                        <img src="assets/img/networkLogo/bsc.webp" width="24" height="24" alt="opbnb logo" />
                        OpBNB
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>