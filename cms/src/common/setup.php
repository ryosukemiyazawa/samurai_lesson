<?php
    /* phpの設定 */
    error_reporting(E_ALL);
    ini_set("display_errors", "On");
    
	include_once(__DIR__ . "/function.php");
	// include_once(APP_ROOT."/src/common/function.php");
    $dbh = getDbh();
    $page = getPageInformation();
