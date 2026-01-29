-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Янв 29 2026 г., 16:21
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
-- База данных: `rus_auto`
--

-- --------------------------------------------------------

--
-- Структура таблицы `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `slug` varchar(120) NOT NULL,
  `logo_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `logo_path`) VALUES
(1, 'BMW', 'rusifikaciya_bmw', '/src/img/bmw.png'),
(2, 'TOYOTA', 'rusifikaciya_toyota', '/src/img/toyota.png'),
(3, 'HONDA', 'rusifikaciya_honda', '/src/img/honda.png'),
(4, 'GEELY', 'rusifikaciya_geely', '/src/img/geely.png'),
(5, 'MERCEDEC', 'rusifikaciya_mercedec', '/src/img/geely.png');

-- --------------------------------------------------------

--
-- Структура таблицы `models`
--

CREATE TABLE `models` (
  `id` int(10) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `description` text DEFAULT NULL,
  `photo_path` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `models`
--

INSERT INTO `models` (`id`, `brand_id`, `name`, `slug`, `description`, `photo_path`) VALUES
(1, 1, 'iX2', 'rusifikaciya-bmw-ix2', 'Русификация BMW iX2\r\nРусификация Центрального Монитора\r\nРусификация Приборной Панели \"Щиток Приборов\"\r\nПеревод Температуры с Фаренгейтов в Градусы Цельсия\r\n100 % Не слетает при снятии клемм с аккумулятора', '/src/img/bmw_ix2.webp'),
(2, 2, 'HAIGHLANDER 2025', 'rusifikaciya-toyota-haighlander', 'Выполнили полную русификацию мультимедийной системы Toyota Highlander. Интерфейс автомобиля переведён на русский язык без потери функциональности и заводской логики управления.\r\n\r\nЧто сделано:\r\n1. Русификация меню мультимедийной системы\r\n2. Перевод настроек автомобиля и бортового компьютера\r\n3. Корректное отображение русского языка во всех разделах\r\n4. Сохранение штатных функций и стабильной работы системы\r\n5. Поддержка обновлений и совместимость с оригинальным ПО\r\n\r\nРезультат:\r\nУправление автомобилем стало интуитивно понятным и комфортным. Все функции доступны на русском языке, без ошибок, «костылей» и сторонних оболочек. Интерьер и электроника выглядят и работают так, как будто русский язык был предусмотрен заводом.', '/src/img/toyota_haighlander.webp'),
(3, 2, 'RAV4 2023-2025', 'rusifikaciya-toyota-rav4', 'Выполнена полная русификация мультимедийной системы Toyota RAV4 последних годов выпуска (2023–2025). Интерфейс автомобиля переведён на русский язык с сохранением заводской логики и стабильной работы всех систем.\r\n\r\nЧто выполнено:\r\n1. Русификация мультимедийной системы и главного меню\r\n2. Перевод настроек автомобиля и бортового компьютера\r\n3. Корректное отображение русского языка во всех разделах\r\n4. Полная совместимость со штатным программным обеспечением\r\n5. Отсутствие ошибок, подвисаний и сторонних оболочек\r\n\r\nРезультат:\r\nКомфортное и понятное управление автомобилем без языкового барьера. Все функции доступны на русском языке, интерфейс выглядит нативно и работает так, будто русификация предусмотрена производителем.', '/src/img/toyota-rav4.avif'),
(4, 2, 'C-HR', 'rusifikaciya-toyota-c-hr', 'Выполнена полная русификация мультимедийной системы Toyota C-HR. Интерфейс автомобиля переведён на русский язык с сохранением заводского дизайна, логики управления и стабильной работы всех функций.\r\n\r\nЧто сделано:\r\n1. Русификация меню мультимедийной системы\r\n2. Перевод настроек автомобиля и бортового компьютера\r\n3. Корректное отображение русского языка во всех разделах\r\n4. Полная совместимость с оригинальным программным обеспечением Toyota\r\n5. Работа без ошибок, задержек и сторонних оболочек\r\n\r\nРезультат:\r\nУправление автомобилем стало максимально понятным и комфортным. Все функции доступны на русском языке, интерфейс выглядит нативно и не отличается от заводского решения.', '/src/img/toyota-c-hr.png'),
(5, 2, 'CAMRY 80', 'rusifikaciya-toyota-camry-80', 'Выполнена полная русификация мультимедийной системы Toyota Camry 80. Интерфейс автомобиля переведён на русский язык с сохранением заводской логики, дизайна и стабильной работы всех систем.\r\n\r\nЧто выполнено:\r\n1. Русификация мультимедийной системы и главного меню\r\n2. Перевод настроек автомобиля и бортового компьютера\r\n3. Корректное отображение русского языка во всех разделах\r\n4. Полная совместимость со штатным программным обеспечением\r\n5. Без сбоев, зависаний и сторонних оболочек\r\n\r\nРезультат:\r\nУправление автомобилем стало удобным и интуитивно понятным. Все функции доступны на русском языке, интерфейс выглядит нативно — будто так и задумано производителем.', '/src/img/toyota-camry-80.png');

-- --------------------------------------------------------

--
-- Структура таблицы `model_photos`
--

CREATE TABLE `model_photos` (
  `id` int(10) UNSIGNED NOT NULL,
  `model_id` int(10) UNSIGNED NOT NULL,
  `photo_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `model_videos`
--

CREATE TABLE `model_videos` (
  `id` int(10) UNSIGNED NOT NULL,
  `model_id` int(10) UNSIGNED NOT NULL,
  `video_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_models_brand` (`brand_id`);

--
-- Индексы таблицы `model_photos`
--
ALTER TABLE `model_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_model_photos_model` (`model_id`);

--
-- Индексы таблицы `model_videos`
--
ALTER TABLE `model_videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_model_videos_model` (`model_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `models`
--
ALTER TABLE `models`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `model_photos`
--
ALTER TABLE `model_photos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `model_videos`
--
ALTER TABLE `model_videos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `models`
--
ALTER TABLE `models`
  ADD CONSTRAINT `fk_models_brand` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `model_photos`
--
ALTER TABLE `model_photos`
  ADD CONSTRAINT `fk_model_photos_model` FOREIGN KEY (`model_id`) REFERENCES `models` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `model_videos`
--
ALTER TABLE `model_videos`
  ADD CONSTRAINT `fk_model_videos_model` FOREIGN KEY (`model_id`) REFERENCES `models` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
