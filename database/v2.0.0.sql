DROP TABLE `keranjang`;
CREATE TABLE `keranjang` (
  `id` tinyint(4) NOT NULL,
  `kode_brg` varchar(10) NOT NULL,
  `barcode` varchar(20) NOT NULL,
  `user_id` tinyint(4) NOT NULL,
  `qty` tinyint(4) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `keranjang` ADD PRIMARY KEY(`id`);
ALTER TABLE `keranjang` CHANGE `id` `id` TINYINT(4) NOT NULL AUTO_INCREMENT;
ALTER TABLE `penjualan` ADD `sub_total` INT NOT NULL AFTER `tanggal`, ADD `discount` INT NOT NULL AFTER `sub_total`;
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `penjualan` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;