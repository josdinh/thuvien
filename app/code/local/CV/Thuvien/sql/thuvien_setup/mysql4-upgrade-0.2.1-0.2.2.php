<?php
$installer = $this;
$installer->startSetup();
$installer->run("

DROP TABLE IF EXISTS `{$installer->getTable('thuvien/frontmuon')}`;
CREATE TABLE `{$installer->getTable('thuvien/frontmuon')}` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `MaDocGia` varchar(255) NOT NULL,
  `MaTpPop` varchar(12) NOT NULL,
  `MaTpCom` int(10) unsigned NOT NULL,
  `TenTacPham` varchar(255) NOT NULL,
  `PhuThem` varchar(255) NULL,
  `TapSo` varchar(255)  NULL,
  `MaKyHieuTg` int(10) unsigned NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


");
$installer->endSetup();
