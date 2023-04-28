/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.24-MariaDB : Database - evoltext
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`evoltext` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `evoltext`;

/*Table structure for table `correlatives` */

DROP TABLE IF EXISTS `correlatives`;

CREATE TABLE `correlatives` (
  `id_correlative` int(11) NOT NULL AUTO_INCREMENT,
  `code_correlative` varchar(20) DEFAULT NULL,
  `name_correlative` varchar(50) DEFAULT NULL,
  `initial_correlative` int(11) DEFAULT NULL,
  `actual_correlative` int(11) DEFAULT NULL,
  `final_correlative` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_correlative`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `correlatives` */

insert  into `correlatives`(`id_correlative`,`code_correlative`,`name_correlative`,`initial_correlative`,`actual_correlative`,`final_correlative`) values (1,'admins','admins',0,7,NULL);

/*Table structure for table `states` */

DROP TABLE IF EXISTS `states`;

CREATE TABLE `states` (
  `id_state` int(11) NOT NULL AUTO_INCREMENT,
  `code_state` varchar(10) NOT NULL,
  `description_state` varchar(255) NOT NULL,
  `type_state` varchar(50) NOT NULL,
  `icon_state` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_state`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4;

/*Data for the table `states` */

insert  into `states`(`id_state`,`code_state`,`description_state`,`type_state`,`icon_state`) values (1,'01','Agotado','secondary','fa-times'),(2,'02','Aprobado','primary','fa-check'),(3,'03','Archivado','white','fa-archive'),(4,'04','Bloqueado','danger','fa-lock'),(5,'05','Borrador','white','fa-pencil-alt'),(6,'06','Cancelado','danger','fa-ban'),(7,'07','Completado','primary','fa-check-circle'),(8,'08','Confirmado','info','fa-check-square'),(9,'09','Desconectado','secondary','fa-plug'),(10,'10','Descontinuado','danger','fa-minus-circle'),(11,'11','Deshabilitado','danger','fa-exclamation-triangle'),(12,'12','Destacado','warning','fa-star'),(13,'13','Devuelto','secondary','fa-undo'),(14,'14','Disponible','info','fa-check-circle'),(15,'15','Edición limitada','warning','fa-tag'),(16,'16','Eliminado','danger','fa-trash-alt'),(17,'17','En espera','warning','fa-hourglass-half'),(18,'18','En Linea','primary','fa-globe'),(19,'19','En mantenimiento','warning','fa-wrench'),(20,'20','En oferta','warning','fa-tags'),(21,'21','En preparación','warning','fa-tasks'),(22,'22','En proceso','warning','fa-spinner'),(23,'23','En producción','warning','fa-cogs'),(24,'24','En tránsito','warning','fa-truck'),(25,'25','Entregado','primary','fa-box-check'),(26,'26','Enviado','info','fa-shipping-fast'),(27,'27','Envío','info','fa-truck-loading'),(28,'28','Error de pago','danger','fa-times-circle'),(29,'29','Esperando pago','warning','fa-clock'),(30,'30','Invitado','info','fa-user-plus'),(31,'31','Nueva llegada','primary','fa-plus-circle'),(32,'32','Parcialmente enviado','warning','fa-minus-circle'),(33,'33','Pendiente','warning','fa-hourglass'),(34,'34','Pendiente de reposición','warning','fa-boxes'),(35,'35','Preparación','warning','fa-clipboard-list'),(36,'36','Pre-venta','info','fa-shopping-cart'),(37,'37','Publicado','primary','fa-bullhorn'),(38,'38','Rechazado','danger','fa-times-circle'),(39,'39','Reembolsado','info','fa-undo-alt'),(40,'40','Reservado','warning','fa-calendar-check'),(41,'41','Retirado','info','fa-hand-paper'),(42,'42','Retrasado','secondary','fa-clock'),(43,'43','Revisión pendiente','warning','fa-eye'),(44,'44','Suspendido','secondary','fa-pause-circle'),(45,'45','Vendido','indigo','fa-handshake'),(46,'46','Activo','success','fa-check-circle'),(47,'47','Inactivo','danger','fa-times-circle'),(48,'48','Pendiente de aprobación','warning','fa-hourglass-half');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `code_user` varchar(10) DEFAULT NULL,
  `username_user` varchar(50) DEFAULT NULL,
  `dis_user` varchar(5) DEFAULT NULL,
  `document_user` varchar(20) DEFAULT NULL,
  `name_user` varchar(150) DEFAULT NULL,
  `email_user` varchar(100) DEFAULT NULL,
  `password_user` varchar(250) DEFAULT NULL,
  `address_user` varchar(250) DEFAULT NULL,
  `postal_user` varchar(6) DEFAULT NULL,
  `token_user` varchar(250) DEFAULT NULL,
  `token_exp_user` varchar(100) DEFAULT NULL,
  `rol_user` varchar(20) DEFAULT NULL,
  `picture_user` varchar(100) DEFAULT NULL,
  `id_company_user` int(11) DEFAULT NULL,
  `state_user` int(11) DEFAULT NULL,
  `method_user` varchar(20) DEFAULT 'direct',
  `date_created_user` date DEFAULT NULL,
  `date_updated_user` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id_user`,`code_user`,`username_user`,`dis_user`,`document_user`,`name_user`,`email_user`,`password_user`,`address_user`,`postal_user`,`token_user`,`token_exp_user`,`rol_user`,`picture_user`,`id_company_user`,`state_user`,`method_user`,`date_created_user`,`date_updated_user`) values (5,'00001','jvmedranog','1','47281037','Joel Medrano Güere','jvmedranog@gmail.com','$2a$07$azybxcags23425sdg23sdeanQZqjaf6Birm2NvcYTNtJw24CsO5uq',NULL,NULL,'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2ODIyNzI5NjAsImV4cCI6MTY4MjM1OTM2MCwiZGF0YSI6eyJpZCI6IjUiLCJlbWFpbCI6Imp2bWVkcmFub2dAZ21haWwuY29tIn19.wJv6b656xK8L0VZBelQVrg0DrM-A2ai71ZMT4SLzt3Q','1682359360','Master',NULL,NULL,46,'direct','2023-04-22','2023-04-23 13:02:40'),(6,'00002','ttcunzac','1','47490910','Tiffany Cunza Castillo','cunza.dg@gmail.com','$2a$07$azybxcags23425sdg23sdeanQZqjaf6Birm2NvcYTNtJw24CsO5uq',NULL,NULL,NULL,NULL,'Admin',NULL,NULL,NULL,'direct','2023-04-23','2023-04-23 12:33:49');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
