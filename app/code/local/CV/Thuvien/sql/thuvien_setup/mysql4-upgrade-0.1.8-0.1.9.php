<?php
$installer = $this;
$installer->startSetup();
$installer->run("
  ALTER TABLE {$this->getTable('thuvien/tppop')}  DROP PRIMARY KEY;
  ALTER TABLE {$this->getTable('thuvien/tppop')}  ADD Tppopid INT NOT NULL PRIMARY KEY AUTO_INCREMENT;
");
$installer->endSetup();