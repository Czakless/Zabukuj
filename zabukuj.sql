-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sty 06, 2026 at 08:10 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zabukuj`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `company_name` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `email`, `password`) VALUES
(1, 'Firma Testowa', 'firma@zabukuj.pl', 'haslo123'),
(2, 'sss', 'mateuszlutek1@gmail.com', 'a');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `hotels`
--

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `city` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `company_id`, `name`, `city`, `price`, `description`) VALUES
(12, 2, 'Królestwo Lutomiersk', 'Lutomiersk', 99999999.99, 'Królestwo Łotomiersk – wyjątkowa przestrzeń do wynajęcia  Oferujemy do wynajęcia unikalną i malowniczą przestrzeń w sercu Królestwa Łotomiersk, idealną dla osób poszukujących miejsca pełnego historii, charakteru i niezapomnianej atmosfery. Nasza nieruchomość łączy tradycyjne elementy architektury z nowoczesnym komfortem, tworząc przestrzeń zarówno do prywatnego wypoczynku, jak i organizacji wydarzeń, spotkań czy sesji zdjęciowych.  Najważniejsze cechy:  Malownicze położenie w otoczeniu przyrody i zabytkowych krajobrazów.  Przestronne wnętrza z klimatycznym wykończeniem.  Możliwość organizacji eventów, warsztatów, sesji fotograficznych i filmowych.  Dogodny dojazd i dostępność dla gości.  Prywatność i spokój gwarantujące komfortowy pobyt.  Królestwo Łotomiersk to miejsce, które zachwyca niepowtarzalnym klimatem i pozwala poczuć magię dawnych czasów w nowoczesnym wydaniu. Idealne dla osób ceniących wyjątkowe doświadczenia i estetykę.  Zapraszamy do kontaktu w celu uzyskania szczegółów dotyczących wynajmu i dostępności.'),
(13, 1, 'Hotel Premium', 'Warszawa', 350.00, 'Luksusowy hotel blisko centrum.'),
(14, 1, 'Apartament Deluxe', 'Kraków', 280.00, 'Nowoczesne wnętrze z balkonem.'),
(15, 1, 'Domki nad jeziorem', 'Mazury', 420.00, 'Idealne na rodzinny wypoczynek.'),
(16, 1, 'Pensjonat Górski', 'Zakopane', 300.00, 'Widok na góry i cisza.'),
(17, 1, 'Hotel Nad Morzem', 'Gdańsk', 390.00, 'Blisko plaży i promenady.'),
(18, 2, 'Kurs: Zrób pieniądze z muzyki AI', 'Łódź', 12.00, 'dsdasdasdsadasdasdasda');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(4, 'Mateusz', 'mateuszlutek1@gmail.com', 'a');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeksy dla tabeli `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indeksy dla tabeli `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_id` (`hotel_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hotels`
--
ALTER TABLE `hotels`
  ADD CONSTRAINT `hotels_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
