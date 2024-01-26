<?php
$pageData = json_decode(json_encode($atsData->getHomeData()));
$dataError = !$pageData[0]->latest_block ? true : false;
?>
<main class="position-relative" style="background-color: #f4f5fb">
    <!-- // Network Details -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row g-0">
                    <div class="col ps-2 pt-3 position-relative">
                        <h1 class="d-inline-block">
                            <span class="ms-2 h2 fw-bold">Transactions</span>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-3 rounded-0">
        <div class="row mb-5">
            <div class="col-12">
                <div class="card bg-white border">
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-hover" id="transactionListTable">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    Txn Hash
                                                </th>
                                                <th scope="col">
                                                    Block
                                                </th>
                                                <th scope="col">
                                                    Last Seen
                                                </th>
                                                <th scope="col">
                                                    From
                                                </th>
                                                <th scope="col">
                                                    To
                                                </th>
                                                <th scope="col">
                                                    Value
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($dataError) : ?>
                                                <tr class="loading">
                                                    <td colspan="22">
                                                        No Data!
                                                    </td>
                                                </tr>
                                            <?php else : ?>
                                                <?php foreach ($pageData as $row) : ?>
                                                    <?php if ($row->latest_transactions) : ?>
                                                        <tr>
                                                            <td><img src="https://alltoscan.com/assets/img/networkLogo/<?= $row->blockchain; ?>.webp" width="24" height="24" /> <a href="/tx/<?= $row->blockchain; ?>/<?= $row->latest_transactions->hash; ?>"><?= substr($row->latest_transactions->hash, 0, 18); ?>...</a></td>
                                                            <td><a href="/block/<?= $row->blockchain; ?>/<?= $atsUtils->decodeHex($row->latest_block); ?>"></a><?= $atsUtils->decodeHex($row->latest_block); ?></td>
                                                            <td><?= ($row->blockchain === "wan") ? "23 seconds ago" : $atsUtils->hexToTimeAgo($row->timestamp); ?></td>
                                                            <td><a href="/address/<?= $row->latest_transactions->from ?>"><?= $atsUtils->walletAddressShort($row->latest_transactions->from); ?></a></td>
                                                            <td><a href="/address/<?= $row->latest_transactions->to ?>"><?= $atsUtils->walletAddressShort($row->latest_transactions->to); ?></a></td>
                                                            <td><?= $atsUtils->hexToAmount($row->latest_transactions->value); ?></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>