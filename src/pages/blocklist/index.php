<main class="position-relative" style="background-color: #f4f5fb">
    <!-- // Network Details -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row g-0">
                    <div class="col ps-2 pt-3 position-relative">
                        <h1 class="d-inline-block">
                            <span class="ms-2 h2 fw-bold">Blocks</span>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $blocksData = $atsData->getBlockList();
    ?>
    <div class="container py-3 rounded-0">
        <div class="row mb-5">
            <div class="col-12">
                <div class="card bg-white border">
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-hover" id="blockListTable">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    Height
                                                </th>
                                                <th scope="col">
                                                    Last Seen
                                                </th>
                                                <th scope="col">
                                                    Tx Count
                                                </th>
                                                <th scope="col">
                                                    Block hash
                                                </th>
                                                <th scope="col">
                                                    Gas limit
                                                </th>
                                                <th scope="col">
                                                    Gas used
                                                </th>
                                                <th scope="col">
                                                    Miner address
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (isset($blocksData[0]["error"])) : ?>
                                                <tr>
                                                    <td colspan="20">No data!</td>
                                                </tr>
                                            <?php else : ?>
                                                <?php foreach ($blocksData as $blockData) : ?>
                                                    <?php $block = $blockData["result"]["blocks"][0]; ?>
                                                    <tr>
                                                        <td><img src="https://alltoscan.com/assets/img/networkLogo/<?= $block["blockchain"]; ?>.webp" width="24" height="24"> <a href="/block/<?= $block["blockchain"]; ?>/<?= hexToDate($block["number"]); ?>"><?= hexToDate($block["number"]); ?></a></td>
                                                        <td><?= timeAgo(hexToDate($block["timestamp"])); ?></td>
                                                        <td><?= count($block["transactions"]) ?></td>
                                                        <td><a href="/tx/<?= $block["blockchain"]; ?>/<?= $block["hash"]; ?>"><?= walletAddressShort($block["hash"]); ?></a></td>
                                                        <td><?= number_format(hexConverter($block["gasLimit"]), 18); ?></td>
                                                        <td><?= number_format(hexConverter($block["gasUsed"]), 18); ?></td>
                                                        <td><a href="/address/<?= $block["miner"]; ?>"><?= walletAddressShort($block["miner"]); ?></a></td>
                                                    </tr>
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