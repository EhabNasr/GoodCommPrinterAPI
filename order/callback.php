<?php
/**
 * Created by PhpStorm.
 * User: ehab
 * Date: 8/6/17
 * Time: 8:50 AM
 */

// test get request
/*
 * example of get request sent by the printer
http://127.0.0.1/order/callback.php?a=AC001&u=mcdo&p=mcdo&m=Accepted
a = printer's ID = ResID = Receipt txt file name
u = merchant user name
p = merchant password
*/

// the following are test usernames and passwords, you should replace them with
// scripts that utilizes your database
//but still use the same variable names or refactor them
$defaultcount = "mcdo";
$defaultpwd = "mcdo";
// end of test variables

$defaultYes = "accepted";
$defaultNo = "rejected";

if(isset($_SERVER["HTTP_RANGE"])){
    $sRange=$_SERVER["HTTP_RANGE"];
}
if(isset($_GET['u'])){
    $useraccount= strtolower($_GET['u']);
}
if(isset($_GET['p'])){
    $userpwd= strtolower($_GET['p']);
}
if(isset($_GET['m'])){
    $userM= strtolower($_GET['m']);
}

if(isset($_GET['a'])){
    $usrPrinterID= strtolower($_GET['a']);
}
if((strcasecmp($defaultcount, $useraccount)==0) && (strcasecmp($defaultpwd, $userpwd) == 0)){
    if(strcasecmp($userM, $defaultYes)==0){
        header('HTTP/1.0 200 OK');
        unlink("./pendingReceipts/" . $usrPrinterID . ".txt") or die("Failure");
    }elseif(strcasecmp($userM, $defaultNo)==0){
        unlink("./pendingReceipts/" . $usrPrinterID . ".txt") or die("Failure");

    }
} else{
    echo "#!*P*Authentication error. Order has been cancelled!\r\n";
}
