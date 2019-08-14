<?php
class SSTech_Extracharge_Model_Sales_Quote_Address_Total_Extracharge extends Mage_Sales_Model_Quote_Address_Total_Abstract{
	protected $_code = 'extracharge';
	const ADD_TITLE  = 'extracharge/extracharge/addtitle';

	public function collect(Mage_Sales_Model_Quote_Address $address)
	{
		parent::collect($address);

		$this->_setAmount(0);
		$this->_setBaseAmount(0);

		$items = $this->_getAddressItems($address);
		if (!count($items)) {
			return $this; //this makes only address type shipping to come through
		}


		$quote = $address->getQuote();

		if(SSTech_Extracharge_Model_Extracharge::canApply($address)){
			$exist_amount = $quote->getExtrachargeAmount();
			$extracharge = SSTech_Extracharge_Model_Extracharge::getExtracharge();
			$balance = $extracharge - $exist_amount;

			$address->setExtrachargeAmount($balance);
			$address->setBaseExtrachargeAmount($balance);
				
			$quote->setExtrachargeAmount($balance);

			$address->setGrandTotal($address->getGrandTotal() + $address->getExtrachargeAmount());
			$address->setBaseGrandTotal($address->getBaseGrandTotal() + $address->getBaseExtrachargeAmount());
		}
	}

	public function fetch(Mage_Sales_Model_Quote_Address $address)
	{
		$addtitle = Mage::getStoreConfig(self::ADD_TITLE);
		$amt = $address->getExtrachargeAmount();
		if($amt > 0){
		$address->addTotal(array(
				'code'=>$this->getCode(),
				'title'=>$addtitle,
				'value'=> $amt
		));
	   }
		return $this;
	}
}