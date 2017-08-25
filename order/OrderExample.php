
<?php
/**
 * Created by PhpStorm.
 * User: ehab
 * Date: 8/9/17
 * Time: 10:15 AM
 */
require "Order.php";
$one = new ReceiptItem("Bread",12, 13.27);
$one->addExtraCustomization("Extra Sesame", "5");
$two = new ReceiptItem("Cheese Burger",1, 13.87);
$two->addExtraCustomization_rightHandColumn("No Pickles");
$two->addExtraCustomization("Extra Mayo", 23.5);

$OrderList = array( new ReceiptItem("Chicken",12, 13.27), $two, new ReceiptItem("Rice",1, 13),
    new ReceiptItem("Burger King",1, 15.86), $one);


$order = new Order("01", "1", "10003", $OrderList, 5.0, 1.0, 38.1, "4", "Ehab", "Addresss of the Customer",
    "15:17 03-08-2017", "1002", "7", "cod", "00201955915859", "Comments1
    comments 2 
    comments 3");


echo $order->getOrderString(); // use this only for testing, prints the whole order.
$order->writeToFile();  // Writes the order string to a file in the ./pendingReceipts directory
                        //This directory is relative to the directory of the Order.php file and the rest of the library in general.
                        // File name is the same as the printer’s ID (in this case is AC001.txt)
                        // In this case the file is written as: ./order/pendingReceipts/AC001.txt



