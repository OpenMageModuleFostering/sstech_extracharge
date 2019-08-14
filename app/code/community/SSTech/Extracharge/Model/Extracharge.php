<?php
class SSTech_Extracharge_Model_Extracharge extends Varien_Object{
	const FEE_AMOUNT  = 'extracharge/extracharge/extracharge';
	const XML_PATH_ENABLED = "extracharge/extracharge/enabled";

	public static function getExtracharge(){
		if(Mage::getStoreConfigFlag(self::XML_PATH_ENABLED)){
			$extracharge = Mage::getStoreConfig(self::FEE_AMOUNT);
			return $extracharge;
		}
	}
	public static function canApply($address){
		
		return true;
		
	}
}