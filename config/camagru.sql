CREATE TABLE `Users` (
	`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`login` varchar(255) NOT NULL,
	`password` varchar(255) NOT NULL,
	`email` varchar(255) NOT NULL,
	`email_id` varchar(255) NULL,
	`activated` tinyint(1) DEFAULT FALSE
);

CREATE TABLE `Images` (
	`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`user_id` int(10) unsigned NOT NULL, 
	`path` varchar(255) NOT NULL,
	`captureTime` DATETIME NOT NULL
);

CREATE TABLE `Likes` (
	`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`login` varchar(255) NOT NULL,
	`filepathimage` varchar(255) NOT NULL
);

CREATE TABLE Comments (
	`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`login` varchar(255) NOT NULL,
	`filepathimage` varchar(255) NOT NULL
);