<main class="position-relative" style="background-color: #f4f5fb">
    <!-- // Network Details -->
    <div class="container py-4 px-3 rounded-0" id="blockInfoTable">
        <div class="row">
            <div class="col-12 text-center">
                <div class="ads-center ms-auto position-relative" id="">
                    <iframe src="assets/img/ads/bcgame/index.html" frameborder="0" style="overflow:hidden;overflow-x:hidden;overflow-y:hidden;height:90px;width:970px;position:relative;top:0px;left:0px;right:0px;bottom:0px;" height="90px" width="970px"></iframe>
                    <div id="clickOverlay"><a class="position-relative d-block w-100 h-100" href="https://bcgame.top/i-lcr18zdv-n/"></a></div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-12">
                <?php if ($dataError) : ?>
                    <div class="card bg-white border">No Data!</div>
                <?php else : ?>
                    <?php $row = $pageData->result->blocks[0]; ?>
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
                                                <?= strtoupper($row->blockchain); ?>
                                            </div>
                                        </div>
                                        <div class="row border-bottom py-2">
                                            <div class="col-12 col-md-6 col-lg-3">
                                                Block Height:
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-9">
                                                <a href="/block/<?= strtolower($row->blockchain); ?>/<?= $atsUtils->decodeHex($row->number); ?>">
                                                    <?= $atsUtils->decodeHex($row->number); ?>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row border-bottom py-2">
                                            <div class="col-12 col-md-6 col-lg-3">
                                                Timestamp:
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-9">
                                                <?= $atsUtils->hexToTimeAgo($row->timestamp); ?>
                                            </div>
                                        </div>
                                        <div class="row border-bottom py-2">
                                            <div class="col-12 col-md-6 col-lg-3">
                                                Quantities of transactions:
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-9">
                                                <?= count($row->transactions); ?>
                                            </div>
                                        </div>
                                        <div class="row border-bottom py-2">
                                            <div class="col-12 col-md-6 col-lg-3">
                                                Mine address:
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-9">
                                                <a href="/address/<?= $row->miner; ?>"><?= $row->miner; ?></a>
                                            </div>
                                        </div>
                                        <div class="row border-bottom py-2">
                                            <div class="col-12 col-md-6 col-lg-3">
                                                Size:
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-9">
                                                <?= $atsUtils->decodeHex($row->size); ?>
                                            </div>
                                        </div>
                                        <div class="row border-bottom py-2">
                                            <div class="col-12 col-md-6 col-lg-3">
                                                Gas used:
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-9">
                                                <?= $atsUtils->decodeHex($row->gasUsed); ?>
                                            </div>
                                        </div>
                                        <div class="row border-bottom py-2">
                                            <div class="col-12 col-md-6 col-lg-3">
                                                Gas Limit:
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-9">
                                                <?= $atsUtils->decodeHex($row->gasLimit); ?>
                                            </div>
                                        </div>
                                        <div class="row border-bottom py-2">
                                            <div class="col-12 col-md-6 col-lg-3">
                                                Extra data:
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-9">
                                                <?= $row->extraData; ?>
                                            </div>
                                        </div>
                                        <div class="row border-bottom py-2">
                                            <div class="col-12 col-md-6 col-lg-3">
                                                Block hash:
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-9">
                                                <?= $row->hash; ?>
                                            </div>
                                        </div>
                                        <div class="row border-bottom py-2">
                                            <div class="col-12 col-md-6 col-lg-3">
                                                Parent hash:
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-9">
                                                <a href="/block/<?= $row->blockchain; ?>/<?= $atsUtils->decodeHex($row->number) - 1 ?>"><?= $row->parentHash; ?></a>
                                            </div>
                                        </div>
                                        <div class="row border-bottom py-2">
                                            <div class="col-12 col-md-6 col-lg-3">
                                                Sha3 uncles:
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-9">
                                                <?= $row->sha3Uncles; ?>
                                            </div>
                                        </div>
                                        <div class="row border-bottom py-2">
                                            <div class="col-12 col-md-6 col-lg-3">
                                                State root:
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-9">
                                                <?= $row->stateRoot; ?>
                                            </div>
                                        </div>
                                        <?php /*
                                        <div class="row border-bottom py-2">
                                            <div class="col-12 col-md-6 col-lg-3">
                                                transactions:
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-9">
                                                <a class="text-info" data-bs-toggle="collapse" href="#transactionsTable" role="button" aria-expanded="false" aria-controls="transactionsTable">+ Click to show transaction on <?= $atsUtils->decodeHex($row->number); ?></a>
                                            </div>
                                        </div>
                                        */ ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4" id="transactionsTable">
                        <h1 class="d-block h5 fw-bold ps-2">Transactions</h1>
                        <h6 class="small ps-2 mb-4">For Block <?= $atsUtils->decodeHex($row->number); ?> </h6>
                        <div class="card bg-white border">
                            <div class="card-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table" id="transTable">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Hash</th>
                                                            <th scope="col">Block Number</th>
                                                            <th scope="col">Timestamp</th>
                                                            <th scope="col">From</th>
                                                            <th scope="col">To</th>
                                                            <th scope="col">Value</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                        foreach ($row->transactions as $transactions) { ?>
                                                            <tr>
                                                                <td><a href="/tx/<?=$row->blockchain;?>/<?=$transactions->hash?>"><?php echo walletAddressShort($transactions->hash, 8, 8); ?></a></td>
                                                                <td><a href="/block/<?=$row->blockchain;?>/<?= $atsUtils->decodeHex($transactions->blockNumber)?>"> <?= $atsUtils->decodeHex($transactions->blockNumber); ?></a></td>
                                                                <td><?= $atsUtils->hexToTimeAgo($row->timestamp); ?></td>
                                                                <td><a href="/address/<?= $transactions->from; ?>"><?php echo walletAddressShort($transactions->from, 8, 8); ?></a></td>
                                                                <td><a href="/address/<?= $transactions->to; ?>"><?php echo walletAddressShort($transactions->to, 8,8); ?></a></td>
                                                                <td><?php echo decimalZeroClear(number_format($atsUtils->hexToAmount($transactions->value),8)); ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
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