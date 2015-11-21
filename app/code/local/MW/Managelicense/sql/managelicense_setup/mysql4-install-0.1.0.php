<?php

$installer = $this;

$installer->startSetup();
$resource =Mage::getSingleton('core/resource');
$installer->run("
DROP TABLE IF EXISTS {$resource->getTableName('managelicense/managelicense')};
CREATE TABLE {$resource->getTableName('managelicense/managelicense')} (
  `managelicense_id` int(11) unsigned NOT NULL auto_increment,
  `order_id` varchar(25) NOT NULL default '', 
  `extension` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',  
  `magento_url` varchar(255) NOT NULL default '',   
  `purchased_date` datetime NULL,
  `active_date` datetime NULL,
  `status` smallint(6) NOT NULL default '1',  
  `comment` text,
  PRIMARY KEY (`managelicense_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


    ");
$installer->endSetup(); 