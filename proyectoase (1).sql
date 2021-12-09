-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 17-07-2021 a las 00:00:17
-- Versión del servidor: 8.0.25
-- Versión de PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectoase`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `notifi_autorizacion` ()  SELECT n.idNotificaciones as idnotif, DATE(n.created_at) as Fecha, concat(e.nombre,' ',e.apellido) as estudiante, n.tipo, m.nombreMateria

FROM notificaciones as n 
INNER JOIN solicituasesorias as sa ON n.idSolicituAsesorias = sa.idSolicituAsesorias
INNER JOIN estudiantes as e ON sa.idEstudiantes = e.idEstudiantes
INNER JOIN materias as m ON  sa.idMateria = m.idMateria
WHERE n.tipo='Autorización'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `notifi_solicitud` ()  SELECT n.idNotificaciones as idnotif, DATE(n.created_at) as Fecha, concat(e.nombre,' ',e.apellido) as estudiante, n.tipo

FROM notificaciones as n 
INNER JOIN solicituasesorias as sa ON n.idSolicituAsesorias = sa.idSolicituAsesorias
INNER JOIN estudiantes as e ON sa.idEstudiantes = e.idEstudiantes
WHERE n.tipo='solicitud'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `view_horarioDocente` (IN `vid` INT)  SELECT  ho.nombreMateria materia,
        MAX(CASE WHEN ho.dia = 'Lunes' THEN concat(HOUR(ho.HoraInicial), ' - ', HOUR(ho.HoraFinal)) ELSE '' END) Lunes,
        MAX(CASE WHEN ho.dia = 'Martes' THEN concat(HOUR(ho.HoraInicial), ' - ', HOUR(ho.HoraFinal)) ELSE '' END) Martes,
        MAX(CASE WHEN ho.dia = 'Miércoles' THEN concat(HOUR(ho.HoraInicial), ' - ', HOUR(ho.HoraFinal)) ELSE '' END) Miercoles,
        MAX(CASE WHEN ho.dia = 'Jueves' THEN concat(HOUR(ho.HoraInicial), ' - ', HOUR(ho.HoraFinal)) ELSE '' END) Jueves,
        MAX(CASE WHEN ho.dia = 'Viernes' THEN concat(HOUR(ho.HoraInicial), ' - ', HOUR(ho.HoraFinal)) ELSE '' END) Viernes,
        MAX(CASE WHEN ho.dia = 'Sabado' THEN concat(HOUR(ho.HoraInicial), ' - ', HOUR(ho.HoraFinal)) ELSE '' END) Sabado 
from(SELECT  h.idHorarios,   d.nombre,   m.nombreMateria, di.descripcion as dia, h.HoraInicial,h.HoraFinal, h.id_docente
FROM horarios h
INNER JOIN docentes d ON h.id_docente = d.idDocentes 
INNER JOIN modalidades mo ON h.idModalidades = mo.idModalidades
INNER JOIN materias m ON h.idMateria = m.idMateria 
INNER JOIN dias di ON h.iddia = di.idDia) AS ho
where ho.id_docente =  vid
GROUP BY  ho.nombreMateria
ORDER BY  ho.nombreMateria ASC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `view_horarioHalumno` (IN `vid` INT)  SELECT  ho.idEstudiantes, ho.nombreMateria materia,
        MAX(CASE WHEN ho.dia = 'Lunes' THEN concat(HOUR(ho.HoraInicial), ' - ', HOUR(ho.HoraFinal)) ELSE '' END) Lunes,
        MAX(CASE WHEN ho.dia = 'Martes' THEN concat(HOUR(ho.HoraInicial), ' - ', HOUR(ho.HoraFinal)) ELSE '' END) Martes,
        MAX(CASE WHEN ho.dia = 'Miércoles' THEN concat(HOUR(ho.HoraInicial), ' - ', HOUR(ho.HoraFinal)) ELSE '' END) Miercoles,
        MAX(CASE WHEN ho.dia = 'Jueves' THEN concat(HOUR(ho.HoraInicial), ' - ', HOUR(ho.HoraFinal)) ELSE '' END) Jueves,
        MAX(CASE WHEN ho.dia = 'Viernes' THEN concat(HOUR(ho.HoraInicial), ' - ', HOUR(ho.HoraFinal)) ELSE '' END) Viernes,
        MAX(CASE WHEN ho.dia = 'Sabado' THEN concat(HOUR(ho.HoraInicial), ' - ', HOUR(ho.HoraFinal)) ELSE '' END) Sabado 
from(SELECT ha.idEstudiantes, ha.idHorariosAlumnos,   d.nombre,       m.nombreMateria, di.descripcion as dia, h.HoraInicial,h.HoraFinal
FROM horariosalumnos ha
INNER JOIN horarios h ON ha.idHorarios = h.idHorarios 
INNER JOIN docentes d ON h.id_docente = d.idDocentes 
INNER JOIN materias m ON h.idMateria = m.idMateria 
INNER JOIN dias di ON h.iddia = di.idDia
INNER JOIN estudiantes e ON ha.idEstudiantes =e.idEstudiantes    ) AS ho
where ho.idEstudiantes = vid
GROUP BY  ho.nombreMateria, ho.idEstudiantes
ORDER BY  ho.nombreMateria, ho.idEstudiantes ASC$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asesorias`
--

