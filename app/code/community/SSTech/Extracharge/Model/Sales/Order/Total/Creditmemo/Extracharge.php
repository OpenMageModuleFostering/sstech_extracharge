<?php
class SSTech_Extracharge_Model_Sales_Order_Total_Creditmemo_Extracharge extends Mage_Sales_Model_Order_Creditmemo_Total_Abstract
{
	public function collect(Mage_Sales_Model_Order_Creditmemo $creditmemo)
	{
		$order = $creditmemo->getOrder();
		$extrachargeAmountLeft = $order->getExtrachargeAmountInvoiced() - $order->getExtrachargeAmountRefunded();
		$baseextrachargeAmountLeft = $order->getBaseExtrachargeAmountInvoiced() - $order->getBaseExtrachargeAmountRefunded();
		if ($baseextrachargeAmountLeft > 0) {
			$creditmemo->setGrandTotal($creditmemo->getGrandTotal() + $extrachargeAmountLeft);
			$creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal() + $baseextrachargeAmountLeft);
			$creditmemo->setExtrachargeAmount($extrachargeAmountLeft);
			$creditmemo->setBaseExtrachargeAmount($baseextrachargeAmountLeft);
		}
		return $this;
	}
}
