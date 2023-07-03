-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 31.11.39.104:3306
-- Creato il: Lug 03, 2023 alle 05:15
-- Versione del server: 5.7.39-42-log
-- Versione PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Sql1708645_1`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `amministratore`
--

CREATE TABLE `amministratore` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cognome` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ultimo_accesso` datetime DEFAULT NULL,
  `cf` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `via` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `n_civico` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `citta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provincia` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cap` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `piva` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_private_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `amministratore`
--

INSERT INTO `amministratore` (`email`, `nome`, `cognome`, `password`, `ultimo_accesso`, `cf`, `foto`, `via`, `n_civico`, `citta`, `provincia`, `cap`, `piva`, `stripe_private_key`) VALUES
('marchese.antoniogiovanni@gmail.com', 'Antonio Giovanni', 'Marchese', '$2y$10$MwWxyKPp2yTfbebq7XxaJuJj1xsfewfSODemEsPbqF7rDHYyw2I3C', '2023-06-21 15:46:30', 'MRCNNG89L11I872V', 'file_insegnanti/foto/1_2023_01_16_14_07_51.jpg', 'via Teodoro Mesimerio', '1/A', 'Spadola', 'VV', '89822', '03810660799', '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');

-- --------------------------------------------------------

--
-- Struttura della tabella `area_tematica`
--

CREATE TABLE `area_tematica` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `area_tematica`
--

INSERT INTO `area_tematica` (`id`, `nome`) VALUES
(8, 'Scuole Superiori');

-- --------------------------------------------------------

--
-- Struttura della tabella `certificati`
--

