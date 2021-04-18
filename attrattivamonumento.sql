
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";



--
-- Struttura per vista `attrattivamonumento`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `attrattivamonumento`  AS  select `attrattiva`.`nome` AS `nome`,`attrattiva`.`indirizzo` AS `indirizzo`,`attrattiva`.`latitudine` AS `latitudine`,`attrattiva`.`longitudine` AS `longitudine`,`attrattiva`.`foto` AS `foto`,`attrattiva`.`citta` AS `citta`, `attrattiva`.`tipologia` AS `tipologia`,`monumeto`.`descrizione` AS `descrizione`,`monumeto`.`stato` AS `stato`, `attivita`.`prezzo` AS `prezzo`, `attivita`.`orarioApertura` AS `orarioApertura`, `attivita`.`orarioChiusura` AS `orarioChiusura`,`attivita`.`giornoChiusura` AS `giornoChiusura` from (`attrattiva` join `monumeto` join `attivita`) where (`attrattiva`.`nome` = `monumeto`.`nome`) ;

--
-- VIEW  `attrattivamonumento`
-- Dati: Nessuno
--

COMMIT;

