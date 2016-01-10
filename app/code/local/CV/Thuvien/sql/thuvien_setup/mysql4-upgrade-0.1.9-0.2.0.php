<?php
$installer = $this;
$installer->startSetup();
$installer->run("
  ALTER TABLE {$this->getTable('thuvien/luuky')}  DROP PRIMARY KEY;
  ALTER TABLE {$this->getTable('thuvien/luuky')}  ADD MaLuuKy INT NOT NULL PRIMARY KEY AUTO_INCREMENT;
");
$installer->endSetup();