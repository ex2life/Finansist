-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 03 2017 г., 23:27
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
  `name` varchar(100) NOT NULL,
  `opf` tinyint(1) NOT NULL,
  `inn` bigint(12) NOT NULL,
  `sno` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `opf`
--

CREATE TABLE `opf` (
  `id` tinyint(1) NOT NULL,
  `brief_name` varchar(10) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `inn_length` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `opf`
--

INSERT INTO `opf` (`id`, `brief_name`, `full_name`, `inn_length`) VALUES
(1, 'ИП', 'Индивидуальный предприниматель', 12),
(2, 'ООО', 'Общество с ограниченной ответственностью ', 10),
(3, 'АО', 'Акционерное общество', 10),
(4, 'ПАО', 'Публичное акционерное общество', 10);

-- --------------------------------------------------------

--
-- Структура таблицы `sno`
--

CREATE TABLE `sno` (
  `id` int(11) NOT NULL,
  `brief_name` int(11) NOT NULL,
  `Full_name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(64) NOT NULL,
  `nickname` varchar(64) NOT NULL,
  `password` varchar(124) NOT NULL,
  `fullname` varchar(80) DEFAULT NULL,
  `newsletter` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `nickname`, `password`, `fullname`, `newsletter`) VALUES
(6, 'abramizsaransk@gmail.com', 'ex2life', '$1$op4.R80.$4LykvO/VJ6j6F5llaRQ0D/', 'Абрамов Сергей', 1),
(7, 'sdfsdf@dsfsdf.sdf', 'lolol', '$1$Bs3.051.$xnsQe8s2PmcRBBoaKbEf8/', 'sdfsdf', 1),
(8, 'dfgfdf@fsfdgf.sdf', 'frog5', '$1$b//.Is..$y.DsB9JdwmNX19oJZMaHO/', 'frog5', 1),
(9, 'frog6@frog6.ty', 'frog6', '$1$Un4.Ni2.$OKggiBJlttYH1tc1HdgLk.', 'frog6frog6', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

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
  MODIFY `company_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
