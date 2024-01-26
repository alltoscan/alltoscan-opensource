<script>
    document.addEventListener("keypress", (event) => {
        if (event.keyCode === 13) document.getElementById("searchButton").click();
    });
</script>
<div class="container-fluid bg-white pt-4">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-7">
                <div class="row">
                    <div class="col-12 col-lg-8 d-flex align-self-end">
                        <h1 class="h4 mb-4 blue-900 text-center text-lg-start">
                            Multichain Blockchain Explorer
                        </h1>
                    </div>
                </div>
                <div class="input-group input-group-lg rounded-0">
                    <input type="text" class="form-control py-1 shadow-none" placeholder="Search by Address / transaction / block" aria-label="Search by Address / transaction / block" aria-describedby="searchButton" id="searchInput" />
                    <button class="btn b-blue-900 text-white" type="button" id="searchButton" onclick="ATS.search();">
                        <i class="fa-solid fa-magnifying-glass fa-sm"></i>
                    </button>
                </div>
                <div class="my-2 ps-2">
                    <span class="fw-bold">Alltoscan</span> - Sponsored slots available.
                    <a class="nav-link d-inline-block text-muted" href="https://bitmedia.io/" rel="nofollow noopener">
                        <span id="topTextAds" style="color: royalblue;">Book your slot here!</span>
                    </a>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                
                <div class="ads-center text-center mb-4">
                    <?php
                    // Reklam kodları
                    $bitmedia = '<ins class="64942874de08a032b32b4817" style="display:inline-block;width:1px;height:1px;"></ins><script>!function(e,n,c,t,o,r,d){!function e(n,c,t,o,r,m,d,s,a){s=c.getElementsByTagName(t)[0],(a=c.createElement(t)).async=!0,a.src="https://"+r[m]+"/js/"+o+".js?v="+d,a.onerror=function(){a.remove(),(m+=1)>=r.length||e(n,c,t,o,r,m)},s.parentNode.insertBefore(a,s)}(window,document,"script","64942874de08a032b32b4817",["cdn.bmcdn5.com"], 0, new Date().getTime())}();</script>';
                    $atsToken = '<a href="https://ats.alltoscan.com/raffle"><img src="assets/img/advertise/320x100.jpg" class="img-fluid" /></a>';

                    // Rastgele reklam seçimi için dizi oluştur
                    $ads = array($bitmedia, $atsToken);

                    // Eğer oturum başlamamışsa oturumu başlat
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }

                    // Eğer kullanıcı daha önce reklam görmemişse rastgele bir reklam seç ve göster
                    if (!isset($_SESSION['advertisementShown'])) {
                        $randomIndex = rand(0, count($ads) - 1);
                        echo $ads[$randomIndex];

                        // Gösterilen reklamın index numarasını oturum değişkenine kaydet
                        $_SESSION['advertisementShown'] = $randomIndex;
                    } else {
                        // Daha önce reklam gösterildiyse tekrar aynı reklamı gösterme
                        $gosterilenIndex = $_SESSION['advertisementShown'];
                        echo $ads[$gosterilenIndex];
                    }
                    ?>

                    <?php /*
                    <a href="/advertise"><img src="assets/img/ads/blank-321x101.webp"></a>
                    */ ?>
                
                    

                    
                </div>
            </div>
        </div>
    </div>
</div>