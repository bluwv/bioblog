-- -------------------------------------------------------------
-- TablePlus 6.0.6(558)
--
-- https://tableplus.com/
--
-- Database: bioblog
-- Generation Time: 2024-06-11 19:13:54.3730
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `categories_posts`;
CREATE TABLE `categories_posts` (
  `post_id` int(11) DEFAULT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  KEY `post_id` (`post_id`),
  KEY `categorie_id` (`categorie_id`),
  CONSTRAINT `categories_posts_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  CONSTRAINT `categories_posts_ibfk_2` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `status` tinyint(1) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delete` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `posts_delete`;
CREATE TABLE `posts_delete` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_unique` (`username`) USING BTREE,
  UNIQUE KEY `mail_unique` (`mail`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO `categories` (`id`, `name`) VALUES
(3, 'Nature'),
(6, 'Oceanique'),
(7, 'Maquillage'),
(8, 'Recettes'),
(9, 'Astuces');

INSERT INTO `categories_posts` (`post_id`, `categorie_id`) VALUES
(3, 3),
(12, 7),
(13, 7),
(16, 3),
(16, 6),
(16, 7),
(16, 8),
(16, 9),
(2, 9);

INSERT INTO `posts` (`id`, `title`, `content`, `status`, `thumbnail`, `user_id`, `created_at`, `updated_at`, `delete`) VALUES
(2, 'Création potager2', '<p>Test</p>', 1, 'photo-1683049339644-3f820ec2c71c.jpeg', 1, '2024-05-13 19:36:23', '2024-06-10 20:50:04', 0),
(3, 'Création potager2', 'test', 1, 'photo-1683049339644-3f820ec2c71c.jpeg', 1, '2024-05-13 19:36:23', '2024-06-03 18:46:11', 0),
(4, 'Test de la pagination', NULL, 1, 'photo-1683049339644-3f820ec2c71c.jpeg', 2, '2024-05-13 19:36:23', '2024-05-13 19:36:23', 0),
(5, 'test', '<p><em><span style=\"text-decoration: underline;\"><strong>lorem ipsum</strong></span></em></p>', 1, 'photo-1683049339644-3f820ec2c71c.jpeg', NULL, '2024-05-28 19:43:09', '2024-06-10 20:32:40', 0),
(8, 'test', 'test', 1, 'photo-1683049339644-3f820ec2c71c.jpeg', 1, '2024-05-28 20:06:41', '2024-05-28 20:06:41', 1),
(9, 'test', '<p>test</p>', 1, 'photo-1683049339644-3f820ec2c71c.jpeg', 1, '2024-06-10 20:33:26', '2024-06-10 20:33:26', NULL),
(10, 'test', '<p>test</p>', 1, 'photo-1683049339644-3f820ec2c71c.jpeg', 1, '2024-06-10 20:34:04', '2024-06-10 20:34:04', NULL),
(11, 'test', '<p>test</p>', 1, 'photo-1683049339644-3f820ec2c71c.jpeg', 1, '2024-06-10 20:34:05', '2024-06-10 20:34:05', NULL),
(12, 'toast', '<p>toast</p>', 1, 'photo-1683049339644-3f820ec2c71c.jpeg', 1, '2024-06-10 20:38:32', '2024-06-10 20:38:32', NULL),
(13, 'dfghjk', '<p>dfghjkl</p>', 1, 'photo-1683049339644-3f820ec2c71c.jpeg', 1, '2024-06-10 20:39:41', '2024-06-10 20:40:30', NULL),
(14, 'tetet', '<p>tete</p>', 1, 'photo-1683049339644-3f820ec2c71c.jpeg', 1, '2024-06-10 20:41:02', '2024-06-10 20:41:02', NULL),
(15, 'tetet', '<p>tete</p>', 1, 'photo-1683049339644-3f820ec2c71c.jpeg', 1, '2024-06-10 20:42:24', '2024-06-10 20:42:24', NULL),
(16, 'tetet', '<p>tete</p>', 1, 'photo-1683049339644-3f820ec2c71c.jpeg', 1, '2024-06-10 20:43:18', '2024-06-10 20:43:18', NULL);

INSERT INTO `users` (`id`, `username`, `password`, `mail`) VALUES
(1, 'adrien', 'pass', 'adrien@ifapme.be'),
(2, 'max', 'pass', 'max@ifapme.be');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;