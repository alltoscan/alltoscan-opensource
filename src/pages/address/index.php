<main class="position-relative" style="background-color: #f4f5fb">
    <div class="container py-4 px-3 rounded-0 allToScanResult_address">
        <div class="row">
            <div class="col-12 text-center">
                <div class="ads-center text-center mb-4">
                    <?php if (isMobile()){ ?>
                    <div id="mobile300250" class="d-flex justify-content-center" style="height: 250px;"></div>
                    <?php }else{ ?>
                    <div id="banner72890" class="d-flex justify-content-center" style="height: 90px;"></div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-12">
                <div class="card bg-white border">
                    <div class="card-body">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab" tabindex="0">
                                <ul class="nav nav-tabs" id="allTab" role="tablist">
                                    
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="allTransfer-tab" data-bs-toggle="tab" data-bs-target="#allTransfer" aria-labelledby="allTransfer-tab" type="button" role="tab" aria-controls="allTransfer" aria-selected="false">
                                            Transactions
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="tokenTransfers-tab" data-bs-toggle="tab" data-bs-target="#tokenTransfers" aria-labelledby="tokenTransfers-tab" type="button" role="tab" aria-controls="tokenTransfers" aria-selected="false" <?php if($address != $adsAddress && $address != $adsAddress2){ ?> onclick="ATS.getTokenTransfersByAddress();" <?php } ?>>
                                            Token Transfers
                                        </button>
                                    </li>
                                    
                                    <li class="nav-item d-none" role="presentation">
                                        <button class="nav-link disabled" id="allNFT-tab" data-bs-toggle="tab" data-bs-target="#allNFT" type="button" role="tab" aria-controls="allNFT" aria-selected="false">
                                            Internal Transactions
                                        </button>
                                    </li>
                                    <li class="nav-item d-none" role="presentation">
                                        <button class="nav-link disabled" id="allNFT-tab" data-bs-toggle="tab" data-bs-target="#allNFT" type="button" role="tab" aria-controls="allNFT" aria-selected="false">
                                            Analytics
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="allTabContent">

                                    <?php if($address != $adsAddress && $address != $adsAddress2){ ?>

                                    <div class="tab-pane fade active show" id="allTransfer" role="tabpanel" aria-labelledby="allTransfer-tab" tabindex="0">
                                        <div class="table-responsive">
                                            <table style="width: 100%" id="transactionsTable" class="table display dt-responsive nowrap" data-order='[[ 2, "asc" ]]'>
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="col text-start">
                                                            Txn Hash
                                                        </th>
                                                        <th scope="col" class="col text-start">
                                                            Method
                                                        </th>
                                                        <th scope="col" class="col text-start">
                                                            Last Seen
                                                        </th>
                                                        <th scope="col" class="col text-start">
                                                            Block
                                                        </th>
                                                        <th scope="col" class="col text-start">
                                                            From
                                                        </th>
                                                        <th scope="col" class="col text-start">
                                                            In / Out
                                                        </th>
                                                        <th scope="col" class="col text-start">
                                                            To
                                                        </th>
                                                        <th scope="col" class="col text-start">
                                                            Value
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if($address != $adsAddress && $address != $adsAddress2){ ?>
                                                    <?php if ($transactionsDataError) : ?>
                                                        <tr>
                                                            <td colspan="20">No Data!</td>
                                                        </tr>
                                                    <?php else : ?>
                                                        <?php foreach ($transactionList->result->transactions as $row) : ?>
                                                            <tr data-filter-string="<?= $row->blockchain; ?>>">
                                                                <td><img src="assets/img/networkLogo/<?= $row->blockchain; ?>.webp" width="24" height="24" alt="<?= $row->blockchain; ?> logo"> <a href="/tx/<?= $row->blockchain; ?>/<?= $row->hash; ?>"><?= substr($row->hash, 0, 12); ?>...</a></td>
                                                                <td>
                                                                    <div class="p-2 rounded-1" style="display:flex; justify-content:center; align-items:center; font-size:12px; font-weight:bold; background-color: #F2F5FA; height: 30px;vertical-align: middle;">Transfer</div>
                                                                </td>
                                                                <td><?= $atsUtils->hexToTimeAgo($row->timestamp); ?></td>
                                                                <td><a href="/block/<?= $row->blockchain ?>/<?= $atsUtils->decodeHex($row->blockNumber); ?>"><?= $atsUtils->decodeHex($row->blockNumber); ?></a></td>
                                                                <td><a href="/address/<?= $row->from; ?>"><?= $atsUtils->walletAddressShort($row->from); ?></a></td>
                                                                <td>
                                                                    <?php if ($row->v !== "0x1") : ?>
                                                                        <div class="p-2 rounded-1" style="display:flex; justify-content:center; align-items:center; font-size:12px; font-weight:bold; width:55px; background-color: rgba(227, 54, 47, .5); color:rgba(227, 54, 47, 1); height: 30px;vertical-align: middle;">
                                                                            OUT
                                                                        </div>
                                                                    <?php else : ?>
                                                                        <div class="p-2 rounded-1" style="display:flex; justify-content:center; align-items:center; font-size:12px; font-weight:bold; width:55px; background-color: rgba(18, 147, 115, .5); color:rgba(18, 147, 115, 1); height: 30px;vertical-align: middle;">
                                                                            IN
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td><a href="/address/<?= $row->to; ?>"><?= $atsUtils->walletAddressShort($row->to); ?></a></td>
                                                                <td><?= formatMoney($atsUtils->hexToAmount($row->value), 1); ?> <?= $atsUtils->getCoinNameFromBlockchain($row->blockchain); ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                            <div style="text-align : center;">
                                                <?php if($address != $adsAddress && $address != $adsAddress2){ ?>
                                                <button class="btn btn-primary pull-right" data-address="<?= $address; ?>" data-token="<?= $nextPageToken; ?>" data-chain="<?= $chain; ?>" data-type="txList" onclick="ATS.nextPage(this);">
                                                    Load More
                                                </button>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>

                                    <?php if($address != $adsAddress && $address != $adsAddress2){ ?>

                                    <div class="tab-pane" id="tokenTransfers" role="tabpanel" aria-labelledby="tokenTransfers-tab" tabindex="0">
                                        <div class="table-responsive">
                                            <table style="width: 100%" id="tokenTransfersTable" class="table display dt-responsive nowrap" data-order='[[ 2, "asc" ]]'>
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="text-start">
                                                            Txn Hash
                                                        </th>
                                                        <th scope="col" class="text-start">
                                                            Last Seen
                                                        </th>
                                                        <th scope="col" class="text-start">
                                                            From
                                                        </th>
                                                        <th scope="col" class="text-start">
                                                            In / Out
                                                        </th>
                                                        <th scope="col" class="text-start">
                                                            To
                                                        </th>
                                                        <th scope="col" class="text-start">
                                                            Value
                                                        </th>
                                                        <th scope="col" class="text-start">
                                                            Token
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="allNFT" role="tabpanel" aria-labelledby="allNFT-tab" tabindex="0">
                                        <div class="table-responsive">
                                            <table style="width: 100%" id="allNFTable" class="table display dt-responsive nowrap" data-order='[[ 2, "asc" ]]'>
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="w-25 text-start">
                                                            Txn Hash
                                                        </th>
                                                        <th scope="col" class="text-start">
                                                            Last Seen
                                                        </th>
                                                        <th scope="col" class="text-start">
                                                            From
                                                        </th>
                                                        <th scope="col" class="text-start">
                                                            In / Out
                                                        </th>
                                                        <th scope="col" class="text-start">
                                                            To
                                                        </th>
                                                        <th scope="col" class="text-start">
                                                            Type
                                                        </th>
                                                        <th scope="col" class="text-start">
                                                            Item
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
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
</main>