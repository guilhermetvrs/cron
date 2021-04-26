CREATE DATABASE `back`;
use `back`;

CREATE TABLE `bkp`(
  `id` int NOT NULL AUTO_INCREMENT,
  `task` varchar(100) NOT NULL,
  `minute` varchar(100) NOT NULL,
  `hour` varchar(100) NOT NULL,
  `day` varchar(100) NOT NULL,
  `month` varchar(100) NOT NULL,
  `weekday` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
);