CREATE TABLE `asesorias` (
  `idAsesorias` int NOT NULL,
  `fechaAsesoria` date NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFinal` time NOT NULL,
  `Estudiantes_idEstudiantes` int NOT NULL,
  `Docentes_idDocentes` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `idCarreras` int NOT NULL,
  `nombreCarrera` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`idCarreras`, `nombreCarrera`) VALUES
(1, 'Ingeniería en Gestión Empresarial'),
(2, 'Ingeniería Industrial'),
(3, 'Ingeniería en Industrias Alimentarias'),
(4, 'Ingeniería en Sistemas Computacionales'),
(5, 'Ingeniería Mecatrónica'),
(6, 'Ingeniería Informática');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dias`
--

CREATE TABLE `dias` (
  `idDia` int NOT NULL,
  `descripcion` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `dias`
--

INSERT INTO `dias` (`idDia`, `descripcion`) VALUES
(1, 'Lunes'),
(2, 'Martes'),
(3, 'Miércoles'),
(4, 'Jueves'),
(5, 'Viernes'),
(6, 'Sábado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `idDocentes` int NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `Users_id` bigint UNSIGNED NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`idDocentes`, `nombre`, `apellidos`, `Users_id`, `updated_at`, `created_at`) VALUES
(1, 'karen', 'Santana Muñoz', 15, '2021-07-06 15:25:35', '2021-07-06 15:25:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `idEstudiantes` int NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `grupo` varchar(2) NOT NULL,
  `Carreras_idCarreras` int NOT NULL,
  `Semestres_idSemestres` int NOT NULL,
  `Modalidades_idModalidades` int NOT NULL,
  `Users_id` bigint UNSIGNED NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`idEstudiantes`, `nombre`, `apellido`, `grupo`, `Carreras_idCarreras`, `Semestres_idSemestres`, `Modalidades_idModalidades`, `Users_id`, `updated_at`, `created_at`) VALUES
(1, 'Isaac', 'Salome Gandara', 'A', 6, 1, 1, 5, '2021-07-01 06:54:41', '2021-07-01 06:54:41'),
(2, 'Joel Said', 'Santana Muñoz', 'A', 6, 1, 1, 6, '2021-07-01 07:01:47', '2021-07-01 07:01:47'),
(3, ' testeo', 'testeo', ' A', 6, 1, 1, 16, '2021-07-07 04:12:40', '2021-07-07 04:12:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `idHorarios` int NOT NULL,
  `iddia` int NOT NULL,
  `HoraInicial` time NOT NULL,
  `HoraFinal` time NOT NULL,
  `idMateria` int NOT NULL,
  `idModalidades` int NOT NULL,
  `idSemestres` int NOT NULL,
  `id_docente` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`idHorarios`, `iddia`, `HoraInicial`, `HoraFinal`, `idMateria`, `idModalidades`, `idSemestres`, `id_docente`, `updated_at`, `created_at`) VALUES
(4, 1, '14:00:00', '16:00:00', 7, 1, 1, 1, '2021-07-13 12:13:17', '2021-07-13 12:13:17'),
(5, 1, '10:00:00', '13:00:00', 9, 1, 1, 1, '2021-07-13 12:13:46', '2021-07-13 12:13:46'),
(6, 1, '16:00:00', '18:00:00', 10, 1, 1, 1, '2021-07-13 12:14:25', '2021-07-13 12:14:25'),
(7, 2, '09:00:00', '12:00:00', 6, 1, 1, 1, '2021-07-13 12:15:51', '2021-07-13 12:15:51'),
(8, 2, '13:00:00', '16:00:00', 7, 1, 1, 1, '2021-07-13 12:16:28', '2021-07-13 12:16:28'),
(9, 2, '16:00:00', '18:00:00', 10, 1, 1, 1, '2021-07-13 12:17:06', '2021-07-13 12:17:06'),
(10, 3, '11:00:00', '13:00:00', 5, 1, 1, 1, '2021-07-13 12:17:47', '2021-07-13 12:17:47'),
(11, 3, '09:00:00', '11:00:00', 6, 1, 1, 1, '2021-07-13 12:18:21', '2021-07-13 12:18:21'),
(12, 3, '14:00:00', '17:00:00', 8, 1, 1, 1, '2021-07-13 12:18:51', '2021-07-13 12:18:51'),
(13, 3, '16:00:00', '17:00:00', 10, 1, 1, 1, '2021-07-13 12:19:20', '2021-07-13 12:19:20'),
(14, 4, '09:00:00', '12:00:00', 5, 1, 1, 1, '2021-07-13 12:19:59', '2021-07-13 12:19:59'),
(15, 4, '15:00:00', '17:00:00', 8, 1, 1, 1, '2021-07-13 12:20:28', '2021-07-13 12:20:28'),
(16, 4, '13:00:00', '15:00:00', 9, 1, 1, 1, '2021-07-13 12:20:56', '2021-07-13 12:20:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horariosalumnos`
--

CREATE TABLE `horariosalumnos` (
  `idHorariosAlumnos` int NOT NULL,
  `idHorarios` int NOT NULL,
  `idEstudiantes` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `horariosalumnos`
--

INSERT INTO `horariosalumnos` (`idHorariosAlumnos`, `idHorarios`, `idEstudiantes`, `updated_at`, `created_at`) VALUES
(4, 4, 1, '2021-07-13 12:21:49', '2021-07-13 12:21:49'),
(5, 5, 1, '2021-07-13 12:21:55', '2021-07-13 12:21:55'),
(6, 6, 1, '2021-07-13 12:22:00', '2021-07-13 12:22:00'),
(7, 7, 1, '2021-07-13 12:22:11', '2021-07-13 12:22:11'),
(8, 8, 1, '2021-07-13 12:22:18', '2021-07-13 12:22:18'),
(9, 9, 1, '2021-07-13 12:22:50', '2021-07-13 12:22:50'),
(10, 10, 1, '2021-07-13 12:23:16', '2021-07-13 12:23:16'),
(11, 11, 1, '2021-07-13 12:23:23', '2021-07-13 12:23:23'),
(12, 12, 1, '2021-07-13 12:23:31', '2021-07-13 12:23:31'),
(13, 13, 1, '2021-07-13 12:23:42', '2021-07-13 12:23:42'),
(14, 14, 1, '2021-07-13 12:23:48', '2021-07-13 12:23:48'),
(15, 15, 1, '2021-07-13 12:23:54', '2021-07-13 12:23:54'),
(16, 16, 1, '2021-07-13 12:24:00', '2021-07-13 12:24:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horariosdocentes`
--

CREATE TABLE `horariosdocentes` (
  `idHorariosDocentes` int NOT NULL,
  `Horarios_idHorarios` int NOT NULL,
  `Docentes_idDocentes` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `idMateria` int NOT NULL,
  `nombreMateria` varchar(100) NOT NULL,
  `Carreras_idCarreras1` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`idMateria`, `nombreMateria`, `Carreras_idCarreras1`, `updated_at`, `created_at`) VALUES
(5, ' DESARROLLO E IMPLEMENTACION DE SISTEMAS DE INFORMACION', 6, '2021-07-13 12:10:23', '2021-07-13 12:10:23'),
(6, ' DESARROLLO DE APLICACIONES PARA DISPOSITIVOS MOVILES', 6, '2021-07-13 12:10:39', '2021-07-13 12:10:39'),
(7, ' SOFTWARE INTERACTIVO Y VIDEOJUEGOS', 6, '2021-07-13 12:10:48', '2021-07-13 12:10:48'),
(8, 'PROGRAMACION AVANZADA DE SOFTWARE', 6, '2021-07-13 12:11:02', '2021-07-13 12:11:02'),
(9, 'COMPUTO EN LA NUBE', 6, '2021-07-13 12:11:17', '2021-07-13 12:11:17'),
(10, 'INGLES V', 6, '2021-07-13 12:11:30', '2021-07-13 12:11:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2021_06_26_015448_create_sessions_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modalidades`
--

CREATE TABLE `modalidades` (
  `idModalidades` int NOT NULL,
  `nombreModalidad` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `modalidades`
--

INSERT INTO `modalidades` (`idModalidades`, `nombreModalidad`) VALUES
(1, 'Escolarizado'),
(2, 'Semi-Escolarizado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `idNotificaciones` int NOT NULL,
  `tipo` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `idSolicituAsesorias` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`idNotificaciones`, `tipo`, `created_at`, `updated_at`, `idSolicituAsesorias`) VALUES
(4, 'Solicitud', '2021-07-09 23:21:57', '2021-07-09 23:21:57', 6),
(5, 'Autorización', '2021-07-09 23:23:27', '2021-07-09 23:23:27', 6),
(7, 'Autorización', '2021-07-15 04:54:19', '2021-07-15 04:54:19', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `revision_solicitudes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `revision_solicitudes` (
`idSolicitud` int
,`estudiante` varchar(91)
,`materiaSolicitada` varchar(100)
,`justificacion` varchar(200)
,`estado` varchar(45)
,`updated_at` timestamp
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `roles_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semestres`
--

CREATE TABLE `semestres` (
  `idSemestres` int NOT NULL,
  `numeroSemestre` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `semestres`
--

INSERT INTO `semestres` (`idSemestres`, `numeroSemestre`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('catxwOIK1CqSccxHw9eC5P99r4YgXa80JPSemZw6', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoibWc0Y0tGWGRCblAySmdjWmV3STdrc0F6elpDaWZxOU5KNzEyaVJpYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9NYXRlcmlhIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJFNGZnlXTmNxMEVmMHZscEJKTW5IN3VIZWdTVy8vTjFRM3NaeU1jM3J0eHNsUjhleWJMd05HIjtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMCRTRmZ5V05jcTBFZjB2bHBCSk1uSDd1SGVnU1cvL04xUTNzWnlNYzNydHhzbFI4ZXliTHdORyI7fQ==', 1625276213),
('dTmmrRQaMNHXTs5Zm7rGN8jSecgLVjXOqqDvEHz3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiSHUySjZGQ1dYc1IwcjFXWkhKNGNRUkUzYVhkeTlpZzlxcjVIOTRkWCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1625514893),
('SqAj3vdFi59vhhPjjvueXEtMGnGmXQW4FBTu4py4', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoibElTY0hueWQ1ZFV2blUzR1ppMFJFZjk3bkRYb0pqNlg4eHk3ZGUxUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9NYXRlcmlhIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJFNGZnlXTmNxMEVmMHZscEJKTW5IN3VIZWdTVy8vTjFRM3NaeU1jM3J0eHNsUjhleWJMd05HIjtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMCRTRmZ5V05jcTBFZjB2bHBCSk1uSDd1SGVnU1cvL04xUTNzWnlNYzNydHhzbFI4ZXliTHdORyI7fQ==', 1625524890),
('vre4ZDCC52LSzhWeLxxO20zXyMqFa7uNsmyPs14V', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoieHA0R1NGY1hjZmJ0Q0Y1NnBTdUJHc0tLeUsza24zdDY4ZEhQNDFFZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9BbHVtbm8iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo1O3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkU0ZmeVdOY3EwRWYwdmxwQkpNbkg3dUhlZ1NXLy9OMVEzc1p5TWMzcnR4c2xSOGV5Ykx3TkciO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEwJFNGZnlXTmNxMEVmMHZscEJKTW5IN3VIZWdTVy8vTjFRM3NaeU1jM3J0eHNsUjhleWJMd05HIjt9', 1625515205),
('xRAdIL1fGyk3ESp39yrMIufrInQLF6hEGewE1OkD', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiZ3NiRTdpeHgwdU03bzdXbXZiczVBYkJhOXhhUTFoUGhoa25QSURwaSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1625273191),
('xseUZHM7xTzQdXuQ9VamtH0d490Gd92SqxMdwSFj', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoieFFLNFNob1VzWWViR1NsalNkdWltQTlyckFYdkRqTVFqVnBBUWp5YiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1625524681);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicituasesorias`
--

CREATE TABLE `solicituasesorias` (
  `idSolicituAsesorias` int NOT NULL,
  `justificacion` varchar(200) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `idEstudiantes` int NOT NULL,
  `idMateria` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `solicituasesorias`
--

INSERT INTO `solicituasesorias` (`idSolicituAsesorias`, `justificacion`, `estado`, `idEstudiantes`, `idMateria`, `updated_at`, `created_at`) VALUES
(1, ' Refuerzo de clase', 'Autorizada', 1, 8, '2021-07-15 04:54:19', '2021-07-15 04:49:42');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `solicitudes_estudiantes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `solicitudes_estudiantes` (
`idSolicitud` int
,`materiaSolicitada` varchar(100)
,`justificacion` varchar(200)
,`estado` varchar(45)
,`idEstudiantes` int
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Isaac salome gandara', 'isaacsalome1704@gmail.com', NULL, '$2y$10$e4.IrSTeaAa3.G9rneHIVu0MCiH0o7fAR69dLl9URMIQKRf3hoX.e', NULL, NULL, NULL, NULL, NULL, '2021-07-01 04:01:19', '2021-07-01 04:01:19'),
(5, 'Isaac', '17TE0176', NULL, '$2y$10$SFfyWNcq0Ef0vlpBJMnH7uHegSW//N1Q3sZyMc3rtxslR8eybLwNG', NULL, NULL, NULL, NULL, NULL, '2021-07-01 06:54:41', '2021-07-01 06:54:41'),
(6, 'Joel Said', '17TE0135', NULL, '$2y$10$1sSYuiEKBdke4i7lH7tbxu2Hp.HLxZxBn74blLaMf9OWzxaDa0RAe', NULL, NULL, NULL, NULL, NULL, '2021-07-01 07:01:46', '2021-07-01 07:01:46'),
(15, 'karen', '17TE512', NULL, '$2y$10$BiJF/vyDexUzpkk9li/BFuY4roe6LpK4tWW0.U5GzpuJ.8LLU9eua', NULL, NULL, NULL, NULL, NULL, '2021-07-06 15:25:35', '2021-07-06 15:25:35'),
(16, ' testeo', 'test', NULL, '$2y$10$CIGEpXnh3BhKtErKT7aMWeSawGUdZXKXfhAgth0RqBKxW1hkH7FqO', NULL, NULL, NULL, NULL, NULL, '2021-07-07 04:12:40', '2021-07-07 04:12:40');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_notifaut`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_notifaut` (
`idnotif` int
,`Fecha` date
,`estudiante` varchar(91)
,`tipo` varchar(15)
,`nombreMateria` varchar(100)
,`id_user` bigint unsigned
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vistaalumnos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vistaalumnos` (
`id` bigint unsigned
,`nombreCompleto` varchar(91)
,`semestre` varchar(15)
,`numerocontrol` varchar(191)
,`carrera` varchar(91)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vistadocentes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vistadocentes` (
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vistamaterias`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vistamaterias` (
`id` int
,`materia` varchar(100)
,`carrera` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_horarioalumnos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_horarioalumnos` (
`idHorariosAlumnos` int
,`idEstudiantes` int
,`materia` varchar(100)
,`dia` varchar(10)
,`hora` varchar(11)
,`docente` varchar(91)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_horariogeneral`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_horariogeneral` (
`idHorarios` int
,`dia` varchar(10)
,`Horario` varchar(11)
,`materia` varchar(100)
,`numeroSemestre` int
,`docente` varchar(91)
,`idDocentes` int
);

-- --------------------------------------------------------

--
-- Estructura para la vista `revision_solicitudes`
--
DROP TABLE IF EXISTS `revision_solicitudes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `revision_solicitudes`  AS SELECT `sa`.`idSolicituAsesorias` AS `idSolicitud`, concat(`e`.`nombre`,' ',`e`.`apellido`) AS `estudiante`, `m`.`nombreMateria` AS `materiaSolicitada`, `sa`.`justificacion` AS `justificacion`, `sa`.`estado` AS `estado`, `sa`.`updated_at` AS `updated_at` FROM ((`solicituasesorias` `sa` join `estudiantes` `e` on((`sa`.`idEstudiantes` = `e`.`idEstudiantes`))) join `materias` `m` on((`sa`.`idMateria` = `m`.`idMateria`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `solicitudes_estudiantes`
--
DROP TABLE IF EXISTS `solicitudes_estudiantes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `solicitudes_estudiantes`  AS SELECT `sa`.`idSolicituAsesorias` AS `idSolicitud`, `m`.`nombreMateria` AS `materiaSolicitada`, `sa`.`justificacion` AS `justificacion`, `sa`.`estado` AS `estado`, `sa`.`idEstudiantes` AS `idEstudiantes` FROM ((`solicituasesorias` `sa` join `estudiantes` `e` on((`sa`.`idEstudiantes` = `e`.`idEstudiantes`))) join `materias` `m` on((`sa`.`idMateria` = `m`.`idMateria`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_notifaut`
--
DROP TABLE IF EXISTS `view_notifaut`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_notifaut`  AS SELECT `n`.`idNotificaciones` AS `idnotif`, cast(`n`.`created_at` as date) AS `Fecha`, concat(`e`.`nombre`,' ',`e`.`apellido`) AS `estudiante`, `n`.`tipo` AS `tipo`, `m`.`nombreMateria` AS `nombreMateria`, `u`.`id_user` AS `id_user` FROM ((((`notificaciones` `n` join `solicituasesorias` `sa` on((`n`.`idSolicituAsesorias` = `sa`.`idSolicituAsesorias`))) join `estudiantes` `e` on((`sa`.`idEstudiantes` = `e`.`idEstudiantes`))) join `users` `u` on((`e`.`Users_id` = `u`.`id_user`))) join `materias` `m` on((`sa`.`idMateria` = `m`.`idMateria`))) WHERE (`n`.`tipo` = 'Autorización') ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vistaalumnos`
--
DROP TABLE IF EXISTS `vistaalumnos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vistaalumnos`  AS SELECT `u`.`id_user` AS `id`, concat(`e`.`nombre`,' ',`e`.`apellido`) AS `nombreCompleto`, concat(`s`.`numeroSemestre`,'° ',`e`.`grupo`) AS `semestre`, `u`.`email` AS `numerocontrol`, concat(`c`.`nombreCarrera`,' ',`m`.`nombreModalidad`) AS `carrera` FROM ((((`estudiantes` `e` join `carreras` `c` on((`e`.`Carreras_idCarreras` = `c`.`idCarreras`))) join `semestres` `s` on((`e`.`Semestres_idSemestres` = `s`.`idSemestres`))) join `modalidades` `m` on((`e`.`Modalidades_idModalidades` = `m`.`idModalidades`))) join `users` `u` on((`e`.`Users_id` = `u`.`id_user`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vistadocentes`
--
DROP TABLE IF EXISTS `vistadocentes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vistadocentes`  AS SELECT `u`.`id_user` AS `id`, concat(`d`.`nombre`,' ',`d`.`apellidos`) AS `nombreCompleto`, `u`.`email` AS `numerocontrol` FROM (`docentes` `d` join `users` `u` on((`d`.`users_id_user` = `u`.`id_user`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vistamaterias`
--
DROP TABLE IF EXISTS `vistamaterias`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vistamaterias`  AS SELECT `m`.`idMateria` AS `id`, `m`.`nombreMateria` AS `materia`, `c`.`nombreCarrera` AS `carrera` FROM (`materias` `m` join `carreras` `c` on((`m`.`Carreras_idCarreras1` = `c`.`idCarreras`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_horarioalumnos`
--
DROP TABLE IF EXISTS `vista_horarioalumnos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_horarioalumnos`  AS SELECT `ha`.`idHorariosAlumnos` AS `idHorariosAlumnos`, `ha`.`idEstudiantes` AS `idEstudiantes`, `m`.`nombreMateria` AS `materia`, `di`.`descripcion` AS `dia`, concat(hour(`h`.`HoraInicial`),' - ',hour(`h`.`HoraFinal`)) AS `hora`, concat(`d`.`nombre`,' ',`d`.`apellidos`) AS `docente` FROM ((((`horariosalumnos` `ha` join `horarios` `h` on((`ha`.`idHorarios` = `h`.`idHorarios`))) join `docentes` `d` on((`h`.`id_docente` = `d`.`idDocentes`))) join `materias` `m` on((`h`.`idMateria` = `m`.`idMateria`))) join `dias` `di` on((`h`.`iddia` = `di`.`idDia`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_horariogeneral`
--
DROP TABLE IF EXISTS `vista_horariogeneral`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_horariogeneral`  AS SELECT `h`.`idHorarios` AS `idHorarios`, `di`.`descripcion` AS `dia`, concat(hour(`h`.`HoraInicial`),' - ',hour(`h`.`HoraFinal`)) AS `Horario`, `m`.`nombreMateria` AS `materia`, `s`.`numeroSemestre` AS `numeroSemestre`, concat(`d`.`nombre`,' ',`d`.`apellidos`) AS `docente`, `h`.`id_docente` AS `idDocentes` FROM (((((`horarios` `h` join `materias` `m` on((`h`.`idMateria` = `m`.`idMateria`))) join `modalidades` `mo` on((`h`.`idModalidades` = `mo`.`idModalidades`))) join `semestres` `s` on((`h`.`idSemestres` = `s`.`idSemestres`))) join `docentes` `d` on((`h`.`id_docente` = `d`.`idDocentes`))) join `dias` `di` on((`h`.`iddia` = `di`.`idDia`))) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asesorias`
--
ALTER TABLE `asesorias`
  ADD PRIMARY KEY (`idAsesorias`),
  ADD KEY `fk_Asesorias_Estudiantes1_idx` (`Estudiantes_idEstudiantes`),
  ADD KEY `fk_Asesorias_Docentes1_idx` (`Docentes_idDocentes`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`idCarreras`);

--
-- Indices de la tabla `dias`
--
ALTER TABLE `dias`
  ADD PRIMARY KEY (`idDia`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`idDocentes`),
  ADD KEY `fk_Docentes_users1_idx` (`Users_id`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`idEstudiantes`),
  ADD KEY `fk_Estudiantes_Semestres1_idx` (`Semestres_idSemestres`),
  ADD KEY `fk_Estudiantes_Carreras1_idx` (`Carreras_idCarreras`),
  ADD KEY `fk_Estudiantes_Modalidades1_idx` (`Modalidades_idModalidades`),
  ADD KEY `fk_Estudiantes_users1_idx` (`Users_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`idHorarios`),
  ADD KEY `fk_Horarios_Materia3_idx` (`idMateria`),
  ADD KEY `fk_Horarios_Modalidades3_idx` (`idModalidades`),
  ADD KEY `fk_horario_docentes` (`id_docente`),
  ADD KEY `fk_Horarios_Dias` (`iddia`),
  ADD KEY `fk_Horarios_Semestre` (`idSemestres`);

--
-- Indices de la tabla `horariosalumnos`
--
ALTER TABLE `horariosalumnos`
  ADD PRIMARY KEY (`idHorariosAlumnos`),
  ADD KEY `fk_HorariosAlumnos_Horarios1_idx` (`idHorarios`),
  ADD KEY `fk_HorariosAlumnos_Estudiantes1_idx` (`idEstudiantes`);

--
-- Indices de la tabla `horariosdocentes`
--
ALTER TABLE `horariosdocentes`
  ADD PRIMARY KEY (`idHorariosDocentes`,`Docentes_idDocentes`),
  ADD KEY `fk_HorariosDocentes_Horarios1_idx` (`Horarios_idHorarios`),
  ADD KEY `fk_HorariosDocentes_Docentes1_idx` (`Docentes_idDocentes`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`idMateria`),
  ADD KEY `fk_Materia_Carreras1_idx` (`Carreras_idCarreras1`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modalidades`
--
ALTER TABLE `modalidades`
  ADD PRIMARY KEY (`idModalidades`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`),
  ADD KEY `fk_model_has_permissions_permissions1_idx` (`model_id`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`),
  ADD KEY `fk_model_has_roles_roles1_idx` (`model_id`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`idNotificaciones`),
  ADD KEY `fk_Notificaciones_SolicituAsesorias1_idx` (`idSolicituAsesorias`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD KEY `fk_role_has_permissions_permissions1_idx` (`permission_id`),
  ADD KEY `fk_role_has_permissions_roles1_idx` (`roles_id`);

--
-- Indices de la tabla `semestres`
--
ALTER TABLE `semestres`
  ADD PRIMARY KEY (`idSemestres`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `solicituasesorias`
--
ALTER TABLE `solicituasesorias`
  ADD PRIMARY KEY (`idSolicituAsesorias`),
  ADD KEY `fk_SolicituAsesorias_Estudiantes1_idx` (`idEstudiantes`),
  ADD KEY `fk_SolicituAsesorias_Materia1_idx` (`idMateria`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asesorias`
--
ALTER TABLE `asesorias`
  MODIFY `idAsesorias` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `idCarreras` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `dias`
--
ALTER TABLE `dias`
  MODIFY `idDia` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `idDocentes` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `idEstudiantes` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `idHorarios` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `horariosalumnos`
--
ALTER TABLE `horariosalumnos`
  MODIFY `idHorariosAlumnos` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `horariosdocentes`
--
ALTER TABLE `horariosdocentes`
  MODIFY `idHorariosDocentes` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `idMateria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `modalidades`
--
ALTER TABLE `modalidades`
  MODIFY `idModalidades` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  MODIFY `permission_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  MODIFY `role_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `idNotificaciones` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `semestres`
--
ALTER TABLE `semestres`
  MODIFY `idSemestres` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `solicituasesorias`
--
ALTER TABLE `solicituasesorias`
  MODIFY `idSolicituAsesorias` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asesorias`
--
ALTER TABLE `asesorias`
  ADD CONSTRAINT `fk_Asesorias_Docentes1` FOREIGN KEY (`Docentes_idDocentes`) REFERENCES `docentes` (`idDocentes`),
  ADD CONSTRAINT `fk_Asesorias_Estudiantes1` FOREIGN KEY (`Estudiantes_idEstudiantes`) REFERENCES `estudiantes` (`idEstudiantes`);

--
-- Filtros para la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD CONSTRAINT `fk_Docentes_users1` FOREIGN KEY (`Users_id`) REFERENCES `users` (`id_user`);

--
-- Filtros para la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD CONSTRAINT `fk_Estudiantes_Carreras1` FOREIGN KEY (`Carreras_idCarreras`) REFERENCES `carreras` (`idCarreras`),
  ADD CONSTRAINT `fk_Estudiantes_Modalidades1` FOREIGN KEY (`Modalidades_idModalidades`) REFERENCES `modalidades` (`idModalidades`),
  ADD CONSTRAINT `fk_Estudiantes_Semestres1` FOREIGN KEY (`Semestres_idSemestres`) REFERENCES `semestres` (`idSemestres`),
  ADD CONSTRAINT `fk_Estudiantes_users1` FOREIGN KEY (`Users_id`) REFERENCES `users` (`id_user`);

--
-- Filtros para la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `fk_Horarios_Dias` FOREIGN KEY (`iddia`) REFERENCES `dias` (`idDia`),
  ADD CONSTRAINT `fk_Horarios_Docentes` FOREIGN KEY (`id_docente`) REFERENCES `docentes` (`idDocentes`),
  ADD CONSTRAINT `fk_Horarios_Materia2` FOREIGN KEY (`idMateria`) REFERENCES `materias` (`idMateria`),
  ADD CONSTRAINT `fk_Horarios_Modalidades2` FOREIGN KEY (`idModalidades`) REFERENCES `modalidades` (`idModalidades`),
  ADD CONSTRAINT `fk_Horarios_Semestre` FOREIGN KEY (`idSemestres`) REFERENCES `semestres` (`idSemestres`);

--
-- Filtros para la tabla `horariosalumnos`
--
ALTER TABLE `horariosalumnos`
  ADD CONSTRAINT `fk_HorariosAlumnos_Estudiantes1` FOREIGN KEY (`idEstudiantes`) REFERENCES `estudiantes` (`idEstudiantes`),
  ADD CONSTRAINT `fk_HorariosAlumnos_Horarios1` FOREIGN KEY (`idHorarios`) REFERENCES `horarios` (`idHorarios`);

--
-- Filtros para la tabla `horariosdocentes`
--
ALTER TABLE `horariosdocentes`
  ADD CONSTRAINT `fk_HorariosDocentes_Docentes1` FOREIGN KEY (`Docentes_idDocentes`) REFERENCES `docentes` (`idDocentes`),
  ADD CONSTRAINT `fk_HorariosDocentes_Horarios1` FOREIGN KEY (`Horarios_idHorarios`) REFERENCES `horarios` (`idHorarios`);

--
-- Filtros para la tabla `materias`
--
ALTER TABLE `materias`
  ADD CONSTRAINT `fk_Materia_Carreras1` FOREIGN KEY (`Carreras_idCarreras1`) REFERENCES `carreras` (`idCarreras`);

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `fk_model_has_permissions_permissions1` FOREIGN KEY (`model_id`) REFERENCES `permissions` (`id`);

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `fk_model_has_roles_roles1` FOREIGN KEY (`model_id`) REFERENCES `roles` (`id`);

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `fk_idsolicitud` FOREIGN KEY (`idSolicituAsesorias`) REFERENCES `solicituasesorias` (`idSolicituAsesorias`);

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `fk_role_has_permissions_permissions1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  ADD CONSTRAINT `fk_role_has_permissions_roles1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`);

--
-- Filtros para la tabla `solicituasesorias`
--
ALTER TABLE `solicituasesorias`
  ADD CONSTRAINT `fk_SolicituAsesorias_Estudiantes1` FOREIGN KEY (`idEstudiantes`) REFERENCES `estudiantes` (`idEstudiantes`),
  ADD CONSTRAINT `fk_SolicituAsesorias_Materia1` FOREIGN KEY (`idMateria`) REFERENCES `materias` (`idMateria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
