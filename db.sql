-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 07 2018 г., 15:07
-- Версия сервера: 5.6.37
-- Версия PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `dokuments`
--

CREATE TABLE `dokuments` (
  `id_doc` int(11) NOT NULL,
  `doc` longblob NOT NULL,
  `type_doc` int(11) NOT NULL,
  `vho_doc` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `mslog`
--

CREATE TABLE `mslog` (
  `timeyear` varchar(255) DEFAULT NULL,
  `timemonth` varchar(255) DEFAULT NULL,
  `timeday` varchar(255) DEFAULT NULL,
  `timehour` varchar(255) DEFAULT NULL,
  `timeminute` varchar(255) DEFAULT NULL,
  `timesecond` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `port` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `uniqie_ips` text COLLATE utf8_unicode_ci NOT NULL,
  `all_ips` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`type`, `uniqie_ips`, `all_ips`) VALUES
('masterserver', 'data: [0, 0, 0, 0, 0, 0, 0]', 'data: [0, 0, 0, 0, 0, 0, 0]');

-- --------------------------------------------------------

--
-- Структура таблицы `type_doc`
--

CREATE TABLE `type_doc` (
  `id_type_doc` int(11) NOT NULL,
  `type_doc` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  `pass` varchar(10) NOT NULL,
  `type_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `type_user`) VALUES
(1, 'admin', '221AA3ZNK', 1),
(2, 'menedj', '123AA3NK', 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `dokuments`
--
ALTER TABLE `dokuments`
  ADD PRIMARY KEY (`id_doc`),
  ADD KEY `type_doc` (`type_doc`),
  ADD KEY `vho_doc` (`vho_doc`);

--
-- Индексы таблицы `type_doc`
--
ALTER TABLE `type_doc`
  ADD PRIMARY KEY (`id_type_doc`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `dokuments`
--
ALTER TABLE `dokuments`
  MODIFY `id_doc` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `type_doc`
--
ALTER TABLE `type_doc`
  MODIFY `id_type_doc` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
