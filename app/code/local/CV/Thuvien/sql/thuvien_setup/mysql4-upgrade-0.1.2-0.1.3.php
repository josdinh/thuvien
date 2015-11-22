<?php

$installer = $this;
$installer->startSetup();
$installer->run("
  ALTER TABLE {$this->getTable('thuvien/docgia')} MODIFY Hinh VARCHAR(500) NULL DEFAULT '' ;
");
$installer->endSetup();