<?php
$installer = $this;
$installer->startSetup();
$installer->run("
  ALTER TABLE {$this->getTable('thuvien/tvquydinh')} ADD id INT PRIMARY KEY AUTO_INCREMENT;
");
$installer->endSetup();