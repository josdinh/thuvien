<?php
$installer = $this;
$installer->startSetup();
$installer->run("
  ALTER TABLE {$this->getTable('thuvien/tpcom')}  ADD NoiBat INT NOT NULL DEFAULT 0;
");
$installer->endSetup();