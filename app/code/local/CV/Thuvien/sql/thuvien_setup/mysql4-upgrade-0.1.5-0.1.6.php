<?php
$installer = $this;
$installer->startSetup();
$installer->run("
  ALTER TABLE {$this->getTable('thuvien/khosach')} MODIFY MaKhoSach INT AUTO_INCREMENT;
");
$installer->endSetup();