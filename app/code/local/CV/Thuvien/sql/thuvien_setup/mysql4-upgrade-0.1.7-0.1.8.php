<?php
$installer = $this;
$installer->startSetup();
$installer->run("
  ALTER TABLE {$this->getTable('thuvien/tpcom')} add Hinh VARCHAR(500);
");
$installer->endSetup();