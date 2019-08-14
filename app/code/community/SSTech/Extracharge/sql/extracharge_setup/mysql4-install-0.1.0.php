<?php

$installer = $this;

$installer->startSetup();

$installer->run("
		
	ALTER TABLE  `".$this->getTable('sales/order')."` ADD  `extracharge_amount` DECIMAL( 10, 2 ) NOT NULL;
	ALTER TABLE  `".$this->getTable('sales/order')."` ADD  `base_extracharge_amount` DECIMAL( 10, 2 ) NOT NULL;

    ");

$installer->endSetup(); 