<?php
$url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$parsedUrl = parse_url($url);
$path = explode('/', $parsedUrl['path']);
global $tokenName;
$tokenName = $path[2];

$allCoinsData = json_decode(file_get_contents("assets/doc/allCoinList.json"));

$tokenInfo = [];

$tokenSearch = array_filter($allCoinsData, function ($token) {
    global $tokenName;

    $name = str_replace(' ', '--', strtolower($token->name));
    $symbol = str_replace(' ', '--', strtolower($token->symbol));

    return strpos($name, strtolower($tokenName)) !== false || strpos($symbol, strtolower($tokenName)) !== false;
});

$dataError = count($tokenSearch) ? false : true;

foreach ($tokenSearch as $foundToken) {
    $tokenInfo = $foundToken;
}
?>
<main class="position-relative" style="background-color: #f4f5fb">
    <!-- // Network Details -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row g-0">
                    <div class="col ps-2 pt-3 position-relative">
                        <h1 class="d-inline-block">
                            <span class="ms-2 h2 fw-bold">Token</span>
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
                                    <div class="table-responsive">
                                        <table class="table" id="tokenPlatformsTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">
                                                        Name
                                                    </th>
                                                    <th scope="col">
                                                        Symbol
                                                    </th>
                                                    <th scope="col">
                                                        Platforms
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
                                                    <?php foreach ($tokenSearch as $token) : ?>
                                                        <tr>
                                                            <td><?= $token->name; ?></td>
                                                            <td><?= $token->symbol; ?></td>
                                                            <td>
                                                                <div class="table-responsive">
                                                                    <table class="table table-sm table-borderless" id="domainNamePlatformsTable">
                                                                        <tbody>
                                                                            <?php foreach ($token->platforms as $key => $value) : ?>
                                                                                <tr>
                                                                                    <td>
                                                                                        <a class="text-muted text-decoration-none platformTag h6" href="<?= SITE_URL; ?>/address/<?= $value; ?>">
                                                                                            <span class="badge bg-body-secondary text-dark fw-medium">
                                                                                                <?= $key; ?>
                                                                                            </span>
                                                                                        </a>
                                                                                    </td>
                                                                                    <td>
                                                                                        <a class="text-muted text-decoration-none h6" id="platformTag" href="<?= SITE_URL; ?>/address/<?= $value; ?>" data-bs-toggle="tooltip" data-bs-title="<?= $value; ?>">
                                                                                            <span class="badge bg-body-secondary text-dark fw-medium">
                                                                                                <?= $value; ?>
                                                                                            </span>
                                                                                        </a>
                                                                                    </td>
                                                                                <?php endforeach; ?>
                                                                        <tbody>
                                                                    </table>
                                                                </div>
                                                            </td>
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
    </div>
</main>