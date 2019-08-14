<?php
class SSTech_Extracharge_Model_Observer{
	public function invoiceSaveAfter(Varien_Event_Observer $observer)
	{
		$invoice = $observer->getEvent()->getInvoice();
		if ($invoice->getBaseExtrachargeAmount()) {
			$order = $invoice->getOrder();
			$order->setExtrachargeAmountInvoiced($order->getExtrachargeAmountInvoiced() + $invoice->getExtrachargeAmount());
			$order->setBaseExtrachargeAmountInvoiced($order->getBaseExtrachargeAmountInvoiced() + $invoice->getBaseExtrachargeAmount());
		}
		return $this;
	}
	public function creditmemoSaveAfter(Varien_Event_Observer $observer)
	{
		
		$creditmemo = $observer->getEvent()->getCreditmemo();
		if ($creditmemo->getExtrachargeAmount()) {
			$order = $creditmemo->getOrder();
			$order->setExtrachargeAmountRefunded($order->getExtrachargeAmountRefunded() + $creditmemo->getExtrachargeAmount());
			$order->setBaseExtrachargeAmountRefunded($order->getBaseExtrachargeAmountRefunded() + $creditmemo->getBaseExtrachargeAmount());
		}
		return $this;
	}
	public function updatePaypalTotal($evt){
		$cart = $evt->getPaypalCart();
		$cart->updateTotal(Mage_Paypal_Model_Cart::TOTAL_SUBTOTAL,$cart->getSalesEntity()->getExtrachargeAmount());
	}
}