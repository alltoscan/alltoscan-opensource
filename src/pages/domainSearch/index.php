<?php

$url = tagClear($_SERVER['REQUEST_URI']);
$url = explode('/', $url);
$domainName = strtolower($url[2]);

global $isSNS;
$isSNS  = false;
$display = false;

$domainName = removeSolExtension($domainName);

$regex = '/^0x[0-9a-fA-F]{40}$/'; // regex düzenli ifadesi

if (!empty($domainName) || $domainName != NULL || $domainName != "") {
    $display = true;
    $domainData = $atsData->getDomainInfo($domainName);
} else {
    $display = false;

    $url = "https://resolve.unstoppabledomains.com/domains/?sortDirection=DESC&perPage=25";

        $headers = [
            "Authorization: Bearer 27e19871-76f6-4978-a805-0cf587a7b591"
        ];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            return "Hata: " . $error;
        }

        curl_close($ch);

        $unstoppableDomainData = json_decode($response);
}

?>
<main class="position-relative h-100 align-items-center justify-content-center" style="background-color: #f4f5fb;">

    <div class="container-fluid py-3 <?php if($display == true){ echo 'bg-white border-bottom'; } ?>">
        <!-- // Network Details -->
        <div class="container py-3">
            <div class="row">
                <div class="col-md-7 my-auto">
                    <div class="row">
                        <div class="col position-relative">    
                            <h1 class="d-inline-block">
                                <span class="h2 fw-bold">Domain Name Lookup</span>
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <form method="GET" id="domainNameSearchForm">
                                <div class="">
                                    <div class="input-group input-group-sm rounded-0">
                                        <input type="text" name="domainName" class="form-control py-2 px-4 rounded-0 shadow-none" placeholder="Domain Name" aria-label="Domain Name" aria-describedby="searchButton" id="domainNameSearchInput" />
                                        <button class="btn b-blue-900 text-white px-2 rounded-0" type="submit" id="searchButton">
                                            <i class="fa-light fa-arrow-right px-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <span class="small">Domain names allow users to interact with other addresses on-chain using human-readable names instead of long and complicated address hashes.</span>
                            <script>
                                document.getElementById("domainNameSearchForm").addEventListener("submit", (e) => {
                                    e.preventDefault();
                                    const domainName = document.querySelector('#domainNameSearchInput').value;
                                    if((domainName.length !== 0)){
                                        window.location.href = `/domainSearch/${domainName}`;
                                    }else{
                                        return;
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 my-auto">
                    <div class="ads-center text-center">
                        <div id="mobile300250" class="d-flex justify-content-center" style="height: 250px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container pt-5">
            <?php if($display == false) { ?>
            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-0 active" id="uns-tab" data-bs-toggle="pill" data-bs-target="#uns" type="button" role="tab" aria-controls="uns" aria-selected="true">Unstoppable Domains</button>
                        </li>
                    </ul>
                    
                    <div class="tab-pane fade show active" id="uns" role="tabpanel" aria-labelledby="uns-tab" tabindex="0">
                        <div class="card rounded-0 border-0">
                            <div class="card-body rounded-0">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Age</th>
                                            <th scope="col">Domain Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                
                                        <?php //printr($unstoppableDomainData); ?>
                                        <?php 
                                            $count = 1;
                                            $todayDateTime = strtotime('now');
                                            foreach ($unstoppableDomainData->data as $index => $item) { 
                                                if(strlen($item->attributes->meta->domain) < 42 ) {
                                            ?>
                                            <tr>
                                                <th scope="row"><?php echo $count; ?></th>
                                                <td>
                                                    <?php echo walletAddressShort($item->attributes->meta->owner,8,8); ?>
                                                    <span id="copyAddress" class="d-none"><?php echo $item->attributes->meta->owner; ?></span>
                                                    <span id="copy-button" class="ps-2 pt-0 h6">
                                                        <i class="fa-light fa-copy text-muted" style="cursor: pointer"></i>
                                                    </span>
                                                </td>
                                                <td><?php echo timeAgo(strtotime('-1 minute', $todayDateTime)); ?></td>
                                                <td><?php echo $item->attributes->meta->domain ?></td>
                                            </tr>
                                        <?php
                                            }
                                            $count++;
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="container mb-4">
        <?php if($display == true){ ?>

        <div class="row g-0">
            <div class="col pt-3 position-relative">
                <h1 class="d-inline-block">
                    <span class="h2 fw-bold">Domain Name <?php echo ": " . $domainName; if($isSNS){ echo '.sol'; } ?></span>
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
                    <?php if($domainData['freename'] != NULL){ ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-0 active" id="freeName-tab" data-bs-toggle="pill" data-bs-target="#freeName" type="button" role="tab" aria-controls="freeName" aria-selected="true">Freename</button>
                    </li>
                    <?php } ?>
                    <?php if($domainData['unstoppable']->meta != NULL){ ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-0 active" id="unstoppable-tab" data-bs-toggle="pill" data-bs-target="#unstoppable" type="button" role="tab" aria-controls="unstoppable" aria-selected="false">Unstoppable Domains</button>
                    </li>
                    <?php } ?>
                    <?php if($domainData['bonfida']['ownerAddress'] != 'error' && $domainData['bonfida']['domainName'] != 'error'){ ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-0 active" id="bonfida-tab" data-bs-toggle="pill" data-bs-target="#bonfida" type="button" role="tab" aria-controls="bonfida" aria-selected="false">Bonfida SNS</button>
                    </li>
                    <?php } ?>
                    <?php if($domainData['spaceid']['address'] != '0x0000000000000000000000000000000000000000'){ ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-0 active" id="spaceid-tab" data-bs-toggle="pill" data-bs-target="#spaceid" type="button" role="tab" aria-controls="spaceid" aria-selected="false">Space ID</button>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>

        <div class="tab-content" id="pills-tabContent">
            <?php if($domainData['freename'] != NULL){ ?>
            <div class="tab-pane fade show active" id="freeName" role="tabpanel" aria-labelledby="freeName-tab" tabindex="0">
                <div class="card rounded-0 border-0">
                    <div class="card-body rounded-0">
                        <?php //if ($display == true) { ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="card bg-white border-0 rounded-0">
                                    <div class="card-body">
                                        <div class="container">

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row border-bottom py-2">
                                                        <div class="col-12 col-md-6 col-lg-3">
                                                            <span class="fw-bold">Domain name</span>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-9">
                                                            <span><?php echo $domainData['freename']['host']; ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row border-bottom py-2">
                                                        <div class="col-12 col-md-6 col-lg-3">
                                                            <span class="fw-bold">Network</span>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-9">
                                                            <span><span><?php echo $domainData['freename']['network']; ?></span></span>
                                                        </div>
                                                    </div>
                                                    <div class="row border-bottom py-2">
                                                        <div class="col-12 col-md-6 col-lg-3">
                                                            <span class="fw-bold">Type</span>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-9">
                                                            <span><span><?php echo $domainData['freename']['tld']; ?></span></span>
                                                        </div>
                                                    </div>
                                                    <div class="row border-bottom py-2">
                                                        <div class="col-12 col-md-6 col-lg-3">
                                                            <span class="fw-bold">Token ID</span>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-9">
                                                            <span><span><?php echo $domainData['freename']['tokenID']; ?></span></span>
                                                        </div>
                                                    </div>
                                                    <?php if($domainData['freename']['records']) : ?>
                                                    <div class="row py-2">
                                                        <div class="col-12 col-md-6 col-lg-3">
                                                            <span class="fw-bold">Records</span>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-9">
                                                            <div class="table-responsive">
                                                                <table class="table table-hover" id="domainNamePlatformsTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">
                                                                                Type
                                                                            </th>
                                                                            <th scope="col">
                                                                                Value
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        foreach ($domainData['freename']['records'] as $record) {
                                                                            if (is_array($record) || is_object($record)) {
                                                                                //$key    = $record['key'];
                                                                                $type   = $record['type'];
                                                                                $value  = $record['value'];

                                                                                $regex = '/^0x[0-9a-fA-F]{40}$/'; // regex düzenli ifadesi
                                                                                $address = $value; // kontrol edilecek adres
                                                                                if (preg_match($regex, $address)) {
                                                                                    $address = "<a href='/address/$address'>$address</a>";
                                                                                } else {
                                                                                    $address = $value;
                                                                                }
                                                                                echo "
                                                                                    <tr>
                                                                                        <td>$type</td>
                                                                                        <td>$address</td>
                                                                                    </tr>
                                                                                ";
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php //} ?>
            
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php if($domainData['unstoppable']->meta != NULL){ ?>
            <div class="tab-pane fade show active" id="unstoppable" role="tabpanel" aria-labelledby="unstoppable-tab" tabindex="0">
                <div class="card rounded-0 border-0">
                    <div class="card-body rounded-0">
                        <?php //if ($display == true) { ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="card bg-white border-0 rounded-0">
                                    <div class="card-body">
                                        <div class="container">

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row border-bottom py-2">
                                                        <div class="col-12 col-md-6 col-lg-3">
                                                            <span class="fw-bold">Domain name</span>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-9">
                                                            <span><?php echo $domainData['unstoppable']->meta->domain; ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row border-bottom py-2">
                                                        <div class="col-12 col-md-6 col-lg-3">
                                                            <span class="fw-bold">Network</span>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-9">
                                                            <span><span><?php echo $domainData['unstoppable']->meta->blockchain; ?></span></span>
                                                        </div>
                                                    </div>
                                                    <div class="row border-bottom py-2">
                                                        <div class="col-12 col-md-6 col-lg-3">
                                                            <span class="fw-bold">Owner</span>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-9">
                                                            <a href='/address/<?php echo $domainData['unstoppable']->meta->owner; ?>'>
                                                                <?php echo $domainData['unstoppable']->meta->owner; ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="row border-bottom py-2">
                                                        <div class="col-12 col-md-6 col-lg-3">
                                                            <span class="fw-bold">Token ID</span>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-9">
                                                            <span><span><?php echo $domainData['unstoppable']->meta->tokenId; ?></span></span>
                                                        </div>
                                                    </div>
                                                    <?php if($domainData['unstoppable']->records) : ?>
                                                    <div class="row py-2">
                                                        <div class="col-12 col-md-6 col-lg-3">
                                                            <span class="fw-bold">Records</span>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-9">
                                                            <div class="table-responsive">
                                                                <table class="table table-hover" id="domainNamePlatformsTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">
                                                                                Key
                                                                            </th>
                                                                            <th scope="col">
                                                                                Value
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        foreach ($domainData['unstoppable']->records as $key => $value) {
                                                                            
                                                                                // var_dump($record);
                                                                                /* $key    = $record['key']; */
                                                                                /* $value  = $record['value']; */

                                                                                $regex = '/^0x[0-9a-fA-F]{40}$/'; // regex düzenli ifadesi
                                                                                if (preg_match($regex, $value)) {
                                                                                    $value = "<a href='/address/$value'>$value</a>";
                                                                                }
                                                                                echo "
                                                                                    <tr>
                                                                                        <td>$key</td>
                                                                                        <td>$value</td>
                                                                                    </tr>
                                                                                ";
                                                                        }
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php //} ?>
            
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php if($domainData['bonfida']['ownerAddress'] != 'error' && $domainData['bonfida']['domainName'] != 'error'){ 
                
                // SNS Suggest API endpoint
                    $url = 'https://sns-suggest-proxy.bonfida.com';

                    // Veri
                    $data = json_encode(array(
                        "q" => "$domainName" // Anahtar kelimelerinizi buraya ekleyin
                    ));

                    // HTTP isteği gönderme
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen($data)
                    ));

                    // İstek gönderme ve cevap alımı
                    $response = curl_exec($ch);
                    curl_close($ch);

                    $response = json_decode($response, true);
                    $ownerAddress = $response['hits'][0]['owner_key'];
                    //echo $response->hits[0]->owner_key;
                    // Cevabı işleme
                    if ($response === false) {
                        echo "Curl hatası: " . curl_error($ch);
                    }
                
                ?>
            <div class="tab-pane fade show active" id="bonfida" role="tabpanel" aria-labelledby="bonfida-tab" tabindex="0">
                <div class="card rounded-0 border-0 shadow py-2 px-4">
                    <div class="card-body rounded-0 p-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="container">

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="h-100 px-4 my-2">
                                                <div class="row border-bottom py-2">
                                                    <div class="col-12 col-md-6 col-lg-3">
                                                        <span class="fw-bold">Domain name</span>
                                                    </div>
                                                    <div class="col-12 col-md-6 col-lg-9">
                                                        <span><?php echo $domainName; ?>.sol</span>
                                                    </div>
                                                </div>
                                                <div class="row border-bottom py-2">
                                                    <div class="col-12 col-md-6 col-lg-3">
                                                        <span class="fw-bold">Network</span>
                                                    </div>
                                                    <div class="col-12 col-md-6 col-lg-9">
                                                        <span><span><?php echo $domainData['bonfida']['network']; ?></span></span>
                                                    </div>
                                                </div>
                                                <div class="row border-bottom py-2">
                                                    <div class="col-12 col-md-6 col-lg-3">
                                                        <span class="fw-bold">Owner</span>
                                                    </div>
                                                    <div class="col-12 col-md-6 col-lg-9">
                                                        <?php echo $ownerAddress; ?>
                                                    </div>
                                                </div>
                                                <?php 
                                                $url = 'https://localhost.com/sns/owner/'.$ownerAddress; // NODE.JS URL

                                                // içeri aktar
                                                $domainForOwnerData = file_get_contents($url);
                                                $domainForOwner = json_decode($domainForOwnerData, true);
                                                
                                                if ($domainForOwner['success'] === true) {
                                                    $domainForOwnerResult = $domainForOwner['result'];
                                                ?>
                                                <div class="row border-bottom py-2">
                                                    <div class="col-12 col-md-6 col-lg-3">
                                                        <span class="fw-bold">Domains For Owner</span>
                                                    </div>
                                                    <div class="col-12 col-md-6 col-lg-9">
                                                        <?php foreach($domainForOwnerResult AS $domainFor) { ?>
                                                            <a class="btn btn-link btn-light" href="domainSearch/<?php echo $domainFor; ?>.sol"><?php echo $domainFor; ?></a>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                                <div class="row border-bottom py-2">
                                                    <div class="col-12 col-md-6 col-lg-3">
                                                        <span class="fw-bold">Token ID</span>
                                                    </div>
                                                    <div class="col-12 col-md-6 col-lg-9">
                                                        <span><span><?php echo $domainData['bonfida']['tokenAddress']; ?></span></span>
                                                    </div>
                                                </div>
                                                <?php if($domainData['bonfida']['record'] != NULL) : ?>
                                                <div class="row py-2">
                                                    <div class="col-12 col-md-6 col-lg-3">
                                                        <span class="fw-bold">Records</span>
                                                    </div>
                                                    <div class="col-12 col-md-6 col-lg-9">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover" id="domainNamePlatformsTable">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">
                                                                            Key
                                                                        </th>
                                                                        <th scope="col">
                                                                            Value
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    foreach ($domainData['unstoppable']->records as $key => $value) {
                                                                        
                                                                            // var_dump($record);
                                                                            /* $key    = $record['key']; */
                                                                            /* $value  = $record['value']; */

                                                                            $regex = '/^0x[0-9a-fA-F]{40}$/'; // regex düzenli ifadesi
                                                                            if (preg_match($regex, $value)) {
                                                                                $value = "<a href='/address/$value'>$value</a>";
                                                                            }
                                                                            echo "
                                                                                <tr>
                                                                                    <td>$key</td>
                                                                                    <td>$value</td>
                                                                                </tr>
                                                                            ";
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card rounded-0 border-0 mt-4 py-4 shadow">
                    <div class="card-body rounded-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="container">
                                    <h3>Suggestions</h3>
                                    <div class="row">                  
                                        <div class="col-12">
                                            <div class="py-4 my-2">
                                                <ul class="list-group">
                                                <?php 
                                                
                                                if($isSNS){
                                                    global $suggestions;
                                                    $suggestions = 0;

                                                    $url = 'https://sns-api.bonfida.com/v2/suggestion/generate-with-ai/'.$domainName;

                                                    // içeri aktar
                                                    $domainForOwnerData = file_get_contents($url);
                                                    $suggestions = json_decode($domainForOwnerData);
                                                    
                                                    
                                                    try {
                                                        foreach($suggestions AS $suggest){ ?>
                                                        
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <?php echo $suggest; ?>.sol
                                                                    <a class="btn btn-sm btn-dark" target="_blank" href="https://sns.id/domain?domain=<?php echo $suggest; ?>&ref=altoscan">Register</a>
                                                            </li>

                                                        <?php
                                                        }
                                                
                                                        //var_dump($suggestions);
                                                    } catch (Exception $e) {
                                                        echo 'Error: ' . $e->getMessage();
                                                    }
                                                }
                                                
                                                ?>
                                                
                                            </ul>
                                            </div>
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                                    

                                
            </div>
            <?php } ?>
            <?php if($domainData['spaceid']['address'] != '0x0000000000000000000000000000000000000000'){ ?>
            <div class="tab-pane fade show active" id="spaceid" role="tabpanel" aria-labelledby="spaceid-tab" tabindex="0">
                <div class="card rounded-0 border-0">
                    <div class="card-body rounded-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="card bg-white border-0 rounded-0">
                                    <div class="card-body">
                                        <div class="container">

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="h-100 px-4 my-2">
                                                        <div class="row border-bottom py-2">
                                                            <div class="col-12 col-md-6 col-lg-3">
                                                                <span class="fw-bold">Domain name</span>
                                                            </div>
                                                            <div class="col-12 col-md-6 col-lg-9">
                                                                <span><?php echo $domainName; ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="row border-bottom py-2">
                                                            <div class="col-12 col-md-6 col-lg-3">
                                                                <span class="fw-bold">Network</span>
                                                            </div>
                                                            <div class="col-12 col-md-6 col-lg-9">
                                                                <span><span><?php echo "BNB"; ?></span></span>
                                                            </div>
                                                        </div>
                                                        <div class="row border-bottom py-2">
                                                            <div class="col-12 col-md-6 col-lg-3">
                                                                <span class="fw-bold">Owner</span>
                                                            </div>
                                                            <div class="col-12 col-md-6 col-lg-9">
                                                                <?php echo $domainData['spaceid']['address']; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>        
            </div>
            <?php } ?>
        </div>
        
        <?php } ?>
    </div>
</main>