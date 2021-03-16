-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 20 2020 г., 22:45
-- Версия сервера: 10.4.11-MariaDB
-- Версия PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `course_work`
--

-- --------------------------------------------------------

--
-- Структура таблицы `accomodation`
--

CREATE TABLE `accomodation` (
  `accomodation_id` int(11) NOT NULL,
  `accomodation_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `accomodation`
--

INSERT INTO `accomodation` (`accomodation_id`, `accomodation_type`) VALUES
(1, '2*'),
(2, '3*'),
(3, '4*'),
(4, '5*');

-- --------------------------------------------------------

--
-- Структура таблицы `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `country`
--

INSERT INTO `country` (`country_id`, `country_name`) VALUES
(1, 'Греция'),
(2, 'Египет'),
(3, 'Мальдивы'),
(4, 'Турция'),
(5, 'Таиланд'),
(6, 'Украина'),
(7, 'Кипр'),
(8, 'Тунис');

-- --------------------------------------------------------

--
-- Структура таблицы `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `pass` varchar(40) CHARACTER SET utf8 NOT NULL,
  `photo` text CHARACTER SET utf32 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `customer`
--

INSERT INTO `customer` (`customer_id`, `name`, `surname`, `email`, `address`, `phone`, `pass`, `photo`) VALUES
(19, 'Иван', 'Личковаха', 'ivanlichkovaxa@gmail.com', 'Пушкинская', '+380995005307', 'a8cdef1e32341adf2debb134438a64b1', 'img/_DSC0171.JPG');

-- --------------------------------------------------------

--
-- Структура таблицы `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `patronymic` varchar(20) NOT NULL,
  `birth_date` date NOT NULL DEFAULT current_timestamp(),
  `possition` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `employee`
--

INSERT INTO `employee` (`employee_id`, `name`, `surname`, `patronymic`, `birth_date`, `possition`, `email`, `phone`, `pass`) VALUES
(1, 'Дмитрий', 'Иванов', 'Павлович', '1992-05-03', 'Менеджер', 'Dmitrii@gmail.com', '325265374683', 'Dim2314'),
(2, 'Артур', 'Николаев', 'Владимирович', '1986-04-21', 'Менеджер', 'Artur@gmail.com', '34635723546', ''),
(3, 'Оксана', 'Демидовна', 'Юрьевна', '1996-03-23', 'Менеджер', 'Oksana@gmail.com', '5762426273', 'Oksana432'),
(4, 'Юрий', 'Петренко', 'Александрович', '1976-07-12', 'Менеджер', 'Ura@gmail.com', '2264361411', ''),
(5, 'Арсений', 'Капуста', 'Въячеславович', '1976-07-12', 'Администратор', 'Cen9@gmail.com', '34228322685', 'admin228322');

-- --------------------------------------------------------

--
-- Структура таблицы `food`
--

CREATE TABLE `food` (
  `food_id` int(11) NOT NULL,
  `food_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `food`
--

INSERT INTO `food` (`food_id`, `food_type`) VALUES
(1, 'ОВ(без питания)'),
(2, 'ВВ(завтрак)'),
(3, 'НВ(заврак + ужин)'),
(4, 'FB(3-раз. питание)'),
(5, 'AL(все включено)');

-- --------------------------------------------------------

--
-- Структура таблицы `internationalpassport`
--

CREATE TABLE `internationalpassport` (
  `customer_id` int(11) NOT NULL,
  `series` varchar(2) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `internationalpassport`
--

INSERT INTO `internationalpassport` (`customer_id`, `series`, `number`) VALUES
(19, 'FV', 123456);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `clearance_date` date NOT NULL DEFAULT current_timestamp(),
  `status` enum('Новый заказ','Согласован','Скомплектован','Выполнен') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`order_id`, `tour_id`, `customer_id`, `clearance_date`, `status`) VALUES
(28, 4, 19, '2020-05-07', 'Новый заказ'),
(29, 12, 19, '2020-05-07', 'Новый заказ'),
(32, 2, 19, '2020-05-09', 'Новый заказ'),
(34, 5, 19, '2020-05-20', 'Новый заказ');

-- --------------------------------------------------------

--
-- Структура таблицы `resort`
--

CREATE TABLE `resort` (
  `resort_id` int(11) NOT NULL,
  `resort_name` varchar(20) NOT NULL,
  `country_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `resort`
--

INSERT INTO `resort` (`resort_id`, `resort_name`, `country_id`) VALUES
(1, 'Крит', 1),
(2, 'Шарм-эль-Шейх', 2),
(3, 'Мальдивы', 3),
(4, 'Анталия', 4),
(5, 'Бангкок', 5),
(6, 'Бердянск', 6),
(7, 'Одесса', 6),
(8, 'Корфу', 1),
(9, 'Пафос', 7),
(10, 'Белек', 4),
(11, 'Гаммарт', 8);

-- --------------------------------------------------------

--
-- Структура таблицы `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `phone`, `address`) VALUES
(1, 'Coral Travel', '11111111', 'ул.Пушкинская,68'),
(2, 'Join up', '2222222', 'ул.Сумская,79'),
(3, 'Kompas', '33333333', 'ст.м.Героев Труда'),
(4, 'Кангадар', '44444444', 'ул.Б.Хмельницкого'),
(5, 'Любосвит', '55555555', 'ст.м.Академика Павлова'),
(6, 'Туристический клуб', '666666666', 'Радмир');

-- --------------------------------------------------------

--
-- Структура таблицы `tour`
--

CREATE TABLE `tour` (
  `tour_id` int(11) NOT NULL,
  `excursions` enum('YES','NO') DEFAULT NULL,
  `departure_date` date NOT NULL DEFAULT current_timestamp(),
  `arrival_date` date NOT NULL DEFAULT current_timestamp(),
  `tour_cost` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `photo` text NOT NULL,
  `note` text NOT NULL,
  `accomodation_id` int(11) DEFAULT NULL,
  `food_id` int(11) DEFAULT NULL,
  `transport_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `resort_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `tour`
--

INSERT INTO `tour` (`tour_id`, `excursions`, `departure_date`, `arrival_date`, `tour_cost`, `supplier_id`, `photo`, `note`, `accomodation_id`, `food_id`, `transport_id`, `employee_id`, `resort_id`) VALUES
(1, 'YES', '2020-05-24', '2020-05-16', 1000, 1, 'img/1.jpg', 'Остров Крит, омываемый Ливийским, Критским и Ионическими морями Средиземноморского бассейна, расположился на месте встречи трёх частей света — Европы, Африки и Азии. Прекрасный климат, ласковое море, живописный ландшафт, незабываемая кухня, обилие уникальных античных достопримечательностей — всё на Крите располагает к релаксу и полной отрешённости от забот.', 3, 2, 1, 2, 1),
(2, 'YES', '2020-06-12', '2020-06-02', 800, 1, 'img/2.jpg', 'Шарм-эль-Шейх – это курортный город в Египте, расположенный между пустыней Синайского полуострова и Красным морем. Шарм-эль-Шейх славится своими тихими песчаными пляжами, чистой водой и коралловыми рифами. Среди туристов популярен залив Наама, вдоль которого тянется окаймленная пальмами набережная с множеством баров и ресторанов.', 3, 2, 1, 1, 2),
(3, 'YES', '2020-05-12', '2020-05-04', 1200, 2, 'img/3.jpg', 'Мальдивские острова становятся год от года все более популярным местом для отдыха. Ослепительно чистая, прозрачная океанская вода, чистейшая природа Мальдивских островов никого не оставляют равнодушным. Отдых на Мальдивских островах можно сравнить с погружением в совершенно иной мир, мир девственно чистой природы и океанской жизни.', 4, 1, 1, 4, 3),
(4, 'YES', '2020-07-20', '2020-07-14', 500, 2, 'img/4.jpg', 'Анталья – самый быстрорастущий город Турции. Туристы, приезжающие сюда со всего мира, наслаждаются поразительным сочетанием великолепных пляжей и традиционной турецкой культуры. Дети будут в восторге от развлекательного комплекса Бич-Парк, включающего аквапарк (мечта любителей водных горок) и дельфинарий – место обитания дельфинов, морских львов и белух. ', 2, 3, 1, 3, 4),
(5, 'YES', '2020-05-25', '2020-05-03', 1000, 3, 'img/5.jpg', 'Бангкок – столица Таиланда, огромный город, известный своими богато украшенными храмами и насыщенной ночной жизнью. Через город протекает судоходная река Чаупхрая, которая питает своими водами многочисленные каналы. На берегу одного из каналов лежит королевский район Раттанакосин, где расположены роскошный Большой дворец, священный храм Пхракэу и ват Пхо с гигантской статуей Отдыхающего Будды.', 3, 5, 1, 4, 5),
(6, 'NO', '2020-07-15', '2020-07-05', 300, 3, 'img/6.jpg', 'Бердя́нск — город в Запорожской области Украины. Является административным центром Бердянского района, в состав которого входит Бердянский городской совет, а также сёла Нововасилевка, Роза и посёлок Шёлковое. Морской, климатический и грязевой курорт государственного значения.', 2, 4, 2, 1, 6),
(7, 'YES', '2020-06-24', '2020-06-04', 450, 4, 'img/7.jpg', 'Одесса – это портовый город на Черном море в южной части Украины. Он известен своими пляжами и архитектурой XIX века, например зданием Одесского театра оперы и балета. Потемкинская лестница, получившая всемирную известность благодаря фильму \"Броненосец Потемкин\", ведет к морю, где расположен Воронцовский маяк. Вдоль побережья тянется Приморский бульвар. Здесь можно прогуляться и полюбоваться прибрежными особняками и памятниками.', 2, 2, 2, 1, 7),
(8, 'YES', '2020-05-14', '2020-05-07', 900, 4, 'img/8.jpg', 'Корфу - самый северный и второй по площади живописный греческий остров в Ионическом море. Он расположен в виде серпа, обращенного вогнутой стороной к побережью Албании и Греции. Плодородие и жизнерадостное радушие этих мест поражает. Апельсиновые сады греческого острова привлекают своим ароматом ранней весной, плодородные оливковые рощи обещают дивную летную прохладу, а знаменитое греческое вино порадует своим вкусом самого изысканного ценителя. ', 3, 2, 1, 2, 8),
(9, 'NO', '2021-05-12', '2021-05-06', 1300, 5, 'img/9.jpg', 'У Пафоса, столицы западного Кипра, богатое историческое прошлое. Это не только место, где возвышаются на утесе над искрящимся морем Царские гробницы IV в. до н.э. и располагается живописный византийский замок, украшенный мозаикой, но и родина богини Афродиты. Население города в 27 тысяч человек резко увеличивается летом, когда сюда приезжает множество пляжных туристов из Англии, Германии и Скандинавии. Прекрасная старая гавань ожидает гостей, вдоль променада тянутся современные отели и рестораны.', 4, 2, 1, 3, 9),
(10, 'YES', '2020-05-24', '2020-05-16', 1100, 5, 'img/10.jpg', 'Белек - это самое респектабельное и дорогое место отдыха в Турции. Роскошные отели и чистейшие пляжи сочетаются с красотой эвкалиптовых, кедровых и сосновых лесов. Из 450 видов птиц, обитающих в Турции сегодня, 109 находятся в этом регионе. Очень много редких и экзотических, например, Tyto Alba (Сова с капюшоном). Именно она стала символом курорта.', 3, 5, 1, 3, 10),
(11, 'NO', '2020-06-24', '2020-06-16', 350, 6, 'img/11.jpg', 'Одесса с ее более чем миллионным населением – четвертый по величине город Украины. В конце XVIII в. этот город появился на юге страны, у Черного моря, в качестве русской морской крепости. В середине XIX в. он несколько лет был вольным портом с многонациональным населением. В 1905 г. команда броненосца \"Потемкин\" начала здесь крупное восстание. В приятном старом городе расположено красивое здание оперы; кроме того, в Одессе много отличных пляжей.', 2, 4, 2, 1, 7),
(12, 'NO', '2020-04-29', '2020-05-23', 500, 6, 'img/12.jpg', 'Престижный северный пригород тунисской столицы Гаммарт располагается в 18 км от центра города. Большинство здешних объектов размещения — роскошные частные резиденции и достаточно новые отели высокого уровня. Великолепные центры талассотерапии, живописное побережье, где песчаные пляжи перемежаются со скальными участками, о которые разбивается пенный прибой, и близость к достопримечательностям Сиди-бу-Саида и Карфагена — вот плюсы этого курорта.', 1, 2, 1, 2, 11);

-- --------------------------------------------------------

--
-- Структура таблицы `transport`
--

CREATE TABLE `transport` (
  `transport_id` int(11) NOT NULL,
  `transport_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `transport`
--

INSERT INTO `transport` (`transport_id`, `transport_type`) VALUES
(1, 'Авиа'),
(2, 'Ж/д');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `accomodation`
--
ALTER TABLE `accomodation`
  ADD PRIMARY KEY (`accomodation_id`);

--
-- Индексы таблицы `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Индексы таблицы `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Индексы таблицы `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Индексы таблицы `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`);

--
-- Индексы таблицы `internationalpassport`
--
ALTER TABLE `internationalpassport`
  ADD PRIMARY KEY (`customer_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `tour_id` (`tour_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Индексы таблицы `resort`
--
ALTER TABLE `resort`
  ADD PRIMARY KEY (`resort_id`),
  ADD KEY `country_id_fk` (`country_id`);

--
-- Индексы таблицы `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Индексы таблицы `tour`
--
ALTER TABLE `tour`
  ADD PRIMARY KEY (`tour_id`),
  ADD KEY `supplier_id_fk` (`supplier_id`),
  ADD KEY `accomodation_id_fk` (`accomodation_id`),
  ADD KEY `food_id_fk` (`food_id`),
  ADD KEY `transport_id_fk` (`transport_id`),
  ADD KEY `employee_id_fk` (`employee_id`),
  ADD KEY `resort_id_fk` (`resort_id`);

--
-- Индексы таблицы `transport`
--
ALTER TABLE `transport`
  ADD PRIMARY KEY (`transport_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `accomodation`
--
ALTER TABLE `accomodation`
  MODIFY `accomodation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT для таблицы `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT для таблицы `resort`
--
ALTER TABLE `resort`
  MODIFY `resort_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `tour`
--
ALTER TABLE `tour`
  MODIFY `tour_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT для таблицы `transport`
--
ALTER TABLE `transport`
  MODIFY `transport_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `internationalpassport`
--
ALTER TABLE `internationalpassport`
  ADD CONSTRAINT `internationalpassport_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tour` (`tour_id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Ограничения внешнего ключа таблицы `resort`
--
ALTER TABLE `resort`
  ADD CONSTRAINT `country_id_fk` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`);

--
-- Ограничения внешнего ключа таблицы `tour`
--
ALTER TABLE `tour`
  ADD CONSTRAINT `accomodation_id_fk` FOREIGN KEY (`accomodation_id`) REFERENCES `accomodation` (`accomodation_id`),
  ADD CONSTRAINT `employee_id_fk` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`),
  ADD CONSTRAINT `food_id_fk` FOREIGN KEY (`food_id`) REFERENCES `food` (`food_id`),
  ADD CONSTRAINT `resort_id_fk` FOREIGN KEY (`resort_id`) REFERENCES `resort` (`resort_id`),
  ADD CONSTRAINT `supplier_id_fk` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`),
  ADD CONSTRAINT `transport_id_fk` FOREIGN KEY (`transport_id`) REFERENCES `transport` (`transport_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
