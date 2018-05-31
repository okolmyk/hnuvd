-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 31 2018 г., 11:20
-- Версия сервера: 5.7.22-0ubuntu0.16.04.1
-- Версия PHP: 7.0.30-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `hnuvd`
--

-- --------------------------------------------------------

--
-- Структура таблицы `hnuvd_migration`
--

CREATE TABLE `hnuvd_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `hnuvd_migration`
--

INSERT INTO `hnuvd_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1527245678),
('m180525_104723_users', 1527245681),
('m180526_163031_users_add_column', 1527355316),
('m180530_180905_alter_col', 1527704343);

-- --------------------------------------------------------

--
-- Структура таблицы `hnuvd_users`
--

CREATE TABLE `hnuvd_users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `adminGroup` enum('admin','monitor','manager') DEFAULT NULL,
  `auth_key` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `hnuvd_users`
--

INSERT INTO `hnuvd_users` (`id`, `email`, `password`, `adminGroup`, `auth_key`) VALUES
(1, 'admin@mail.ru', '123456', 'admin', 123456),
(2, 'monitor@mail.ru', '987654', 'monitor', 987654),
(3, 'manager@mail.ru', '888888', 'manager', 888888);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `hnuvd_migration`
--
ALTER TABLE `hnuvd_migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `hnuvd_users`
--
ALTER TABLE `hnuvd_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `hnuvd_users`
--
ALTER TABLE `hnuvd_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
