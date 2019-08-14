<?php
class SSTech_Extracharge_Model_Sales_Order_Total_Invoice_Extracharge extends Mage_Sales_Model_Order_Invoice_Total_Abstract
{
	public function collect(Mage_Sales_Model_Order_Invoice $invoice)
	{
		$order = $invoice->getOrder();
		$extrachargeAmountLeft = $order->getExtrachargeAmount() - $order->getExtrachargeAmountInvoiced();
		$baseExtrachargeAmountLeft = $order->getBaseExtrachargeAmount() - $order->getBaseExtrachargeAmountInvoiced();
		if (abs($baseExtrachargeAmountLeft) < $invoice->getBaseGrandTotal()) {
			$invoice->setGrandTotal($invoice->getGrandTotal() + $extrachargeAmountLeft);
			$invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() + $baseExtrachargeAmountLeft);
		} else {
			$extrachargeAmountLeft = $invoice->getGrandTotal() * -1;
			$baseExtrachargeAmountLeft = $invoice->getBaseGrandTotal() * -1;

			$invoice->setGrandTotal(0);
			$invoice->setBaseGrandTotal(0);
		}
			
		$invoice->setExtrachargeAmount($extrachargeAmountLeft);
		$invoice->setBaseExtrachargeAmount($baseExtrachargeAmountLeft);
		return $this;
	}
}
