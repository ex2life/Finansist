-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 17 2017 г., 00:45
-- Версия сервера: 5.6.37
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Finansist`
--

-- --------------------------------------------------------

--
-- Структура таблицы `company`
--

CREATE TABLE `company` (
  `company_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `name` char(100) NOT NULL,
  `opf` tinyint(1) NOT NULL,
  `inn` bigint(12) NOT NULL,
  `sno` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `company`
--

INSERT INTO `company` (`company_id`, `user_id`, `name`, `opf`, `inn`, `sno`) VALUES
(1, 11, 'Toyota', 3, 55566677799, 1),
(2, 12, 'Kik', 1, 145125478546, 3),
(3, 11, 'BMW', 4, 66655566655, 2),
(4, 12, 'Coca-Cola', 2, 12345678912, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `Confirm_email`
--

CREATE TABLE `Confirm_email` (
  `user_id` bigint(20) NOT NULL,
  `Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Confirm_email`
--

INSERT INTO `Confirm_email` (`user_id`, `Status`) VALUES
(11, 1),
(12, 1),
(24, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `GSZ`
--

CREATE TABLE `GSZ` (
  `Id` tinyint(2) UNSIGNED NOT NULL,
  `Brief_Name` char(10) NOT NULL,
  `Full_Name` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `GSZ`
--

INSERT INTO `GSZ` (`Id`, `Brief_Name`, `Full_Name`) VALUES
(1, 'Группа 1', 'Описание первой группы связанных заемщиков'),
(2, 'Группа 2', 'Описание второй группы связанных заемщиков');

-- --------------------------------------------------------

--
-- Структура таблицы `opf`
--

CREATE TABLE `opf` (
  `id` tinyint(1) NOT NULL,
  `brief_name` char(10) NOT NULL,
  `full_name` char(100) NOT NULL,
  `inn_length` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `opf`
--

INSERT INTO `opf` (`id`, `brief_name`, `full_name`, `inn_length`) VALUES
(1, 'ИП', 'Индивидуальный предприниматель', 12),
(2, 'ООО', 'Общество с ограниченной ответственностью', 10),
(3, 'АО', 'Акционерное общество', 10),
(4, 'ПАО', 'Публичное акционерное общество', 10);

-- --------------------------------------------------------

--
-- Структура таблицы `sno`
--

CREATE TABLE `sno` (
  `id` int(11) NOT NULL,
  `brief_name` char(20) NOT NULL,
  `Full_name` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sno`
--

INSERT INTO `sno` (`id`, `brief_name`, `Full_name`) VALUES
(1, 'ОСНО', 'Общая система налогообложения, уплачивается НДС.'),
(2, 'УСН/Д-Р', 'Упрощенная система  налогообложения, объект обложения – доходы, уменьшенные на величину расходов.'),
(3, 'УСН/Д', 'Упрощенная система налогообложения, объект обложения – доходы.'),
(4, 'ЕСХН', 'Единый сельхозналог.');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` char(64) NOT NULL,
  `nickname` char(64) NOT NULL,
  `password` char(225) NOT NULL,
  `fullname` char(100) DEFAULT NULL,
  `newsletter` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `nickname`, `password`, `fullname`, `newsletter`) VALUES
(11, 'abramizsaransk@gmail.com', 'ex2life', '$1$/E4.a8/.$MoV/pYGc3j0miMuzvyJ.Z/', 'Sergey Abramov', 0),
(12, 'prosto1@prosto1.ru', 'prosto1', '$1$iU4.Dz..$y8vGjUnEnIjPwtbbs3slf.', 'Обычный пользователь', 1),
(14, 'adolf@adolf.ri', 'adolf', '$2y$10$cblmXWcQS7dhrmVoEfsAueM6rxNFVtGxKcrIy.v7EtmMiXuXg8rjq', 'adolf adolf adolf', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Индексы таблицы `GSZ`
--
ALTER TABLE `GSZ`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`nickname`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `company`
--
ALTER TABLE `company`
  MODIFY `company_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `GSZ`
--
ALTER TABLE `GSZ`
  MODIFY `Id` tinyint(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
