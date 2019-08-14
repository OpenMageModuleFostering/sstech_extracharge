<?php

class SSTech_Extracharge_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function formatExtracharge($amount){
		return Mage::helper('extracharge')->__('Extracharge');
	}
}