drop schema notasIngxAreas;
drop user administrador;


/*Se crea la base de datos */
CREATE SCHEMA notasIngxAreas;
/*Se crea un usuario para la base de datos */
create user 'administrador'@'%' identified by 'password';
/*Se asignan los prvilegios sobr ela base de datos  al usuario creado */
grant all privileges on notasIngxAreas.* to 'administrador'@'%';
flush privileges;

-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2021 at 03:39 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

USE  notasIngxAreas;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` enum('user','admin') NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `username`, `password`, `name`) VALUES
(1, 'admin', 'administrador', '5f4dcc3b5aa765d61d8327deb882cf99', 'admin de prueba'),
(2, 'user', 'profesor', '5f4dcc3b5aa765d61d8327deb882cf99', 'profe de prueba');
--
-- Password is "password" encrypted in MD5 hash(Delete this in prod) att. Ale :)
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


CREATE TABLE notasIngxAreas.estudiante (
  id varchar(9) PRIMARY KEY NOT NULL,
  nombre_estudiante varchar(50),
  correo_estudiante varchar(50),
  telefono_estudiante varchar(8)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_eo_0900_ai_ci;


CREATE TABLE notasIngxAreas.profesor (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nombre_profesor varchar(255),
  correo_profesor varchar(255),
  telefono_profesor varchar(255)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_eo_0900_ai_ci;


CREATE TABLE notasIngxAreas.area (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nombre_area varchar(255)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_eo_0900_ai_ci;


CREATE TABLE notasIngxAreas.nivel (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nombre_nivel varchar(255)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_eo_0900_ai_ci;


CREATE TABLE notasIngxAreas.notas (
  id_estudiante varchar(9),
  id_area integer,
  id_profesor integer,
  id_nivel integer,
  nombre_grupo varchar(255),
  periodo varchar(255),
  nota integer,
  FOREIGN KEY  fk_notas_estudiante (id_estudiante) REFERENCES estudiante(id),
  FOREIGN KEY  fk_notas_area (id_profesor) REFERENCES profesor(id),
  FOREIGN KEY  fk_notas_profesor (id_area) REFERENCES area(id),
  FOREIGN KEY  fk_notas_nivel (id_nivel) REFERENCES nivel(id)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_eo_0900_ai_ci;

INSERT INTO notasIngxAreas.estudiante (id,nombre_estudiante,correo_estudiante,telefono_estudiante) values
('B62386','Alejandro Duarte Lobo','alejandro.duarte@ucr.ac.cr','85035132');
INSERT INTO notasIngxAreas.estudiante (id,nombre_estudiante,correo_estudiante,telefono_estudiante) values
('B22386','Sofia Duran Armenta','sofia.duran@ucr.ac.cr','321123343');
INSERT INTO notasIngxAreas.profesor (id,nombre_profesor,correo_profesor,telefono_profesor) values
(1,'profesor 1','profesor@ucr.ac.cr','88888888');
INSERT INTO notasIngxAreas.profesor (id,nombre_profesor,correo_profesor,telefono_profesor) values
(2,'profesor 2','profesor@ucr.ac.cr','88888888');
INSERT INTO notasIngxAreas.area (nombre_area) values
('Mixto');
INSERT INTO notasIngxAreas.nivel (nombre_nivel) values
('Principiante 1');
INSERT INTO notasIngxAreas.notas (id_estudiante,id_area,id_profesor,id_nivel,nombre_grupo,periodo,nota) values
('B62386',1,1,1,'GRprueba','II Ciclo 2023',100);

INSERT INTO notasIngxAreas.notas (id_estudiante,id_area,id_profesor,id_nivel,nombre_grupo,periodo,nota) values
('B22386',1,2,1,'GRprueba','II Ciclo 2023',100);
COMMIT; 