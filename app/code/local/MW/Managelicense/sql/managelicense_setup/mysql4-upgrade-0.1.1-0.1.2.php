<?php
$installer = $this;
$installer->startSetup();
$resource = Mage::getSingleton('core/resource');
$installer->run("alter table {$resource->getTableName('managelicense/managelicense')}  add column key_active varchar(100) default ''; ");
$installer->endSetup(); 