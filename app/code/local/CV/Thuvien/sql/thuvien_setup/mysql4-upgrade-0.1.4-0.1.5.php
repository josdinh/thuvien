<?php
$installer = $this;
$installer->startSetup();
$installer->run("
  ALTER TABLE {$this->getTable('thuvien/ddc')} MODIFY MaDDC INT AUTO_INCREMENT;
");
$installer->endSetup();