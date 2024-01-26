<?php
// include_once "src/backend/phpClasses/mcache.class.php";
// $mem = new MCache();


include("conf.php");
include("inc/function.inc.php");

$PAGE = isset($_GET["page"]) ? $_GET["page"] : "home";

if ($PAGE != "main-page") {
    include("src/backend/phpClasses/data.class.php");
    include("src/backend/phpClasses/utils.class.php");
}

include("src/layout_header.php");

include("src/pages/" . $PAGE . "/index.php");

include("src/layout_footer.php");