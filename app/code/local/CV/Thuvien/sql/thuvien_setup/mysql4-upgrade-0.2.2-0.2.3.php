<?php
$installer = $this;
$installer->startSetup();
$installer->run("
  ALTER TABLE {$this->getTable('thuvien/docgia')}  ADD MaTaiKhoan INT(10) NULL DEFAULT 0;
");
$installer->endSetup();