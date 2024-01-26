<footer class="container-fluid shadow-lg h-auto border-top bg-light">
    <div class="container">
        <div class="row py-4 border-bottom">
            <div class="col-6 text-start">
                <a class="link-underline link-underline-opacity-0 link-dark pe-2" href="https://twitter.com/alltoscan/" rel="nofollow noopener">
                    𝕏
                </a>
                <a class="link-underline link-underline-opacity-0 link-dark pe-2" href="https://alltoscan.medium.com/" rel="nofollow noopener">
                    <i class="fa-brands fa-medium"></i>
                </a>
                <a class="link-underline link-underline-opacity-0 link-dark pe-2" href="https://t.me/alltoscan" rel="nofollow noopener">
                    <i class="fa-brands fa-telegram"></i>
                </a>
            </div>
            <div class="col-6 text-end">
                <a class="nav-link" id="back-to-top" href="#">
                    <i class="far fa-arrow-up-to-line me-2"></i> Back to Top
                </a>
            </div>
        </div>

        <div class="row justify-content-between py-4">
            <div class="col-12 col-lg-4 text-center text-lg-start">
                <span>
                    <img src="assets/img/logo/alltoscan-logo.png" width="125" alt="Multi-chain Blockchain Explorer">
                </span>
                <p class="small pt-3">Alltoscan is a Block Explorer and Analytics Platform for all supported chains, a decentralized smart contract platform.</p>
                <p>
                    <img src="assets/img/logo/map.png" class="w-50 text-center d-none" alt="Map Image">
                </p>
            </div>

            <div class="col-6 col-lg-2 text-start">
                <h6 class="small fw-bold">Company</h6>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2 small d-none"><a href="#" class="nav-link d-inline-block p-0 text-muted">About US</a></li>
                    <li class="nav-item mb-2 small"><a href="/brand-assets" class="nav-link d-inline-block p-0 text-muted">Brand Assets</a></li>
                    <li class="nav-item mb-2 small d-none"><a href="#" class="nav-link d-inline-block p-0 text-muted">Contact US</a></li>
                    <li class="nav-item mb-2 small"><a href="/terms-of-service" class="nav-link d-inline-block p-0 text-muted">Terms of Service</a></li>
                    <li class="nav-item mb-2 small"><a href="/privacy-policies" class="nav-link d-inline-block p-0 text-muted">Privacy Policies</a></li>
                </ul>
            </div>

            <?php /*
            <div class="col-4 col-lg-3 d-none">
                <h6 class="small fw-bold">Community</h6>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2 small"><a href="#" class="nav-link d-inline-block p-0 text-muted">Knowledge Base</a></li>
                    <li class="nav-item mb-2 small"><a href="#" class="nav-link d-inline-block p-0 text-muted">Newsletter</a></li>
                    <li class="nav-item mb-2 small"><a href="#" class="nav-link d-inline-block p-0 text-muted">Query Info</a></li>
                    <li class="nav-item mb-2 small"><a href="#" class="nav-link d-inline-block p-0 text-muted">Network Status</a></li>
                </ul>
            </div>

            */ ?>

            <div class="col-6 col-lg-4">
                <h6 class="small fw-bold">Products & Services</h6>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2 small">
                        <a href="/advertise" class="nav-link d-inline-block p-0 text-muted">Advertise</a>
                    </li>
                    <li class="nav-item mb-2 small">
                        <a href="https://goldexplus.com" class="nav-link d-inline-block p-0 text-muted" rel="nofollow noopener">GoldexPlus</a>
                    </li>
                    <li class="nav-item mb-2 small">
                        <a href="<?php echo NEWS_PAGE; ?>" class="nav-link d-inline-block p-0 text-muted" rel="nofollow noopener">Alltoscan News</a>
                    </li>

                    <?php /*
                    <li class="nav-item mb-2 small d-none"><a href="#" class="nav-link d-inline-block p-0 text-muted">Blog</a></li>
                    <li class="nav-item mb-2 small d-none"><a href="#" class="nav-link d-inline-block p-0 text-muted">Partners</a></li>
                    <li class="nav-item mb-2 small d-none"><a href="" class="nav-link d-inline-block p-0 text-muted">Release Notes
                            (Soon)</a></li>
                    <li class="nav-item mb-2 small d-none"><a href="" class="nav-link d-inline-block p-0 text-muted">Address Verification
                            (Soon)</a></li>
                    */ ?>
                </ul>
            </div>

        </div>

        <div class="row border-top">
            <div class="col-12 col-lg-6 my-auto py-2">
                <p class="text-center text-lg-start small m-0">©
                    <?php echo date('Y'); ?> Copyright Alltoscan. All Rights Reserved.
                </p>
            </div>
            <div class="col-12 col-lg-6 my-auto py-2 text-center text-lg-end">
                <p class="small m-0">
                    <span>Donations: </span><a href="address/0x59af40B068c659393A612F870FAe7C24BbD0674E">
                        <?php echo walletAddressShort('0x59af40B068c659393A612F870FAe7C24BbD0674E', 5, 5); ?> <i class="fas fa-heart text-danger"></i>
                    </a>
                </p>
            </div>
        </div>
    </div>
</footer>

<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="CopyMessage" class="toast text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body">The address was copied.</div>
    </div>
</div>
<script type="text/javascript" src="assets/vendors/jquery-3.6.4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script type="text/javascript" src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="assets/vendors/blockies/blockies.min.js"></script>
<script type="text/javascript" src="assets/vendors/blockies/hqx.js"></script>
<?php if ($_GET["page"] != "main-page" || $_GET["page"] != "domainSearch") { ?>
    <script type="text/javascript" src="assets/js/allToScan.js?v=<?= microtime(); ?>"></script>
<?php } ?>
<script type="text/javascript" src="assets/js/customJS.js"></script>
<?php
if (file_exists("src/pages/" . $PAGE . "/script_footer.php")) {
    include("pages/" . $PAGE . "/script_footer.php");
}
?>
</body>

</html>