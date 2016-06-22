CREATE TABLE `Users` (
	`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`login` varchar(255) NOT NULL,
	`password` varchar(255) NOT NULL,
	`email` varchar(255) NOT NULL,
	`email_id` varchar(255) NULL
);

CREATE TABLE `Images` (
	`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`user` varchar(255) NOT NULL,
	`filepath` varchar(255) NOT NULL
);

CREATE TABLE `Likes` (
	`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`user` varchar(255) NOT NULL,
	`filepathimage` varchar(255) NOT NULL
);

CREATE TABLE Comments (
	`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`user` varchar(255) NOT NULL,
	`filepathimage` varchar(255) NOT NULL
);