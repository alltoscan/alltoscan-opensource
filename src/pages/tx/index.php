<?php
$result = $pageData->result->transactions[0];
$coinName = $atsUtils->getCoinNameFromBlockchain($result->blockchain);
?>
<main class="position-relative" style="background-color: #f4f5fb;">

    <!-- // Network Details -->
    <div class="container py-2 px-3 rounded-0 transactionInfo">
        <div class="row">
            <div class="col-12 text-center">
                <div class="ads-center text-center mb-4">
                    <ins class="6464477be76c1d099a0d8139" style="display:inline-block;width:1px;height:1px;"></ins>
                    <script>
                        ! function(e, n, c, t, o, r, d) {
                            ! function e(n, c, t, o, r, m, d, s, a) {
                                s = c.getElementsByTagName(t)[0], (a = c.createElement(t)).async = !0, a.src = "https://" + r[m] + "/js/" + o + ".js?v=" + d, a.onerror = function() {
                                    a.remove(), (m += 1) >= r.length || e(n, c, t, o, r, m)
                                }, s.parentNode.insertBefore(a, s)
                            }(window, document, "script", "6464477be76c1d099a0d8139", ["cdn.bmcdn5.com"], 0, new Date().getTime())
                        }();
                    </script>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-12">
                <?php if ($dataError) : ?>
                    <div class="card bg-white border">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">No Data!</div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="card bg-white border">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row border-bottom py-2">
                                            <div class="col-12 col-md-6 col-lg-3">
                                                Blockchain:
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-9">
                                                <?= strtoupper($result->blockchain); ?>
                                            </div>
                                        </div>
                                        <div class="row border-bottom py-2">
                                            <div class="col-12 col-md-6 col-lg-3">
                                                Hash:
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-9">
                                            <a href="/tx/<?= strtolower($result->blockchain); ?>/<?= $result->hash; ?>">
                                                <?= $result->hash; ?>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row border-bottom py-2">
                                            <div class="col-12 col-md-6 col-lg-3">
                                                Status:
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-9">
                                                <?= $atsUtils->fixStatus($atsUtils->decodeHex($result->status)); ?>
                                            </div>
                                        </div>
                                        <div class="row border-bottom py-2">
                                            <div class="col-12 col-md-6 col-lg-3">
                                                Block Height:
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-9">
                                                <a href="/block/<?= strtolower($result->blockchain); ?>/<?= $atsUtils->decodeHex($result->blockNumber); ?>">
                                                    <?= $atsUtils->decodeHex($result->blockNumber); ?>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row border-bottom py-2">
                                            <div class="col-12 col-md-6 col-lg-3">
                                                Timestamp:
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-9">
                                                <?= $atsUtils->hexToTimeAgo($result->timestamp); ?>
                                            </div>
                                        </div>
                                        <div class="row border-bottom py-2">
                                            <div class="col-12 col-md-6 col-lg-3">
                                                From Address:
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-9">
                                                <a href="/address/<?= $result->from; ?>/<?= strtolower($result->blockchain); ?>">
                                                    <?= $result->from; ?>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row border-bottom py-2">
                                            <div class="col-12 col-md-6 col-lg-3">
                                                To Address:
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-9">
                                                <a href="/address/<?= $result->to; ?>/<?= strtolower($result->blockchain); ?>">
                                                    <?= $result->to; ?>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row border-bottom py-2">
                                            <div class="col-12 col-md-6 col-lg-3">
                                                Value:
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-9">
                                                <?= $atsUtils->hexToAmount($result->value) . " " . $coinName; ?>
                                            </div>
                                        </div>
                                        <div class="row border-bottom py-2">
                                            <div class="col-12 col-md-6 col-lg-3">
                                                Gas:
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-9">
                                                <?= $atsUtils->hexToAmount($result->gas) . " " . $coinName; ?>
                                            </div>
                                        </div>
                                        <div class="row border-bottom py-2">
                                            <div class="col-12 col-md-6 col-lg-3">
                                                Gas price:
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-9">
                                                <?= $atsUtils->hexToAmount($result->gasPrice) . " " . $coinName; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>