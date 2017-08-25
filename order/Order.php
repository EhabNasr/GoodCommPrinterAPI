<?php

/**
 * Created by PhpStorm.
 * User: ehab
 * Date: 8/10/17
 * Time: 7:16 PM
 */
include("ReceiptItem.php");
class Order
{
    var $RestID;

    /**
     * @return mixed
     */
    public function getRestID()
    {
        return $this->RestID;
    }  //I need to make sure if that is the same as the one put in the INI file parameter
    var $OrderType; //Type of order (like delivery) and is number coded (delivery = 1, check the printer's documents)
    var $OrderID; // Order Id from the data base
    var $ListOfItems = array();
    var $DeliveryCharge;
    var $CC_HanFees; //Taxes and any extra payments
    var $Total; //Total charge
    var $CustomerInfo; //Number coded, (4 means 'verified') check the printer documentation for other codes)
    var $CustomerName;
    var $Address;
    var $Requested_Time_Date;
    var $PreviousOrderID;
    var $PaymentStatus; //Number coded, (7 means 'Order Not yet paid') check the printer documentation for other codes)
    var $PaymentCard;
    var $CustomerPhoneNumber;
    var $Comments;

    /*
     * Important note:
     *  $OrderType, $CustomerInfo, $PaymentStatus are number coded:
     *      "1" Delivery
     *      "2" Collection
     *      "3" Reservation
     *      "4" Verified
     *      "5" Not Verified
     *      "6" Order Paid
     *      "7" Order Not Paid
     *
     * */

    function __construct($parRestID, $parOrderType, $parOrderID, $parListOfItems,
                         $parDeliveryCharge, $parCC_HanFees, $parTotal, $parCustomerInfo, $parCustomerName,
                         $parAddress, $parRequested_Time_Date, $parPreviousOrder, $parPaymentStatus, $parPaymentCard,
                         $parCustomerPhoneNumber, $parComments) {

        $this->RestID = $parRestID;  //I need to make sure if that is the same as the one put in the INI file parameter

        $this->OrderType = $parOrderType; //Type of order (like delivery) and is number coded (delivery = 1, check the printer's documents)
        $this->OrderID = $parOrderID;
        $this->DeliveryCharge = $parDeliveryCharge;
        $this->CC_HanFees = $parCC_HanFees;
        $this->Total = $parTotal;
        $this->CustomerInfo = $parCustomerInfo; //Number coded, (4 means 'verified') check the printer documentation for other codes)
        $this->CustomerName = $parCustomerName;
        $this->Address = $parAddress;
        $this->Requested_Time_Date = $parRequested_Time_Date;
        $this->PreviousOrderID = $parPreviousOrder;
        $this->PaymentStatus = $parPaymentStatus; //Number coded, (7 means 'Order Not yet paid') check the printer documentation for other codes)
        $this->PaymentCard = $parPaymentCard;
        $this->CustomerPhoneNumber = $parCustomerPhoneNumber;
        $this->Comments = str_replace("\n", "%%", $parComments); //replace new lines with "%%" so they get printed properly by the printer
        //important note: the characters ";" , "*" and "#" CANNOT be added to the comment or any other parameter
        //echo "#" . $this->RestID . "*" . $this->OrderType . "*" . $this->OrderID . "*";
        $this->ListOfItems = array_merge($this->ListOfItems, $parListOfItems);

    }

    public function getOrderString()
    {
        $order_string = "#" . $this->RestID . "*" . $this->OrderType . "*" . $this->OrderID . "*";

            foreach ($this->ListOfItems as $item){
                $order_string = $order_string . $item->getItemString();
            }
        $order_string = $order_string.  "*" . floatval($this->DeliveryCharge) . "*" . floatval($this->CC_HanFees) . ";"
            . floatval($this->Total)
            . ";" . $this->CustomerInfo . ";" . $this->CustomerName . ";" . $this->Address . ";"
            . $this->Requested_Time_Date . ";" . $this->PreviousOrderID . ";" . $this->PaymentStatus
            . ";" . $this->PaymentCard . ";" . $this->CustomerPhoneNumber . ";"
            . "*" . $this->Comments . "#";
        return $order_string;
    }

    function customError($errno, $errstr) {
        echo "<b>Error:</b> [$errno] $errstr";
    }

    public function writeToFile()
    {
        $order_string = $this->getOrderString();
        $receipt= fopen("./pendingReceipts/" . $this->RestID . ".txt" , "w");
        fwrite($receipt, $order_string);
        fclose($receipt);
        echo exec('chmod -R 777 ./pendingReceipts/' . $this->RestID . ".txt");

    }

}
?>