CREATE TABLE `certificati` (
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` int(11) DEFAULT NULL,
  `percorso` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `certificati`
--

INSERT INTO `certificati` (`nome`, `numero`, `percorso`) VALUES
('Certificato di Laurea', 1, 'file_insegnanti/certificati/1_2023_01_23_08_51_39.pdf');

-- --------------------------------------------------------

--
-- Struttura della tabella `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `id_prodotto` int(11) NOT NULL,
  `tipo_prodotto` int(11) NOT NULL,
  `id_studente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `corso`
--

CREATE TABLE `corso` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `materia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `corso`
--

INSERT INTO `corso` (`id`, `nome`, `materia`) VALUES
(1, 'Informatica Terzo Anno', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `esercizio`
--

CREATE TABLE `esercizio` (
  `id` int(11) NOT NULL,
  `titolo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `traccia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `svolgimento` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `corso_ex` int(11) DEFAULT NULL,
  `prezzo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `fattura`
--

CREATE TABLE `fattura` (
  `numero` int(11) NOT NULL,
  `data` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `fattura`
--

INSERT INTO `fattura` (`numero`, `data`) VALUES
(0, '2023-01-23 09:07:50');

-- --------------------------------------------------------

--
-- Struttura della tabella `fatture`
--

CREATE TABLE `fatture` (
  `numero` int(11) NOT NULL,
  `data` datetime DEFAULT NULL,
  `percorso` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `feedback`
--

CREATE TABLE `feedback` (
  `studente` int(11) NOT NULL,
  `prodotto` int(11) NOT NULL,
  `tipo_prodotto` int(11) NOT NULL,
  `punteggio` int(11) DEFAULT NULL,
  `recensione` mediumtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `lezione`
--

CREATE TABLE `lezione` (
  `id` int(11) NOT NULL,
  `titolo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `corso_lez` int(11) NOT NULL,
  `presentazione` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lezione` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prezzo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `lezione`
--

INSERT INTO `lezione` (`id`, `titolo`, `numero`, `corso_lez`, `presentazione`, `lezione`, `prezzo`) VALUES
(1, 'Introduzione all\'informatica', 1, 1, 'file_lezioni/1_2023_02_20_11_15_20.png', 'file_lezioni/1_2023_02_20_11_15_27.pdf', 0),
(2, 'Conversione Binario - Decimale - Esadecimale', 2, 1, 'file_lezioni/1_2023_02_23_09_11_28.jpg', 'file_lezioni/1_2023_02_23_09_11_38.pdf', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `materia`
--

CREATE TABLE `materia` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_tematica` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `materia`
--

INSERT INTO `materia` (`id`, `nome`, `area_tematica`) VALUES
(1, 'Informatica', 8);

-- --------------------------------------------------------

--
-- Struttura della tabella `messaggi_chat`
--

CREATE TABLE `messaggi_chat` (
  `id_chat` int(11) NOT NULL,
  `messaggio` mediumtext COLLATE utf8mb4_unicode_ci,
  `autore` int(11) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

CREATE TABLE `ordine` (
  `id` int(11) NOT NULL,
  `cliente` int(11) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `fattura` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotti_ordine`
--

CREATE TABLE `prodotti_ordine` (
  `id_ordine` int(11) NOT NULL,
  `prodotto` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `prezzo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `richieste_lezioni`
--

CREATE TABLE `richieste_lezioni` (
  `id` int(11) NOT NULL,
  `titolo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `studente` int(11) DEFAULT NULL,
  `traccia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `svolgimento` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prezzo` int(11) DEFAULT NULL,
  `evasa` int(11) DEFAULT '0',
  `pagata` int(11) DEFAULT '0',
  `data` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `studente`
--

CREATE TABLE `studente` (
  `id` int(11) NOT NULL,
  `utente_s` int(11) DEFAULT NULL,
  `via` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `n_civico` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `citta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provincia` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cap` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cf` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `studente`
--

INSERT INTO `studente` (`id`, `utente_s`, `via`, `n_civico`, `citta`, `provincia`, `cap`, `cf`) VALUES
(1, 1, 'via Teodoro Mesimerio', '1/A', 'Spadola', 'VV', '89822', 'MRCNNG89L11I872V');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cognome` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codice_attivaz` char(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_iscrizione` datetime DEFAULT NULL,
  `ultimo_accesso` datetime DEFAULT NULL,
  `stato_account` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`id`, `email`, `password`, `nome`, `cognome`, `codice_attivaz`, `data_iscrizione`, `ultimo_accesso`, `stato_account`) VALUES
(1, 'marchese89@hotmail.com', '$2y$10$bEiMlRWif76a6PFgtQo4aOoomjDgHiEpfByixiM.YLy1gTYvmXAVC', 'Antonio Giovanni', 'Marchese', 'jW5JsY', '2023-05-14 20:10:45', '2023-05-15 13:04:34', 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `amministratore`
--
ALTER TABLE `amministratore`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `cf_UNIQUE` (`cf`);

--
-- Indici per le tabelle `area_tematica`
--
ALTER TABLE `area_tematica`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `nome_UNIQUE` (`nome`);

--
-- Indici per le tabelle `certificati`
--
ALTER TABLE `certificati`
  ADD PRIMARY KEY (`nome`),
  ADD UNIQUE KEY `numero_UNIQUE` (`numero`);

--
-- Indici per le tabelle `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_prodotto`,`tipo_prodotto`,`id_studente`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `studente_idx` (`id_studente`);

--
-- Indici per le tabelle `corso`
--
ALTER TABLE `corso`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `materia_idx` (`materia`);

--
-- Indici per le tabelle `esercizio`
--
ALTER TABLE `esercizio`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `corso_ex_idx` (`corso_ex`);

--
-- Indici per le tabelle `fattura`
--
ALTER TABLE `fattura`
  ADD PRIMARY KEY (`numero`);

--
-- Indici per le tabelle `fatture`
--
ALTER TABLE `fatture`
  ADD PRIMARY KEY (`numero`);

--
-- Indici per le tabelle `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`studente`,`prodotto`,`tipo_prodotto`);

--
-- Indici per le tabelle `lezione`
--
ALTER TABLE `lezione`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `corso_lez_idx` (`corso_lez`);

--
-- Indici per le tabelle `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `area_tematica_idx` (`area_tematica`);

--
-- Indici per le tabelle `messaggi_chat`
--
ALTER TABLE `messaggi_chat`
  ADD PRIMARY KEY (`id_chat`,`data`,`autore`);

--
-- Indici per le tabelle `ordine`
--
ALTER TABLE `ordine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_idx` (`cliente`);

--
-- Indici per le tabelle `prodotti_ordine`
--
ALTER TABLE `prodotti_ordine`
  ADD PRIMARY KEY (`id_ordine`,`prodotto`,`tipo`);

--
-- Indici per le tabelle `richieste_lezioni`
--
ALTER TABLE `richieste_lezioni`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indici per le tabelle `studente`
--
ALTER TABLE `studente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `utente_s_idx` (`utente_s`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `area_tematica`
--
ALTER TABLE `area_tematica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `studente`
--
ALTER TABLE `studente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
