-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 20 2024 г., 23:13
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `demo1605`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auto`
--

CREATE TABLE `auto` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `auto`
--

INSERT INTO `auto` (`id`, `name`) VALUES
(1, 'BMW M5'),
(2, 'LADA CALINA'),
(3, 'Супер кар');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id_order` int(255) NOT NULL,
  `id_user` int(255) NOT NULL,
  `id_auto` int(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Новое',
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id_order`, `id_user`, `id_auto`, `status`, `date`) VALUES
(24, 27, 1, ' Подтверждено', '2024-05-01'),
(25, 25, 1, 'Отклонено', '2024-05-03'),
(26, 25, 1, ' Подтверждено', '2024-05-05'),
(27, 28, 2, 'Новое', '2024-05-26'),
(28, 29, 1, 'Отклонено', '2024-04-30'),
(29, 29, 2, 'Новое', '2024-05-05'),
(30, 29, 2, 'Новое', '2024-06-02'),
(31, 29, 3, 'Новое', '2024-06-01'),
(32, 29, 2, 'Новое', '2024-05-06'),
(33, 29, 2, 'Новое', '2024-05-04');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `fio` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `auto_serial` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `fio`, `phone_number`, `email`, `pass`, `auto_serial`, `role`) VALUES
(23, '', '', 'car', 'carforme', '', 'admin'),
(24, 'Русаков Илья Олегович', '79651479875 ', 'ilya@gmail.com', '1ds', '123123123123', 'user'),
(25, 'Иванов Иван Иванович', '79543453453 ', 'ivan@gmail.com', '123a', '123123', 'user'),
(26, 'Жопа Сиська Писковна', '79856432299 ', 'rtbcht2@gmail.com', '123456', 'паспорт', 'user'),
(27, '123123123123123123123123123', '123123123123123123123123123123', '123123123123123123123123', '123', '', 'user'),
(28, 'Константинопольский Григорий Александрович', '7-123-456-78-90 ', 'kosta@mail.ru', '123a', '12 34 456789', 'user'),
(29, '', '', '123', '123', '', 'user');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auto`
--
ALTER TABLE `auto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_user` (`id_user`,`id_auto`),
  ADD KEY `id_auto` (`id_auto`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `auto`
--
ALTER TABLE `auto`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_auto`) REFERENCES `auto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
