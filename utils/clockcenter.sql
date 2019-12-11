-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Ott 05, 2018 alle 00:29
-- Versione del server: 5.6.15-log
-- PHP Version: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `clockcenter`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `birthday` date NOT NULL,
  `city` varchar(30) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`,`surname`,`birthday`,`city`,`telephone`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dump dei dati per la tabella `customer`
--

INSERT INTO `customer` (`id`, `name`, `surname`, `birthday`, `city`, `telephone`, `email`) VALUES
(1, 'Bezalel', 'Simmel', '1985-11-21', 'Dallas', '654785521', 'Bezalel.Simmel@gmail.com'),
(2, 'Parto', 'Bamford', '1986-08-28', 'Abu Dhabi', '330214870', NULL),
(3, 'Saniya', 'Piveteau', '1987-05-24', 'Florencia', '201489678', NULL),
(4, 'Chirstian', 'Koblick', '1991-01-18', 'Le Mans', '021045688', NULL),
(5, 'Kyoichi', 'Maliniak', '1989-09-12', 'Sivas', '360547120', 'Kyoichi.Maliniak@gmail.com'),
(6, 'Berni', 'Preusig', '1989-06-02', 'Aurora', '365002148', 'Berni.Preusig@outlook.com'),
(7, 'Duangkaew', 'Genin', '1985-05-23', 'Abu Dhabi', '1425740157', 'Duangkaew.Genin@gmail.com'),
(8, 'Sumant', 'Zielinski', '1989-02-10', 'Dallas', '548666999', 'Sumant.Zielinski@gmail.com'),
(9, 'Saniya', 'Kalloufi', '1994-09-15', 'Abu Dhabi', '1293278995', NULL),
(10, 'Berni', 'Genin', '1975-09-21', 'Tegal', '3326422495', NULL),
(11, 'Sumant', 'Peac', '1985-02-18', 'Abu Dhabi', '225697874', NULL),
(12, 'Duangkaew', 'Piveteau', '1985-02-18', 'Mardan', '2215987454', 'Duangkaew.Piveteau@outlook.com'),
(13, 'Berni', 'Genin', '1977-08-26', 'Aurora', '228714489', NULL),
(14, 'Parto', 'Piveteau', '1989-02-10', 'Aurora', '222145887', 'Parto.Piveteau@hotmail.it'),
(15, 'Chirstian', 'Kalloufi', '1989-02-10', 'Florencia', '226706999', 'Chirstian.Kalloufi@gmail.com'),
(16, 'Duangkaew', 'Kalloufi', '1994-09-15', 'Sivas', '630258995', NULL),
(17, 'Anneke', 'Peac', '1985-05-23', 'Abu Dhabi', '6607022495', NULL),
(18, 'Kyoichi', 'Zielinski', '1991-01-18', 'Valencia', '3301214581', 'Kyoichi.Zielinski@hotmail.it'),
(19, 'Duangkaew', 'Peac', '1985-05-23', 'Tegal', '066502557', 'Duangkaew.Peac@outlook.com'),
(20, 'Berni', 'Genin', '1986-12-01', 'Abu Dhabi', '746998749', 'Berni.Genin@gmail.com'),
(25, 'Elena', 'Catania', '1999-05-06', 'Catania', '3930564915', 'gesu.quore@pontifex.wc'),
(24, 'Ilenia', 'Marino', '2004-05-29', 'Catania', '3425343166', 'ileniamarino04@gmail.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `fornitore`
--

CREATE TABLE IF NOT EXISTS `fornitore` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod_f` varchar(16) NOT NULL,
  `p_iva` varchar(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `type` varchar(30) NOT NULL COMMENT 'Tipo di merce fornita',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cod_f` (`cod_f`,`p_iva`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dump dei dati per la tabella `fornitore`
--

INSERT INTO `fornitore` (`id`, `cod_f`, `p_iva`, `name`, `email`, `telephone`, `type`) VALUES
(1, 'DVSRGR70L31F205G', '46703734403', 'Roger Davis', 'RogerDavis@jourrapide.com', '4049179066', 'Cinturini Morellato'),
(2, 'RCHGRG89M07L219S', '43446934236', 'George Richburg', 'GeorgeRichburg@rhyta.com', '9729289500', 'Ricambi Vari'),
(3, 'JHNCRL70H02A089I', '60543061497', 'Charles Johnson', 'CharlesJohnson@teleworm.com', '6015689413', 'Rappr. Fossil'),
(4, 'CMBDLN72P67H501Y', '44671461086', 'Darlene Combs', 'DarleneCombs@armyspy.com', '5099404456', 'Rappr. Fossil'),
(5, 'FRNMXN79E46H501S', '48918408615', 'Maxine Frankli', 'MaxineFranklin@armyspy.com', '2538748509', 'Cinturini'),
(6, 'BCDFGH12G34H567I', '25789001457', 'Faghell Bercedi', 'Bercedi.Faghell@prova.com', '45547812601', 'Orologi Marche Varie');

-- --------------------------------------------------------

--
-- Struttura della tabella `magazzino`
--

CREATE TABLE IF NOT EXISTS `magazzino` (
  `reference` varchar(20) NOT NULL COMMENT 'Referenza',
  `name` varchar(30) NOT NULL,
  `description` varchar(80) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `type` varchar(30) NOT NULL,
  `selling_price` float NOT NULL,
  `purchase_price` float NOT NULL,
  PRIMARY KEY (`reference`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `magazzino`
--

INSERT INTO `magazzino` (`reference`, `name`, `description`, `quantity`, `type`, `selling_price`, `purchase_price`) VALUES
('MR.3654N/BL', 'Cinturino Pelle', 'Cinturino Pelle Liscio 18mm Blu - Morellato', 10, 'Cinturino', 15, 5),
('MR.4874C/BK', 'Cinturino Pelle', 'Cinturino Pelle Coccodrillo 20mm Nero - Morellato', 10, 'Cinturino', 25, 8),
('BRS.5541A-22', 'Cinturino Acciaio', 'Cinturino Acciaio 22mm - Bros', 10, 'Cinturino', 25, 10),
('MR.4874C/RD', 'Cinturino Gomma', 'Cinturino Gomma 20mm Rosso - Bros', 6, 'Cinturino', 18, 6),
('VT1540/23', 'Vetro Minerale', 'Vetro Minerale Piatto d/23mm', 20, 'Vetro', 20, 8),
('VT4568/25', 'Vetro Zaffiro', 'Vetro Zaffiro Bombato d/25mm', 0, 'Vetro', 30, 10),
('CS8744-25', 'Cassa Acciaio', 'Cassa Acciaio d/25mm', 5, 'Cassa', 30, 10),
('CR8825S.8', 'Corona a Vite', 'Corona a Vite QZ Seiko d/8mm', 5, 'Corona', 15, 5),
('ABCD/00', 'Movimento Miyota', 'Movimento Miyota LTD 3s10', 3, 'Movimento', 30, 15);

-- --------------------------------------------------------

--
-- Struttura della tabella `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id_order` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(20) NOT NULL,
  `id_fornitore` int(11) NOT NULL,
  `id_worker` int(11) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1=Emesso; 2=In Attesa (NON Emesso); 3=Ricevuto;',
  `data_emission` date DEFAULT NULL COMMENT 'Data emissione ordine',
  `data_receipt` date DEFAULT NULL COMMENT 'Data ricezione ordine',
  `amount` float NOT NULL COMMENT 'Totale Ordine',
  PRIMARY KEY (`id_order`),
  KEY `reference` (`reference`),
  KEY `id_fornitore` (`id_fornitore`),
  KEY `id_worker` (`id_worker`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dump dei dati per la tabella `order`
--

INSERT INTO `order` (`id_order`, `reference`, `id_fornitore`, `id_worker`, `description`, `quantity`, `status`, `data_emission`, `data_receipt`, `amount`) VALUES
(1, 'MR.4874C/BK', 1, 2, 'Ordine cinturini pelle black Morellato', 15, 3, '2018-01-17', '2018-01-23', 80),
(2, 'MR.3654N/BL', 1, 2, 'Ordine cinturini pelle blue Morellato', 15, 3, '2018-01-17', '2018-01-23', 50),
(3, 'CR8825S.8', 2, 2, 'Ordine Corone a vite', 10, 3, '2018-01-08', '2018-01-12', 50),
(4, 'VT4568/25', 4, 1, 'Ordine Vetri zaffiro', 5, 2, NULL, NULL, 50),
(5, 'VT4568/25', 2, 1, 'Ordine x vetri zaffiro', 10, 2, NULL, NULL, 100),
(6, 'CR8825S.8', 3, 1, NULL, 5, 1, '2017-06-13', NULL, 25);

-- --------------------------------------------------------

--
-- Struttura della tabella `riparazione`
--

CREATE TABLE IF NOT EXISTS `riparazione` (
  `id_repair` int(11) NOT NULL AUTO_INCREMENT,
  `id_worker` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_ricambio` varchar(20) DEFAULT NULL,
  `work_description` varchar(300) NOT NULL COMMENT 'Lavori da eseguire',
  `notes` varchar(300) DEFAULT NULL,
  `clock_reference` varchar(15) NOT NULL,
  `clock_description` varchar(200) DEFAULT NULL,
  `warranty` tinyint(1) NOT NULL COMMENT '1=True; 0=False',
  `warranty_date` date DEFAULT NULL,
  `preventivo` int(1) NOT NULL COMMENT '1=Preventivo da Eseguire; 2=Preventivo Eseguito; 3=Preventivo Comunicato; 4=Preventivo Accettato; 5=Preventivo Rifiutato; 6=Nessun Preventivo',
  `repair_status` int(2) NOT NULL COMMENT '1=Ricevuta; 2=In Lavorazione; 3=Attesa Preventivo; 4=Attesa Ricambi; 5=Riparazione Completata; 6=Comunicazione Ritiro; 7=Consegnato; 8=Entrato (Pagato); 9=Non Entrato (Non Pagato)',
  `date_repair_in` date NOT NULL COMMENT 'Data entrata riparazione',
  `date_repair_out` date DEFAULT NULL COMMENT 'Data uscita riparazione',
  `discount` int(11) DEFAULT NULL COMMENT 'Percentuale di sconto',
  `amount` float DEFAULT NULL COMMENT 'Totale da pagare',
  `final_amount` float DEFAULT NULL COMMENT 'Totale finale riparazione',
  PRIMARY KEY (`id_repair`),
  KEY `id_worker` (`id_worker`),
  KEY `id_customer` (`id_customer`),
  KEY `id_ricambio` (`id_ricambio`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dump dei dati per la tabella `riparazione`
--

INSERT INTO `riparazione` (`id_repair`, `id_worker`, `id_customer`, `id_ricambio`, `work_description`, `notes`, `clock_reference`, `clock_description`, `warranty`, `warranty_date`, `preventivo`, `repair_status`, `date_repair_in`, `date_repair_out`, `discount`, `amount`, `final_amount`) VALUES
(1, 2, 5, 'VT1540/23', 'Sostituzione vetro', NULL, 'AR2547', 'Orol. Polso Armani cassa acc. cint. pelle', 0, NULL, 6, 8, '2018-02-10', '2018-02-13', NULL, 35, 35),
(2, 2, 5, 'BRS.5541A-22', 'Sostituzione cinturino', NULL, 'AR2547', 'Orol. Polso Armani cassa acc. cint. pelle', 0, NULL, 6, 8, '2018-02-10', '2018-02-13', NULL, 30, 30),
(3, 1, 8, 'MR.4874C/RD', 'Controllare funzionamento', NULL, 'B02587742', 'Orol. Polso Breil Acc/Acc.', 0, NULL, 4, 8, '2018-02-12', '2018-02-20', 10, 30, 27),
(4, 1, 2, NULL, 'Sostituzione corona a vite', NULL, 'CT.4257F', 'Orol. Polso Chronotech Acc/Acc.', 0, NULL, 6, 8, '2018-02-20', '2018-03-04', NULL, 20, 20),
(5, 1, 1, NULL, 'Revisione movimento', NULL, 'CZ98112', 'Orol. Polso Citizen Acc/Acc.', 0, NULL, 4, 9, '2018-02-26', '2018-03-07', NULL, 30, 30),
(6, 1, 10, NULL, 'Fare test impermeabilità', 'Entra acqua nel quadrante', 'AM87447', 'Orol. Polso Fossil Acc. cint. pelle', 1, '2017-12-20', 6, 9, '2018-02-26', '2018-03-07', NULL, 25, 25),
(7, 1, 19, 'VT1540/23', 'Prova inserimento', NULL, 'ABC123', 'AAABBBCCC', 1, '2017-02-04', 4, 2, '2018-03-05', NULL, NULL, 50, 50);

-- --------------------------------------------------------

--
-- Struttura della tabella `worker`
--

CREATE TABLE IF NOT EXISTS `worker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dump dei dati per la tabella `worker`
--

INSERT INTO `worker` (`id`, `username`, `password`, `name`) VALUES
(1, 'admin', 'adminroot', 'Administrator'),
(2, 'worker1', 'work1psw', 'Orologiaio 1'),
(3, 'worker2', 'work2psw', 'Orologiaio 2'),
(4, 'worker3', 'work3psw', 'Orologiaio 3'),
(5, 'gabri', 'ciaociao', 'Gabriele');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
