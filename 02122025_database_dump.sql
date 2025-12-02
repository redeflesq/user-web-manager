-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 02 2025 г., 12:34
-- Версия сервера: 10.4.11-MariaDB
-- Версия PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `my_database`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$ufrFdVPTLb36Y.WEqnj2TuqFITlWP9DYQVnwAN3O7GcSWszDVeHm2', '2025-12-02 11:08:55');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `first_name`, `last_name`, `gender`, `birth_date`, `created_at`) VALUES
(6, 'user006', '$2y$10$uN6NfT1G8Uh1b8bpvkerU.6Wu02WfJXwzF1RrL7940zERcVOYcFZi', 'David', 'Wilson', 'male', '1993-04-10', '2025-12-02 11:46:15'),
(7, 'user007', '$2y$10$uN6NfT1G8Uh1b8bpvkerU.6Wu02WfJXwzF1RrL7940zERcVOYcFZi', 'Alice', 'Taylor', 'female', '1994-01-18', '2025-12-02 11:46:15'),
(16, 'user012', '$2y$10$uN6NfT1G8Uh1b8bpvkerU.6Wu02WfJXwzF1RrL7940zERcVOYcFZi', 'Henry', 'Martin', 'male', '1990-08-09', '2025-12-02 11:46:15'),
(17, 'user013', '$2y$10$uN6NfT1G8Uh1b8bpvkerU.6Wu02WfJXwzF1RrL7940zERcVOYcFZi', 'Chloe', 'Thompson', 'female', '1998-10-15', '2025-12-02 11:46:15'),
(19, 'user015', '$2y$10$uN6NfT1G8Uh1b8bpvkerU.6Wu02WfJXwzF1RrL7940zERcVOYcFZi', 'Ella', 'Garcia', 'female', '1999-07-30', '2025-12-02 11:46:15'),
(20, 'user016', '$2y$10$uN6NfT1G8Uh1b8bpvkerU.6Wu02WfJXwzF1RrL7940zERcVOYcFZi', 'Lucas', 'Young', 'male', '1996-03-05', '2025-12-02 11:46:15'),
(21, 'user017', '$2y$10$uN6NfT1G8Uh1b8bpvkerU.6Wu02WfJXwzF1RrL7940zERcVOYcFZi', 'Grace', 'Hernandez', 'female', '1995-12-11', '2025-12-02 11:46:15'),
(22, 'user018', '$2y$10$uN6NfT1G8Uh1b8bpvkerU.6Wu02WfJXwzF1RrL7940zERcVOYcFZi', 'Ethan', 'King', 'male', '1997-06-19', '2025-12-02 11:46:15'),
(23, 'user019', '$2y$10$uN6NfT1G8Uh1b8bpvkerU.6Wu02WfJXwzF1RrL7940zERcVOYcFZi', 'Ava', 'Wright', 'female', '1993-11-04', '2025-12-02 11:46:15'),
(24, 'user020', '$2y$10$uN6NfT1G8Uh1b8bpvkerU.6Wu02WfJXwzF1RrL7940zERcVOYcFZi', 'Nathan', 'Scott', 'male', '1992-02-16', '2025-12-02 11:46:15'),
(25, 'user021', '$2y$10$uN6NfT1G8Uh1b8bpvkerU.6Wu02WfJXwzF1RrL7940zERcVOYcFZi', 'Emma', 'Green', 'female', '1994-09-02', '2025-12-02 11:46:15'),
(26, 'user022', '$2y$10$uN6NfT1G8Uh1b8bpvkerU.6Wu02WfJXwzF1RrL7940zERcVOYcFZi', 'Leo', 'Hall', 'male', '1991-07-14', '2025-12-02 11:46:15'),
(27, 'user023', '$2y$10$uN6NfT1G8Uh1b8bpvkerU.6Wu02WfJXwzF1RrL7940zERcVOYcFZi', 'Ruby', 'Adams', 'female', '1998-12-25', '2025-12-02 11:46:15'),
(28, 'user024', '$2y$10$uN6NfT1G8Uh1b8bpvkerU.6Wu02WfJXwzF1RrL7940zERcVOYcFZi', 'Jason', 'Nelson', 'male', '1990-10-09', '2025-12-02 11:46:15'),
(29, 'user025', '$2y$10$uN6NfT1G8Uh1b8bpvkerU.6Wu02WfJXwzF1RrL7940zERcVOYcFZi', 'Mia', 'Mitchell', 'female', '1996-01-12', '2025-12-02 11:46:15'),
(30, 'user026', '$2y$10$uN6NfT1G8Uh1b8bpvkerU.6Wu02WfJXwzF1RrL7940zERcVOYcFZi', 'Adam', 'Perez', 'male', '1995-05-22', '2025-12-02 11:46:15'),
(31, 'user027', '$2y$10$uN6NfT1G8Uh1b8bpvkerU.6Wu02WfJXwzF1RrL7940zERcVOYcFZi', 'Isabella', 'Roberts', 'female', '1993-08-16', '2025-12-02 11:46:15'),
(33, 'user029', '$2y$10$uN6NfT1G8Uh1b8bpvkerU.6Wu02WfJXwzF1RrL7940zERcVOYcFZi', 'Lily', 'Phillips', 'female', '1999-03-18', '2025-12-02 11:46:15'),
(34, 'user030', '$2y$10$uN6NfT1G8Uh1b8bpvkerU.6Wu02WfJXwzF1RrL7940zERcVOYcFZi', 'Jack', 'Campbell', 'male', '1994-12-28', '2025-12-02 11:46:15'),
(35, 'redeflesq1', '$2y$10$GffjoUeFI4gQQaWsZi0cfed.YffLL0bKT8fWb1LkcpRfhBY677z/a', 'Michael', 'Johnson0', 'female', '1995-11-05', '2025-12-02 12:32:07');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
