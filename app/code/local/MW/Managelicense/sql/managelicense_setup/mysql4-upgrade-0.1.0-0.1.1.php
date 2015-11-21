<?php

$installer = $this;

$installer->startSetup();
$resource = Mage::getSingleton('core/resource');
$installer->run("

DROP TABLE IF EXISTS {$resource->getTableName('managelicense/extension')};
CREATE TABLE {$resource->getTableName('managelicense/extension')}
(
	`extension_id` int(11) unsigned NOT NULL auto_increment,
	`name` varchar(100) NOT NULL default '',
	`key` varchar(100) NOT NULL default '',
	`version` varchar(50) NOT NULL default '',
	`sku` varchar(100) NOT NULL default '',
	`url` varchar(100) NOT NULL default '',
	
	PRIMARY KEY (`extension_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;


    ");
$installer->endSetup(); 