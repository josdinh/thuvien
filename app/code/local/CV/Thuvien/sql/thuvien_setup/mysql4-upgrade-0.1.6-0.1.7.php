<?php
$installer = $this;
$installer->startSetup();
$installer->run("
  ALTER TABLE {$this->getTable('thuvien/tpcom')} add MucLuc longtext;
  ALTER TABLE {$this->getTable('thuvien/tpcom')} add BanMem text;
");
$installer->endSetup();