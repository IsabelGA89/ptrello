Es necesario tener instalado curl en apache.

//Instalaciones:
//CURL:
sudo apt-get install curl libcurl3 libcurl3-dev php5-curl
apt-get install php7.4-curl
apt-get install php-curl
// habilitar la extensión curl en php: descomentar la linea ;extension = curl
sudo nano /etc/php/7.4/apache2/php.ini


//Librerías PDF:
FPDF  https://huguidugui.wordpress.com/2013/11/20/fpdf-tablas-y-reportes-introduccion/


//Crear la bd
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username_trello` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `key_trello` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token_trello` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_trello_UNIQUE` (`username_trello`),
  UNIQUE KEY `key_trello_UNIQUE` (`key_trello`),
  UNIQUE KEY `token_trello_UNIQUE` (`token_trello`)
) ENGINE=InnoDB AUTO_INCREMENT=244 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci

//Crear el usuario
CREATE USER 'isa'@'localhost' IDENTIFIED BY 'isa';
GRANT ALL PRIVILEGES ON * . * TO 'isa'@'localhost';
FLUSH PRIVILEGES;

insert into users(username,password,email)values ('isa','$2y$10$iP8rFCVKGezuJxra7b.kpecYU10cLYldOn9o/Qsa2VunA3XV5/mgi','isabel@gmail.com');

