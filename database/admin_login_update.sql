ALTER TABLE `admin_login` ADD `flag` TINYINT NOT NULL DEFAULT '0' COMMENT '0: non-active, 1:active' AFTER `level`;