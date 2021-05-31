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
 create database proyecto;
  use proyecto;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

//Crear el usuario
CREATE USER 'isa'@'localhost' IDENTIFIED BY 'isa';
GRANT ALL PRIVILEGES ON * . * TO 'isa'@'localhost';
FLUSH PRIVILEGES;


//
insert into users(username,password,email)values ('isa','$2y$10$iP8rFCVKGezuJxra7b.kpecYU10cLYldOn9o/Qsa2VunA3XV5/mgi','isabel@gmail.com');

ALTER TABLE `heroku_4edea3226fe2494`.`users`
ADD COLUMN `username_trello` VARCHAR(45) NULL AFTER `email`,
ADD COLUMN `key_trello` VARCHAR(45) NULL AFTER `username_trello`,
ADD COLUMN `token_trello` VARCHAR(45) NULL AFTER `key_trello`,
ADD UNIQUE INDEX `username_trello_UNIQUE` (`username_trello` ASC),
ADD UNIQUE INDEX `key_trello_UNIQUE` (`key_trello` ASC),
ADD UNIQUE INDEX `token_trello_UNIQUE` (`token_trello` ASC);
;

