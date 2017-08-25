<?php

/**
 * Created by PhpStorm.
 * User: ehab
 * Date: 8/9/17
 * Time: 10:20 AM
 */
class ReceiptItem
{
    var $ItemName;
    var $Quantity;
    var $Price;
    var $ExtraCustomization = array();

    /**
     * @param mixed $Price
     */
    public function setPrice($Price)
    {
        $this->Price = $Price;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->Price;
    }
// Setters and Getters
    /**
     * @return mixed
     */
    public function getItemName()
    {
        return $this->ItemName;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->Quantity;
    }

    /**
     * @return mixed
     */
    public function getExtraCustomization()
    {
        return $this->ExtraCustomization;
    }

    /**
     * @param mixed $Quantity
     */
    public function setQuantity($Quantity)
    {
        $this->Quantity = $Quantity;
    }

    /**
     * @param mixed $ExtraCustomization
     */
    public function setExtraCustomization($ExtraCustomization)
    {
        $this->ExtraCustomization = $ExtraCustomization;
    }

    /**
     * @param mixed $ItemName
     */
    public function setItemName($ItemName)
    {
        $this->ItemName = $ItemName;
    }
//End of Setters and Getters

    function __construct($parItemName, $parQuantity, $parPrice) {
        $this->ItemName = $parItemName;
        $this->Quantity = $parQuantity;
        $this->Price = $parPrice;
    }

    function getItemString(){
        $itemString = $this->getQuantity() . ";" . $this->getItemName(). ";" .
            floatval($this->getPrice()) . ";";
        if(!empty($this->ExtraCustomization)){
            foreach ($this->ExtraCustomization as $item){
                $itemString = $itemString . $item;
            }
        }
        return $itemString;
    }

    function addExtraCustomization($parExtraCustomization1 , $parExtraCustomization2){
        $temp = $parExtraCustomization1 . ";;" . $parExtraCustomization2 . ";";
        array_push($this->ExtraCustomization, $temp);
    }
    function addExtraCustomization_rightHandColumn($parExtraCustomization1){
        $temp =  " ;;" . $parExtraCustomization1 . ";";
        array_push($this->ExtraCustomization, $temp);
    }
}
