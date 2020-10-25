CREATE TABLE `user` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`login` varchar(45) DEFAULT NULL,
`password` varchar(255) DEFAULT NULL,
`roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`roles`)),
PRIMARY KEY (`id`),
UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO user (login, password) VALUES ('admin', '$2y$12$ZSajAhcExEm8miEyw5QrUOQdJynZ2Q/hISOvAJyGrhfYTUOfkBFKW');

CREATE TABLE `product` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`name` VARCHAR(200) NOT NULL,
`description` MEDIUMTEXT NOT NULL,
`price` INT UNSIGNED NOT NULL,
`currency` TINYTEXT NOT NULL,
PRIMARY KEY (`id`),
UNIQUE INDEX `id_UNIQUE` (`id` ASC),
UNIQUE INDEX `name_UNIQUE` (`name` ASC));
