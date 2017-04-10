-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Апр 10 2017 г., 18:37
-- Версия сервера: 10.1.10-MariaDB
-- Версия PHP: 7.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `oop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `albums`
--

CREATE TABLE `albums` (
  `id` int(3) UNSIGNED NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `dir` varchar(32) DEFAULT NULL,
  `photoList` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(3) UNSIGNED NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `author` varchar(32) DEFAULT NULL,
  `text` varchar(3200) DEFAULT NULL,
  `tags` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `name`, `date`, `author`, `text`, `tags`) VALUES
(1, 'новость1skjjhksdfbgslhk', '2017-04-10', 'Иван', 'blablabla', 'tag1'),
(2, 'new_2', '2017-02-24', '2', 'dfbhkbs hkdbhksd fbljsd', 'sthsh'),
(3, 'qazwsx', '1234-12-12', 'gfjfjffjjf', 'sffh hsddjss djs ', 'dghjsdgsgg'),
(29, 'titleAdmin', '2017-04-03', 'Иван', 'textAdmin', 'tagsAdmin'),
(32, '1111wetjhjfhfx.nbkjx', '2017-04-10', 'Никита', '22', 'dtfhstdhs'),
(33, 'newsTitle1+-------------', '2017-04-10', 'Никита', 'newsText1+', 'newsTags1+');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id_user` int(3) UNSIGNED NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `surname` varchar(32) DEFAULT NULL,
  `login` varchar(32) NOT NULL,
  `pass` char(32) NOT NULL,
  `mode` varchar(32) DEFAULT NULL,
  `user_session` varchar(32) DEFAULT NULL,
  `user_token` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id_user`, `name`, `surname`, `login`, `pass`, `mode`, `user_session`, `user_token`) VALUES
(1, 'Иван', 'Иванов', 'login', '5f4dcc3b5aa765d61d8327deb882cf99', 'admin', 're99oh3al4rrr8pqaqb0ikalq5', 'lxvtec3xptj4aar3j8u39lfttvki20vu'),
(2, 'Никита', 'Назаров', 'niknaz', '0dfae1e446f1db8677b013517f91c1b0', 'user', 'nm1ul28spfer10b9enuu72s7k5', 'jx0g8xthpf5wdk9j7yuspm4fu8uv2u6x'),
(3, 'имя имя', 'фамилия фамилия', 'loginlogin', '9dbb300e28bc21c8dab41b01883918eb', 'user', NULL, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
