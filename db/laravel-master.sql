/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 10.4.24-MariaDB : Database - laravel_master
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`laravel_master` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `laravel_master`;

/*Table structure for table `comments` */

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) DEFAULT NULL,
  `image_id` int(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_images` (`image_id`),
  KEY `fk_comments_users` (`user_id`),
  CONSTRAINT `fk_comments_images` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_comments_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

/*Data for the table `comments` */

insert  into `comments`(`id`,`user_id`,`image_id`,`content`,`created_at`,`updated_at`) values 
(10,7,13,'toma aguita osito','2022-08-20 04:29:24','2022-08-20 04:29:24'),
(11,7,11,'oigame pues, esa foto la he subio io','2022-08-20 04:45:56','2022-08-20 04:45:56'),
(14,5,13,'hola soy norma','2022-08-22 22:31:39','2022-08-22 22:31:39'),
(15,5,11,'todo ok','2022-08-25 15:20:30','2022-08-25 15:20:30');

/*Table structure for table `images` */

DROP TABLE IF EXISTS `images`;

CREATE TABLE `images` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_images_users` (`user_id`),
  CONSTRAINT `fk_images_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

/*Data for the table `images` */

insert  into `images`(`id`,`user_id`,`image_path`,`description`,`created_at`,`updated_at`) values 
(9,5,'1660782403google2realnofake.png','lñkñl','2022-08-18 00:26:43','2022-08-18 00:26:43'),
(10,5,'1660782416google4realnofake.png','klñklñklñ','2022-08-18 00:26:56','2022-08-18 00:26:56'),
(11,5,'1661441138google5realnofake.png','siandaaaaaaaa32132321','2022-08-18 00:27:07','2022-08-25 15:25:38'),
(13,7,'1660969745google5realnofake.png','bendito paisjae','2022-08-20 04:29:05','2022-08-20 04:29:05'),
(15,8,'1661455688google5realnofake.png','adasd','2022-08-25 19:28:09','2022-08-25 19:28:09');

/*Table structure for table `likes` */

DROP TABLE IF EXISTS `likes`;

CREATE TABLE `likes` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) DEFAULT NULL,
  `image_id` int(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_likes_images` (`image_id`),
  KEY `fk_likes_users` (`user_id`),
  CONSTRAINT `fk_likes_images` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_likes_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4;

/*Data for the table `likes` */

insert  into `likes`(`id`,`user_id`,`image_id`,`created_at`,`updated_at`) values 
(21,5,11,'2022-08-22 23:00:08','2022-08-22 23:00:08'),
(33,5,9,'2022-08-23 19:00:13','2022-08-23 19:00:13'),
(35,5,10,'2022-08-23 19:00:20','2022-08-23 19:00:20'),
(45,9,15,'2022-08-25 19:32:57','2022-08-25 19:32:57');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `role` varchar(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `surname` varchar(200) DEFAULT NULL,
  `nick` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id`,`role`,`name`,`surname`,`nick`,`email`,`password`,`image`,`created_at`,`updated_at`,`remember_token`) values 
(5,NULL,'parce','parce','parcerito','parce@parce.com','$2y$10$YBnH7USTo9YxNVADWKJSrOrZ9gw4gkTApqcRmyuE271OSZZJ6Hr9G','1660528458remeras4.jfif','2022-08-12 02:09:57','2022-08-15 01:54:18',NULL),
(7,'user','gaston','leonardini','gas032','gas@gas.com','$2y$10$sdX0qD3KUGQK/.QOVo6RRe6gLm7J2lKSNaIIlvK0HY6KO/meNHBQK','1660970243google5realnofake.png','2022-08-20 04:27:50','2022-08-20 04:37:23',NULL),
(8,'user','jorgito','ledezma','jorgeled','jorge@ñed.com','$2y$10$87h39AvjAFpjcrQl5Uxs8.c/mgtLzHMK1o6rAENWwSde6tQHTfP12','1661455536google3realnofake.jpg','2022-08-25 19:25:12','2022-08-25 19:25:36',NULL),
(9,'user','guille','gama','gamaguiiie','gama@guille.com','$2y$10$FI9G2J2tV/C4nUcAc4mvfOsllF.XuPlnHUG8./zF0M.pWXOJTvwvq','1661455784remeras3.jfif','2022-08-25 19:29:28','2022-08-25 19:29:44',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
