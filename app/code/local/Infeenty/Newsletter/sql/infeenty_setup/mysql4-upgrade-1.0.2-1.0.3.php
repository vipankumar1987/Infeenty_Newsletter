<?php
    $installer = $this;
    $installer->startSetup();
	//
	$sql = array("ALTER TABLE {$this->getTable('newsletter/subscriber')} ADD `subscriber_firstname` VARCHAR(255) NULL DEFAULT NULL");
	$sql[] = "ALTER TABLE {$this->getTable('newsletter/subscriber')} ADD `subscriber_lastname` VARCHAR(255) NULL DEFAULT NULL";
	foreach($sql as $s) $installer->run($s);
	
    /* right before this */
    $installer->endSetup();
	