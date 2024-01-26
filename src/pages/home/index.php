<main class="position-relative border-top" style="background-color: #f4f5fb">
    <div class="container">
        <div class="row gx-4">
            <div class="col-lg-6 my-4">
                <div class="card rounded-0">
                    <div class="card-header">
                        <h6 class="card-header-title">Latest Blocks</h6>
                    </div>
                    <div class="card-body overflow-auto scrollbar-custom latestBlocksContainer" style="max-height: 30.3rem" id="mCSB_1_container">
                        <?php
                        /// ornek (anasayfa datasini cek) : 
                        $homeData = $atsData->getHomeData();
                        // echo json_encode($homeData);
                        foreach ($homeData as $block) { ?>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="d-none d-sm-flex content-center bg-light text-muted rounded p-2" style="height: 3rem; width: auto;">
                                            <img src="<?php echo SITE_URL; ?>/assets/img/networkLogo/<? echo $block['blockchain']; ?>.webp" alt="<? echo $block['blockchain']; ?>" title="<? echo $block['blockchain']; ?>">
                                        </div>
                                        <div class="d-flex flex-row flex-sm-column align-items-center align-items-sm-start gap-1 gap-sm-0">
                                            <img style="width:32px;height:32px;" class="d-inline-block d-sm-none" src="<?php echo SITE_URL; ?>/assets/img/networkLogo/<? echo $block['blockchain']; ?>.webp"><span class="d-inline-block d-sm-none"><? echo $block['blockchain']; ?></span><a class="" href="/block/<?= $block['blockchain']; ?>/<?php echo hexToDate($block['latest_block']); ?>"><?php echo hexToDate($block['latest_block']); ?>
                                            <?php if(!isMobile()) { ?> (<?php echo $block['blockchain']; ?>) <?php } ?></a>
                                            <?php /*
                                            <div class="small text-muted">
                                                <?php if ($block["blockchain"] === "wan") : ?>
                                                    <?php // $atsUtils->timeAgo(1686250228012 / 1000); ?>
                                                <?php else : ?>
                                                    <?= $atsUtils->hexToTimeAgo($block['timestamp']); ?>
                                                <?php endif; ?>
                                            </div>
                                            */ ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 d-flex justify-content-sm-between align-items-end align-items-sm-center position-relative">
                                    <div class="pe-0 pe-sm-2"></div>
                                    <div class="d-none d-sm-block text-end ms-2 ms-sm-0">
                                        <span class="badge border border-dark dark:border-white border-opacity-15 text-dark fw-medium py-1.5 px-2" data-bs-toggle="tooltip"><?php echo $block['txs']; ?> Txns</span>
                                    </div>
                                </div>
                            </div>
                            <hr />
                        <?php
                        }
                        ?>
                    </div>
                    <a class="card-footer bg-light fw-medium text-cap link-muted text-center" href="/blocklist" rel="nofollow noopener">
                        View all blocks
                        <i class="far fa-long-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-6 my-4">
                <div class="card rounded-0">
                    <div class="card-header">
                        <h6 class="card-header-title">Latest Transactions</h6>
                    </div>
                    <div class="card-body overflow-auto scrollbar-custom latestTransactionsContainer" style="max-height: 30.3rem" id="mCSB_2_container">
                        <?php foreach ($homeData as $trans) : ?>

                            <div class="row">
                                <div class="col-sm-4 col-lg-5">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="d-none d-sm-flex content-center bg-light text-muted rounded p-2" style="height: 3rem; width: 3rem;">
                                            <img src="<?php echo SITE_URL; ?>/assets/img/networkLogo/<? echo $trans['blockchain']; ?>.webp" alt="<? echo $trans['blockchain']; ?>" title="<? echo $trans['blockchain']; ?>">
                                        </div>
                                        <div class="d-flex align-items-center align-items-sm-start flex-row flex-sm-column gap-1 gap-sm-0">
                                            <img style="width:32px;height:32px;" class="d-inline-block d-sm-none" src="<?php echo SITE_URL; ?>/assets/img/networkLogo/<? echo $trans['blockchain']; ?>.webp"><span class="d-inline-block d-sm-none"><? echo $trans['blockchain']; ?> TX#</span><a class="d-block text-truncate" style="max-width: 8rem" href="/tx/<?php echo $trans['blockchain']; ?>/<?php echo $trans['latest_transactions']['hash']; ?>"><?php echo $trans['latest_transactions']['hash']; ?></a>
                                            <?php /*
                                            <div class="small text-muted">
                                                <?php echo $atsUtils->hexToTimeAgo($trans['latest_transactions']['timestamp']); ?>
                                            </div>
                                            */ ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-8 col-lg-7 d-flex justify-content-sm-between align-items-end align-items-sm-center">
                                    <div class="pe-0 pe-sm-2">
                                        <div class="d-flex flex-wrap gap-1">
                                            From
                                            <a href="<?php echo SITE_URL; ?>/address/<?php echo $trans['latest_transactions']['from']; ?>" data-bs-toggle="tooltip"><?php echo walletAddressShort($trans['latest_transactions']['from']); ?></a>
                                        </div>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            To
                                            <a href="<?php echo SITE_URL; ?>/address/<?php echo $trans['latest_transactions']['to']; ?>" data-bs-toggle="tooltip"><?php echo walletAddressShort($trans['latest_transactions']['to']); ?></a>
                                        </div>
                                    </div>
                                    <div class="d-none d-sm-block text-end ms-2 ms-sm-0" data-bs-toggle="tooltip">
                                        <span class="badge border border-dark dark:border-white border-opacity-15 text-dark py-1.5 px-2 fw-medium"><?php echo round(hexConverter($trans['latest_transactions']['value']), 4); ?> <?php echo $blockchainToCoinName[$trans['blockchain']]; ?></span>
                                    </div>
                                </div>
                            </div>
                            <hr />
                        <?php endforeach; ?>


                    </div>
                    <a class="card-footer bg-light fw-medium text-cap link-muted text-center" href="/transactions" rel="nofollow noopener">
                        View all transactions
                        <i class="far fa-long-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>

            <?php if(!isMobile()) { ?>
            <div class="col-12 text-center mb-2 pt-0 pb-3">
                <div class="ads-center ms-auto position-relative" id="">
                        <a href="https://polywin.co?ref=MTIxODQ4ODQxNzA1NTIyOTI0NDAw"><img src="assets/img/ads/polywin/728x90.gif" class="img-fluid" /></a>
                    <?php /*
                    <iframe src="assets/img/ads/bcgame/index.html" frameborder="0" style="overflow:hidden;overflow-x:hidden;overflow-y:hidden;height:90px;width:970px;position:relative;top:0px;left:0px;right:0px;bottom:0px;" height="90px" width="970px"></iframe>
                        <div id="clickOverlay"><a class="position-relative d-block w-100 h-100" href="https://bcgame.top/i-lcr18zdv-n/"></a></div>
                    
                        <ins class="645b706cf49bbbb8b8e94c88" style="display:inline-block;width:1px;height:1px;"></ins>
                    <script>
                        ! function(e, n, c, t, o, r, d) {
                            ! function e(n, c, t, o, r, m, d, s, a) {
                                s = c.getElementsByTagName(t)[0], (a = c.createElement(t)).async = !0, a.src = "https://" + r[m] + "/js/" + o + ".js?v=" + d, a.onerror = function() {
                                    a.remove(), (m += 1) >= r.length || e(n, c, t, o, r, m)
                                }, s.parentNode.insertBefore(a, s)
                            }(window, document, "script", "645b706cf49bbbb8b8e94c88", ["cdn.bmcdn5.com"], 0, new Date().getTime())
                        }();
                    </script>
                    <?php */ ?>
                </div>
            </div>
            <?php } ?>

        </div>
    </div>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-8 text-center">
                <h2 class="h2 fw-bold text-dark">Partners & Integrations</h2>
            </div>
        </div>
    </div>

    <div class="container-fluid bg-body py-5">
        <div class="container">
            <div class="row row-cols-2 row-cols-sm-2 row-cols-md-6">

                <div class="col px-3 py-5 border">
                    <a href="https://ethereum.org/en/" target="_blank" class="nav-link" rel="nofollow noopener">
                        <img src="/assets/img/partnerNetworkLogo/eth.png" class="img-fluid" alt="Ethereum" />
                    </a>
                </div>

                <div class="col px-3 py-5 border">
                    <a href="https://www.bnbchain.org/en/smartChain" target="_blank" class="nav-link" rel="nofollow noopener">
                        <img src="/assets/img/partnerNetworkLogo/bsc.png" class="img-fluid" alt="Binance Smart Chain" />
                    </a>
                </div>

                <div class="col px-3 py-5 border">
                    <a href="https://polygon.technology/" target="_blank" class="nav-link" rel="nofollow noopener">
                        <img src="/assets/img/partnerNetworkLogo/polygon.png" class="img-fluid" alt="Polygon" />
                    </a>
                </div>

                <div class="col px-3 py-5 border">
                    <a href="https://www.avax.com/" target="_blank" class="nav-link" rel="nofollow noopener">
                        <img src="/assets/img/partnerNetworkLogo/avalanche.png" class="img-fluid" alt="Avalanche Chain" />
                    </a>
                </div>

                <div class="col px-3 py-5 border">
                    <a href="https://arbitrum.io/" target="_blank" class="nav-link" rel="nofollow noopener">
                        <img src="/assets/img/partnerNetworkLogo/arbitrum.png" class="img-fluid" alt="Arbitrum" />
                    </a>
                </div>

                <div class="col px-3 py-5 border">
                    <a href="https://fantom.foundation/" target="_blank" class="nav-link" rel="nofollow noopener">
                        <img src="/assets/img/partnerNetworkLogo/fantom.png" class="img-fluid" alt="Fantom" />
                    </a>
                </div>

                <div class="col px-3 py-5 border">
                    <a href="https://www.optimism.io/" target="_blank" class="nav-link" rel="nofollow noopener">
                        <img src="/assets/img/partnerNetworkLogo/optimism.png" class="img-fluid" alt="Optimism" />
                    </a>
                </div>

                <div class="col px-3 py-5 border">
                    <a href="https://syscoin.org/" target="_blank" class="nav-link" rel="nofollow noopener">
                        <img src="/assets/img/partnerNetworkLogo/syscoin.png" class="img-fluid" alt="Syscoin" />
                    </a>
                </div>

                <div class="col px-3 py-5 border">
                    <a href="https://unstoppabledomains.com/" target="_blank" class="nav-link" rel="nofollow noopener">
                        <img src="/assets/img/partnerNetworkLogo/unstabledomain.png" class="img-fluid" alt="Unstable Domain" />
                    </a>
                </div>

                <div class="col px-3 py-5 border">
                    <a href="https://ankr.com/" target="_blank" class="nav-link" rel="nofollow noopener">
                        <img src="/assets/img/partnerNetworkLogo/ankr.png" class="img-fluid" alt="Ankr" />
                    </a>
                </div>

                <div class="col px-3 py-5 border">
                    <a href="https://b-r-group.com/" target="_blank" class="nav-link" rel="nofollow noopener">
                        <img src="/assets/img/partnerNetworkLogo/br-group.png" class="img-fluid" alt="BR Group" />
                    </a>
                </div>

                <div class="col px-3 py-5 border">
                    <a href="https://freename.io/" target="_blank" class="nav-link" rel="nofollow noopener">
                        <img src="/assets/img/partnerNetworkLogo/freename-ltd.png" class="img-fluid" alt="Freename" />
                    </a>
                </div>

                <div class="col px-3 py-5 border">
                    <a href="https://floki.com/" target="_blank" class="nav-link" rel="nofollow noopener">
                        <img src="/assets/img/partnerNetworkLogo/floki.png" class="img-fluid" alt="Floki" />
                    </a>
                </div>

                <div class="col px-3 py-5 border">
                    <a href="https://space.id/" target="_blank" class="nav-link" rel="nofollow noopener">
                        <img src="/assets/img/partnerNetworkLogo/spaceid.png" class="img-fluid" alt="Space ID" />
                    </a>
                </div>

                <div class="col px-3 py-5 border">
                    <a href="https://bonfida.org/en" target="_blank" class="nav-link" rel="nofollow noopener">
                        <img src="/assets/img/partnerNetworkLogo/bonfida.png" class="img-fluid" alt="Bonfida" />
                    </a>
                </div>

                <div class="col px-3 py-5 border">
                    <a href="https://hypelab.com/" target="_blank" class="nav-link" rel="nofollow noopener">
                        <img src="/assets/img/partnerNetworkLogo/hypelab.png" class="img-fluid" alt="Hypelab" />
                    </a>
                </div>

                <div class="col px-3 py-5 border">
                    <a href="https://bitmedia.io/" target="_blank" class="nav-link" rel="nofollow noopener">
                        <img src="/assets/img/partnerNetworkLogo/bitmedia.io.png" class="img-fluid" alt="bitmedia.io" />
                    </a>
                </div>

            </div>
        </div>
    </div>
</main>