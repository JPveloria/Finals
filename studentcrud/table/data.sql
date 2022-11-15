CREATE TABLE IF NOT EXISTS `studentidsystem` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
  	`fname` varchar(255) NOT NULL,
  	`lname` varchar(255) NOT NULL,
  	`mname` varchar(255) NOT NULL,
  	`birthdate` varchar(255) NOT NULL,
  	`pgname` varchar(255) NOT NULL,
  	`contact` varchar(255) NOT NULL,
  	`created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
)