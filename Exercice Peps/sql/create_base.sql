CREATE DATABASE IF NOT EXISTS `demandes_de_devis`;
USE `demandes_de_devis`;


CREATE TABLE IF NOT EXISTS `users` (
    `user_id` int(11) NOT NULL AUTO_INCREMENT,
    `lastname` varchar(32) NOT NULL,
    `firstname` varchar(32) NOT NULL,
    `company` varchar(64) NOT NULL DEFAULT "N/A",
    `phone` varchar(13) NOT NULL,
    `email` varchar(255) NOT NULL,
    PRIMARY KEY (`user_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `requests` (
    `request_id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(11) NOT NULL,
    `needs` varchar(10) NOT NULL,
    `budget` int(11) NOT NULL,
    `deadline` varchar(10) NOT NULL,
    `description` longtext NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `answered` BOOLEAN NOT NULL DEFAULT 0,
    PRIMARY KEY (`request_id`),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;