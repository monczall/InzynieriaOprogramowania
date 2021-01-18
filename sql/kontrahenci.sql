-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 17 Sty 2021, 21:44
-- Wersja serwera: 10.4.16-MariaDB
-- Wersja PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `kontrahenci`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `adres_oddzialu`
--

CREATE TABLE `adres_oddzialu` (
  `id_oddzialu` int(11) NOT NULL,
  `ulica` varchar(60) NOT NULL,
  `numer_budynku` varchar(10) NOT NULL,
  `miasto` varchar(60) NOT NULL,
  `kod_pocztowy` varchar(10) NOT NULL,
  `kraj` varchar(60) NOT NULL,
  `nazwa_oddzialu` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `numer_telefonu` varchar(15) NOT NULL,
  `oddzial_glowny` tinyint(1) NOT NULL,
  `id_kontrahenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `adres_oddzialu`
--

INSERT INTO `adres_oddzialu` (`id_oddzialu`, `ulica`, `numer_budynku`, `miasto`, `kod_pocztowy`, `kraj`, `nazwa_oddzialu`, `email`, `numer_telefonu`, `oddzial_glowny`, `id_kontrahenta`) VALUES
(12, 'Mickiewicza', '11', 'Rzeszów', '21-370', 'Polska', 'Oddzial', 'email1@gmail.com', '123456780', 1, 32),
(13, 'Krakowska', '12', 'Rzeszów', '37-210', 'Polska', 'Oddzial', 'email2@gmail.com', '123456781', 1, 33),
(14, 'Rzeszowska', '13', 'Rzeszów', '37-123', 'Polska', 'Rzeszowska', 'email3@gmail.com', '123456782', 1, 34),
(15, 'Warszawska', '14', 'Warszawa', '32-143', 'Polska', 'Warszawska', 'email4@gmail.com', '123456783', 1, 35),
(16, 'Nowa', '15', 'Rzeszów', '21-370', 'Polska', 'Nowa', 'email5@gmail.com', '123456784', 1, 36),
(17, 'Stara', '16', 'Rzeszów', '21-370', 'Polska', 'Stara', 'email6@gmail.com', '123456785', 1, 37),
(18, 'Starsza', '17', 'Warszawa', '21-370', 'Polska', 'Starsza', 'email7@gmail.com', '123456786', 1, 38);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kontrahent`
--

CREATE TABLE `kontrahent` (
  `id_kontrahenta` int(11) NOT NULL,
  `imie` varchar(40) NOT NULL,
  `nazwisko` varchar(60) NOT NULL,
  `nazwa_firmy` varchar(80) NOT NULL,
  `data_rejestracji` date NOT NULL,
  `nip` varchar(20) NOT NULL,
  `ukryj_kontrahenta` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `kontrahent`
--

INSERT INTO `kontrahent` (`id_kontrahenta`, `imie`, `nazwisko`, `nazwa_firmy`, `data_rejestracji`, `nip`, `ukryj_kontrahenta`) VALUES
(32, 'Adam', 'Adamiak', 'Adamiak', '2021-01-08', '5249366383', 0),
(33, 'Ania', 'Kowalska', 'Kowalska', '2021-01-15', '3892726480', 0),
(34, 'Janusz', 'Tracz', 'Tracz Firma', '2021-01-17', '7622654927', 0),
(35, 'Dariusz', 'Mariusz', 'Mariusz', '2021-01-05', '967102078', 0),
(36, 'Stefan', 'Nowak', 'Firma', '2021-01-03', '977937799', 0),
(37, 'Jan', 'Kokos', 'Kokoski', '2021-01-02', '1010002231', 0),
(38, 'Andrzej', 'Bok', 'Skok', '2021-01-11', '1040001590', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `osoba_kontaktowa`
--

CREATE TABLE `osoba_kontaktowa` (
  `id_osoby_kontaktowej` int(11) NOT NULL,
  `imie_osoba` varchar(40) NOT NULL,
  `nazwisko_osoba` varchar(60) NOT NULL,
  `numer_telefonu_osoba` varchar(15) NOT NULL,
  `email_osoba` varchar(60) NOT NULL,
  `id_oddzialu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `osoba_kontaktowa`
--

INSERT INTO `osoba_kontaktowa` (`id_osoby_kontaktowej`, `imie_osoba`, `nazwisko_osoba`, `numer_telefonu_osoba`, `email_osoba`, `id_oddzialu`) VALUES
(8, 'Adam', 'Mickiewicz', '321654981', 'adam.mickiewicz@gmail.com', 12),
(9, 'Darek', 'Krakowicz', '321654982', 'darek.krakowicz@gmail.com', 13),
(10, 'Stefan', 'Rzeszowiak', '321654983', 'stefan.rzeszowiak@gmail.com', 14),
(11, 'Mariusz', 'Warszawiak', '321654984', 'mariusz.warszawaiak@gmail.com', 15),
(12, 'Filip', 'Nowak', '321654985', 'filip.nowak@gmail.com', 16),
(13, 'Grzegorz', 'Staron', '321654986', 'grzegorz.staron@gmail.com', 17),
(14, 'Kuba', 'Starszon', '321654987', 'kuba.starszon@gmail.com', 18);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `adres_oddzialu`
--
ALTER TABLE `adres_oddzialu`
  ADD PRIMARY KEY (`id_oddzialu`),
  ADD KEY `adres_oddzialu_with_kontrahent` (`id_kontrahenta`);

--
-- Indeksy dla tabeli `kontrahent`
--
ALTER TABLE `kontrahent`
  ADD PRIMARY KEY (`id_kontrahenta`);

--
-- Indeksy dla tabeli `osoba_kontaktowa`
--
ALTER TABLE `osoba_kontaktowa`
  ADD PRIMARY KEY (`id_osoby_kontaktowej`),
  ADD KEY `osoba_kontaktowa_with_adres_oddzialu` (`id_oddzialu`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `adres_oddzialu`
--
ALTER TABLE `adres_oddzialu`
  MODIFY `id_oddzialu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT dla tabeli `kontrahent`
--
ALTER TABLE `kontrahent`
  MODIFY `id_kontrahenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT dla tabeli `osoba_kontaktowa`
--
ALTER TABLE `osoba_kontaktowa`
  MODIFY `id_osoby_kontaktowej` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `adres_oddzialu`
--
ALTER TABLE `adres_oddzialu`
  ADD CONSTRAINT `adres_oddzialu_with_kontrahent` FOREIGN KEY (`id_kontrahenta`) REFERENCES `kontrahent` (`id_kontrahenta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `osoba_kontaktowa`
--
ALTER TABLE `osoba_kontaktowa`
  ADD CONSTRAINT `osoba_kontaktowa_with_adres_oddzialu` FOREIGN KEY (`id_oddzialu`) REFERENCES `adres_oddzialu` (`id_oddzialu`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
