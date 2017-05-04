-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 15 2017 г., 18:54
-- Версия сервера: 5.7.16
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yomi`
--

-- --------------------------------------------------------

--
-- Структура таблицы `abit_infotbl`
--

CREATE TABLE `abit_infotbl` (
  `id` int(11) NOT NULL,
  `login` varchar(15) NOT NULL,
  `role` varchar(20) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `sec_name` varchar(50) NOT NULL,
  `lang` varchar(25) NOT NULL,
  `st_lang` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `abit_infotbl`
--

INSERT INTO `abit_infotbl` (`id`, `login`, `role`, `full_name`, `name`, `sec_name`, `lang`, `st_lang`) VALUES
(1, 'ty', 'Абитуриент', 'Васин', 'Василий', 'Васильевич', 'Русский', 'Не владею'),
(2, 'abit1', 'Абитуриент', 'Петров', 'Петр', 'Петрович ', 'Русский', 'Не владею');

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'Абитуриент'),
(3, 'Администратор'),
(2, 'Преподаватель');

-- --------------------------------------------------------

--
-- Структура таблицы `teach_infotbl`
--

CREATE TABLE `teach_infotbl` (
  `id` int(11) NOT NULL,
  `login` varchar(15) NOT NULL,
  `role` varchar(20) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `sec_name` varchar(50) NOT NULL,
  `uch_st` varchar(50) NOT NULL,
  `dol` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `teach_infotbl`
--

INSERT INTO `teach_infotbl` (`id`, `login`, `role`, `full_name`, `name`, `sec_name`, `uch_st`, `dol`) VALUES
(1, 'uu', 'Преподаватель', 'Петров', 'Иван', 'Семенович', 'Старший преподаватель', 'Профессор'),
(2, 'yy', 'Преподаватель', '123', '321', '123', '123', '123');

-- --------------------------------------------------------

--
-- Структура таблицы `userrole`
--

CREATE TABLE `userrole` (
  `id_ur` int(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `userrole`
--

INSERT INTO `userrole` (`id_ur`, `user`, `role`) VALUES
(1, 'yomi', 'Администратор'),
(6, 'ty', 'Абитуриент'),
(8, 'yy', 'Преподаватель'),
(9, 'uu', 'Преподаватель'),
(10, '4545', 'Абитуриент'),
(11, 'abit1', 'Абитуриент'),
(12, 'qwe', 'Абитуриент'),
(13, '123', 'Абитуриент');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `user_email` varchar(40) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `joining_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dop` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_pass`, `joining_date`, `dop`) VALUES
(1, 'yomi', 'funyloony@gmail.com', '$2y$10$C/IDG.AnjjFk7rjKvtjOzua8gQczbLXtrclkvZwAyibx32iloCu/m', '2017-03-11 18:37:43', 1),
(11, 'ty', 'Gt@gjk.gk', '$2y$10$ddct3lt6Sx6ouLn9X9rzIuUjcFm7chaKNkHFX2r4Bsu4oFeWesZE2', '2017-03-14 19:24:05', 1),
(13, 'yy', 'yy@yy.ycgdffffffff', '$2y$10$B3e/dyNOUZ07qhSi1evOT.LJz5KXWK/GcT4ckKM8FnWKT3VVAa99W', '2017-03-22 21:05:51', 1),
(14, 'uu', 'jkdg@kk.gj', '$2y$10$inrTl05TuL1gsMeBsuGA.ON6KpYXfeJtCsx0kofS.gHCHUweZf8nO', '2017-03-23 09:38:18', 1),
(16, 'abit1', 'abit1@abit1.abit1', '$2y$10$0G4yeDLHfsqx1V7ShNb85utOsTPVX40tcMrWj0.45chzj9LefnSG.', '2017-04-15 10:43:15', 1),
(17, 'qwe', 'qwe@qe.qw', '$2y$10$l4l5ELJJw4JXClRBtQWNcuUlEz5FNy/BsK157ok78rRGWfeSQ/b6q', '2017-04-15 15:26:36', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `yomi_abittoteach`
--

CREATE TABLE `yomi_abittoteach` (
  `id_par` int(11) NOT NULL,
  `id_prep` int(11) NOT NULL,
  `id_abit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `yomi_abittoteach`
--

INSERT INTO `yomi_abittoteach` (`id_par`, `id_prep`, `id_abit`) VALUES
(1, 1, 1),
(3, 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `yomi_testanswer`
--

CREATE TABLE `yomi_testanswer` (
  `id_answer` int(11) NOT NULL,
  `name_answer` varchar(255) NOT NULL,
  `id_quest` int(11) NOT NULL,
  `procent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `yomi_testanswer`
--

INSERT INTO `yomi_testanswer` (`id_answer`, `name_answer`, `id_quest`, `procent`) VALUES
(37, 'Вопрос', 10, 100),
(38, 'Предположение', 10, 0),
(39, 'Утверждение', 10, 0),
(40, 'Разочарование', 10, 0),
(41, 'Убедительно', 11, 0),
(42, 'НЕ может быть такого', 11, 0),
(43, 'Возможная ситуация в жизни', 11, 0),
(44, 'Ответ', 11, 100),
(45, '123', 12, 100),
(46, '123', 12, 0),
(47, '123', 12, 0),
(48, '432', 12, 0),
(49, '11', 13, 0),
(50, '11', 13, 0),
(51, '11', 13, 100),
(52, '11', 13, 0),
(57, 'согласен', 15, 0),
(58, 'несогласен', 15, 100),
(59, 'да', 15, 0),
(60, 'нет', 15, 0),
(61, 'sdg', 16, 0),
(62, 'e', 16, 0),
(63, 'df', 16, 0),
(64, 'ehf', 16, 100);

-- --------------------------------------------------------

--
-- Структура таблицы `yomi_testmark`
--

CREATE TABLE `yomi_testmark` (
  `id_mark` int(11) NOT NULL,
  `id_test` int(11) NOT NULL,
  `id_quest` int(11) NOT NULL,
  `id_answer` int(11) NOT NULL,
  `procent` int(11) DEFAULT NULL,
  `id_abit` int(11) NOT NULL,
  `curr_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `yomi_testmark`
--

INSERT INTO `yomi_testmark` (`id_mark`, `id_test`, `id_quest`, `id_answer`, `procent`, `id_abit`, `curr_date`) VALUES
(1, 7, 10, 37, 100, 1, '2017-04-15 18:12:18'),
(2, 7, 11, 44, 100, 1, '2017-04-15 18:12:18'),
(3, 7, 15, 0, 0, 1, '2017-04-15 18:12:18'),
(4, 7, 16, 0, 0, 1, '2017-04-15 18:12:18'),
(5, 7, 10, 37, 100, 1, '2017-04-15 18:12:34'),
(6, 7, 11, 44, 100, 1, '2017-04-15 18:12:34'),
(7, 7, 15, 0, 0, 1, '2017-04-15 18:12:34'),
(8, 7, 16, 0, 0, 1, '2017-04-15 18:12:34');

-- --------------------------------------------------------

--
-- Структура таблицы `yomi_testname`
--

CREATE TABLE `yomi_testname` (
  `id_test` int(11) NOT NULL,
  `name_test` varchar(255) NOT NULL,
  `id_prep` int(11) NOT NULL,
  `count_quest` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `yomi_testname`
--

INSERT INTO `yomi_testname` (`id_test`, `name_test`, `id_prep`, `count_quest`) VALUES
(7, 'Пробное тестирование', 1, 4),
(8, 'йцу', 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `yomi_testquest`
--

CREATE TABLE `yomi_testquest` (
  `id_quest` int(11) NOT NULL,
  `name_quest` text NOT NULL,
  `id_test` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `yomi_testquest`
--

INSERT INTO `yomi_testquest` (`id_quest`, `name_quest`, `id_test`) VALUES
(10, ' Форма мысли, выраженная в основном языке предложением, которое произносят или пишут, когда хотят что-нибудь спросить, то есть получить интересующую информацию', 7),
(11, ' Реплика, вызванная заданным вопросом или реакция на какое-либо событие. Вопросом может быть часть диалога или задания (например, экзаменационного)', 7),
(12, '123', 8),
(13, '11', 8),
(15, 'Особая форма предложения, которая в утвердительной форме выдвигает гипотезу относительно некоторого явления.', 7),
(16, 'et', 7);

-- --------------------------------------------------------

--
-- Структура таблицы `yomi_testresult`
--

CREATE TABLE `yomi_testresult` (
  `id_solve` int(11) NOT NULL,
  `id_test` int(11) NOT NULL,
  `id_abit` int(11) NOT NULL,
  `mark` double NOT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `yomi_testresult`
--

INSERT INTO `yomi_testresult` (`id_solve`, `id_test`, `id_abit`, `mark`, `status`) VALUES
(3, 7, 1, 50, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `abit_infotbl`
--
ALTER TABLE `abit_infotbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`),
  ADD KEY `login` (`login`),
  ADD KEY `st_lang` (`st_lang`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`);

--
-- Индексы таблицы `teach_infotbl`
--
ALTER TABLE `teach_infotbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`),
  ADD KEY `login` (`login`);

--
-- Индексы таблицы `userrole`
--
ALTER TABLE `userrole`
  ADD PRIMARY KEY (`id_ur`),
  ADD UNIQUE KEY `user` (`user`),
  ADD KEY `role` (`role`) USING BTREE;

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name_2` (`user_name`);

--
-- Индексы таблицы `yomi_abittoteach`
--
ALTER TABLE `yomi_abittoteach`
  ADD PRIMARY KEY (`id_par`);

--
-- Индексы таблицы `yomi_testanswer`
--
ALTER TABLE `yomi_testanswer`
  ADD PRIMARY KEY (`id_answer`),
  ADD KEY `id_quest` (`id_quest`);

--
-- Индексы таблицы `yomi_testmark`
--
ALTER TABLE `yomi_testmark`
  ADD PRIMARY KEY (`id_mark`);

--
-- Индексы таблицы `yomi_testname`
--
ALTER TABLE `yomi_testname`
  ADD PRIMARY KEY (`id_test`),
  ADD KEY `prep` (`id_prep`);

--
-- Индексы таблицы `yomi_testquest`
--
ALTER TABLE `yomi_testquest`
  ADD PRIMARY KEY (`id_quest`),
  ADD KEY `test` (`id_test`);

--
-- Индексы таблицы `yomi_testresult`
--
ALTER TABLE `yomi_testresult`
  ADD PRIMARY KEY (`id_solve`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `abit_infotbl`
--
ALTER TABLE `abit_infotbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `teach_infotbl`
--
ALTER TABLE `teach_infotbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `userrole`
--
ALTER TABLE `userrole`
  MODIFY `id_ur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT для таблицы `yomi_abittoteach`
--
ALTER TABLE `yomi_abittoteach`
  MODIFY `id_par` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `yomi_testanswer`
--
ALTER TABLE `yomi_testanswer`
  MODIFY `id_answer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT для таблицы `yomi_testmark`
--
ALTER TABLE `yomi_testmark`
  MODIFY `id_mark` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `yomi_testname`
--
ALTER TABLE `yomi_testname`
  MODIFY `id_test` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `yomi_testquest`
--
ALTER TABLE `yomi_testquest`
  MODIFY `id_quest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT для таблицы `yomi_testresult`
--
ALTER TABLE `yomi_testresult`
  MODIFY `id_solve` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `teach_infotbl`
--
ALTER TABLE `teach_infotbl`
  ADD CONSTRAINT `teach_infotbl_ibfk_1` FOREIGN KEY (`login`) REFERENCES `userrole` (`user`),
  ADD CONSTRAINT `teach_infotbl_ibfk_2` FOREIGN KEY (`role`) REFERENCES `userrole` (`role`);

--
-- Ограничения внешнего ключа таблицы `yomi_testanswer`
--
ALTER TABLE `yomi_testanswer`
  ADD CONSTRAINT `yomi_testanswer_ibfk_1` FOREIGN KEY (`id_quest`) REFERENCES `yomi_testquest` (`id_quest`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `yomi_testquest`
--
ALTER TABLE `yomi_testquest`
  ADD CONSTRAINT `yomi_testquest_ibfk_1` FOREIGN KEY (`id_test`) REFERENCES `yomi_testname` (`id_test`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
