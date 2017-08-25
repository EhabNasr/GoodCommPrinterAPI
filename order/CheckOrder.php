<?php
/**
 * Created by PhpStorm.
 * User: ehab
 * Date: 8/14/17
 * Time: 11:28 PM
 */
$useraccount = "";
if(isset($_SERVER["HTTP_RANGE"])){
    $sRange=$_SERVER["HTTP_RANGE"];
}
if(isset($_GET['u'])){
    $useraccount= strtolower($_GET['u']);
}
if(isset($_GET['p'])){
    $userpwd= strtolower($_GET['p']);
}


//Test username and password (and PrinterID)
//Replace this with script od database
$defaultcount = "mcdo";
$defaultpwd = "mcdo";
$defaultrPrinterID = "01";
$authentication = (strcasecmp($defaultcount, $useraccount)==0)
    && (strcasecmp($defaultpwd, $userpwd) == 0);

if(isset($_GET['a'])){
    $usrPrinterID= strtolower($_GET['a']);
}
//end of test data

if($authentication) {
    if (strcasecmp($usrPrinterID, $defaultrPrinterID) == 0) {
        if (!(file_exists("./pendingReceipts/" . $usrPrinterID . ".txt"))) {
            header("Content-Length: 0");
            echo "";
        }else{
            $tempReceipt = file_get_contents("./pendingReceipts/" . $usrPrinterID . ".txt");
            $tempReceipt = str_replace("\n", "", $tempReceipt);
            $tempReceipt = str_replace("\r", "", $tempReceipt);
            echo $tempReceipt;
        }
    } else {
    }
} else {
    echo "#!*P*Authentication error!";
}