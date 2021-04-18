SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";




/*
	PROCEDURE

 */

DELIMITER $$ --inizio procedure

CREATE DEFINER=`root`@`localhost` PROCEDURE `aggiungiPreferito` (IN `nomeP` VARCHAR(45), `user` VARCHAR(45), OUT `risultato` INT)  BEGIN
START TRANSACTION;
	INSERT INTO preferiti (nomePercorso, nomeUtente) VALUES (nomeP, user);
	SET risultato = 1;
COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `commentaAttrattiva` (IN `testoP` VARCHAR(45), IN `data` DATE, `voto` ENUM('1','2','3','4','5'), `user` VARCHAR(45), `attrattiva` VARCHAR(45), OUT `risultato` INT)  BEGIN
START TRANSACTION;
	IF((SELECT COUNT(testoP) FROM commento WHERE testoP=testo)!=0) THEN
		SET risultato = 0;
	ELSE
		INSERT INTO commento (testo, dataCommento, votazione,usernameUtente,nomeAttrattiva) VALUES (testoP, data, voto, user, attrattiva);
		SET risultato = 1;
	END IF;
COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `composizionePercorso` (IN `percorso` VARCHAR(45))  BEGIN
 START TRANSACTION;
		SELECT * FROM composizionepercorso WHERE percorso=nomePercorso;
 end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `creaPercorso` (IN `nomeP` VARCHAR(45), IN `categoria` ENUM('Arte','Storia','Natura','Gastronomico','Relax','Misto'), IN `durata` DATETIME, IN `citta` VARCHAR(45), IN `user` VARCHAR(45), OUT `risultato` INT)  BEGIN
START TRANSACTION;
	INSERT INTO percorso (nomePercorso, categoria, durata, citta, creatorePercorso) VALUES (nomeP, categoria, durata, citta, user);
	SET risultato = 1;
COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `infoAttrattiva` (IN `nomeAttrattiva` VARCHAR(45))  BEGIN
 START TRANSACTION;
	SELECT * FROM attrattiva, attivita, monumeto WHERE nomeAttrattiva=attrattiva.nome AND nomeAttrattiva = attivita.nome AND nomeAttrattiva = monumeto.nome;
 end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `infoAttrattiva2` (IN `nomeAttrattiva` VARCHAR(45))  BEGIN
 START TRANSACTION;
	SELECT * FROM attrattivamonumento WHERE nomeAttrattiva = attrattivaMonumento.nome;
 end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `infoAttrattivaCitta` (IN `cittad` VARCHAR(45))  BEGIN
 START TRANSACTION;
	SELECT * FROM attrattiva WHERE cittad = citta ;
 end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `infoCitta` (IN `nomec` VARCHAR(45))  BEGIN
 START TRANSACTION;
	SELECT * FROM citta WHERE nomec=nome;
 end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `infoEvento` (IN `titoloEv` VARCHAR(45))  BEGIN
 START TRANSACTION;
	SELECT * FROM evento WHERE titoloEv=titolo;
 end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `infoGestore` (IN `user` VARCHAR(45))  BEGIN
 START TRANSACTION;
	SELECT * FROM gestore WHERE user=username;
 end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `infoPercorso` (IN `nomeP` VARCHAR(45))  BEGIN
 START TRANSACTION;
	SELECT * FROM percorso WHERE nomeP=nomePercorso;
 end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `infoStat1` (IN `citta` VARCHAR(45))  BEGIN
 START TRANSACTION;
	SELECT * FROM statatt WHERE citta=statatt.citta;
 end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `infoStat2` (IN `citta` VARCHAR(45))  BEGIN
 START TRANSACTION;
	SELECT * FROM statper WHERE citta=statper.citta;
 end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `infoStat3` ()  BEGIN
 START TRANSACTION;
	SELECT * FROM statut;
 end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `infoUtente` (IN `nome` VARCHAR(45))  BEGIN
 START TRANSACTION;
	SELECT * FROM utente WHERE nome=username;
 end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `inserimentoAttivita` (IN `nomeA` VARCHAR(45), IN `indirizzo` VARCHAR(45), IN `latitudine` INT, IN `longitudine` INT, IN `foto` varchar(200), IN `citta` VARCHAR(45), IN `tipologia` VARCHAR(45), IN `user` VARCHAR(45), IN `prezzo` INT, IN `apertura` INT, IN `chiusura` INT, IN `giorno` ENUM('Lunedi','Martedi','Mercoledi','Giovedi','Venerdi','Sabato','Domenica'), OUT `risultato` INT)  BEGIN
 START TRANSACTION;
	 IF((SELECT COUNT(nome) FROM attrattiva WHERE nomeA=nome)!=0) THEN
	 	SET risultato = 0;
	 else
	 	insert into attrattiva (nome, indirizzo, latitudine, longitudine, foto, citta, tipologia,nomeInseritore) VALUES (nomeA, indirizzo, latitudine, longitudine, foto, citta, tipologia,user);
	 	insert into attivita(nome, prezzo, orarioApertura, orarioChiusura, giornoChiusura, citta) VALUES (nomeA, prezzo, apertura,chiusura,giorno, citta);
	 	UPDATE utente SET numeroAttrattiveInserite=numeroAttrattiveInserite+1 
	 	WHERE user=utente.username;
	 	SET risultato = 1;
	 end if;
 commit;
 end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `inserimentoEvento` (IN `organizzatore` VARCHAR(45), IN `attivita` VARCHAR(45), IN `titolo` VARCHAR(45), IN `descrizione` VARCHAR(255), IN `data` DATE, IN `inizio` INT, IN `partecipanti` INT, IN `stato` ENUM('Aperto','Chiuso'), IN `citta` VARCHAR(45), OUT `risultato` INT)  BEGIN
START TRANSACTION;
	INSERT INTO evento (nomeOrganizzatore, nomeAttivita, titolo,descrizione,dataEvento,orarioInizio,numeroPartecipanti,stato,citta) VALUES (organizzatore, attivita, titolo, descrizione, data,inizio,partecipanti,stato, citta);
	SET risultato = 1;
COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `inserimentoMonumento` (IN `nomeA` VARCHAR(45), IN `indirizzo` VARCHAR(45), IN `latitudine` INT, IN `longitudine` INT, IN `foto` varchar(200), IN `citta` VARCHAR(45), IN `tipologia` VARCHAR(45), IN `user` VARCHAR(45), IN `descrizione` VARCHAR(45), IN `stato` ENUM('Visitabile','Non visitabile','Visitabile gratuitamente'), OUT `risultato` INT)  BEGIN
 START TRANSACTION;
	 IF((SELECT COUNT(nome) FROM attrattiva WHERE nomeA=nome)!=0) THEN
	 	SET risultato = 0;
	 else
	 	insert into attrattiva (nome, indirizzo, latitudine, longitudine, foto, citta, tipologia,nomeInseritore) VALUES (nomeA, indirizzo, latitudine, longitudine, foto, citta, tipologia,user);
	 	insert into monumeto(nome, descrizione, stato, citta) VALUES (nomeA, descrizione, stato, citta);
		UPDATE utente SET numeroAttrattiveInserite=numeroAttrattiveInserite+1  WHERE user=utente.username;
	 	SET risultato = 1;
	 end if;
 commit;
 end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insPremium` (IN `user` VARCHAR(45), OUT `risultato` INT)  BEGIN
START TRANSACTION;
	INSERT INTO premium (username) VALUES (user);
	SET risultato = 1;
COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `invioMessaggio` (IN `titoloP` VARCHAR(45), IN `dataInvio` DATE, IN `descrizione` VARCHAR(255), IN `tipo` ENUM('Pubblico','Privato'), IN `mittente` VARCHAR(45), IN `destinatario` VARCHAR(45), OUT `risultato` INT)  BEGIN
 START TRANSACTION;
	 IF((SELECT COUNT(titoloP) FROM messaggio WHERE titoloP=titolo)!=0) THEN
	 	SET risultato = 0;
	 else
	 	insert into messaggio (titolo, dataInvio, descrizione, tipoMessaggio, nomeMittente, nomeDestinatario) VALUES (titoloP, dataInvio, descrizione, tipo, mittente, destinatario);
	 	SET risultato = 1;
	 end if;
 commit;
 end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listaPreferiti` (IN `user` VARCHAR(45))  BEGIN
 START TRANSACTION;
	SELECT * FROM preferiti WHERE user=nomeUtente;
 end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `loginUtente` (IN `user` VARCHAR(20), IN `pass` VARCHAR(20), OUT `risultato` INT)  BEGIN
    START TRANSACTION;
            IF(( SELECT count(username) FROM utente WHERE user=username AND pass=password) >0) THEN
    SET risultato= 1;    
           ELSE 
            SET risultato= 0;
           END IF;
  END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `messaggiInviati` (IN `mittente` VARCHAR(45))  BEGIN
 START TRANSACTION;
	SELECT * FROM messaggio WHERE mittente=nomeMittente;
 end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `messaggiPubblici` ()  BEGIN
 START TRANSACTION;
	SELECT * FROM messaggio WHERE tipoMessaggio='Pubblico';
 end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `messaggiRicevuti` (IN `destinatario` VARCHAR(45))  BEGIN
 START TRANSACTION;
	SELECT * FROM messaggio WHERE destinatario=nomeDestinatario;
 end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `partecipaEvento` (IN `titolo` VARCHAR(45), IN `username` VARCHAR(45), IN `nomeattivita` VARCHAR(45), OUT `risultato` INT)  BEGIN
START TRANSACTION;
	INSERT INTO partecipazioneevento (titoloEvento, nomeUtente, nomeAttivita) VALUES (titolo, username, nomeattivita);
	UPDATE evento SET numero=numero+1
	WHERE titolo=evento.titolo;
	SET risultato = 1;
COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `popolaPercorso` (IN `nomeP` VARCHAR(45), IN `attrattiva` VARCHAR(45), IN `durata` DATETIME, OUT `risultato` INT)  BEGIN
START TRANSACTION;
	INSERT INTO composizionepercorso(nomePercorso, nomeAttrattiva, durata) VALUES (nomeP, attrattiva, durata);
	UPDATE composizionepercorso SET composizionepercorso.posizione=composizionepercorso.posizione+1
	WHERE composizionepercorso.nomePercorso = nomeP;
	SET risultato = 1;
COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registraGestore` (IN `user` VARCHAR(45), IN `mail` VARCHAR(45), IN `pass` VARCHAR(45), IN `nascita` DATE, IN `citta` VARCHAR(45), IN `attivita` VARCHAR(45), IN `via` VARCHAR(45), IN `rec` VARCHAR(45), IN `sito` VARCHAR(45), IN `tipo` ENUM('Semplice','Premium','Gestore'), OUT `risultato` INT)  BEGIN
 START TRANSACTION;
	 IF((SELECT COUNT(username) FROM gestore WHERE user=username)!=0) THEN
	 	SET risultato = 0;
	 else
	 	insert into gestore (username, email, password, dataNascita, residenza, nomeAttivita, indirizzo, telefono, sitoWeb, tipologia) VALUES (user, mail, pass, nascita, citta, attivita, via, rec, sito, tipo);
	 	insert into utente (username, email, password, dataNascita, residenza, tipologia) VALUES (user, mail, pass, nascita, citta, tipo);
	 SET risultato = 1;
	 end if;
 commit;
 end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registraUtente` (IN `user` VARCHAR(45), IN `mail` VARCHAR(45), IN `pass` VARCHAR(45), IN `nascita` DATE, IN `citta` VARCHAR(45), IN `tipo` ENUM('Semplice','Premium','Gestore'), OUT `risultato` INT)  BEGIN
START TRANSACTION;
	IF((SELECT COUNT(username) FROM utente WHERE user=username)!=0) THEN
		SET risultato = 0;
	ELSE
		INSERT INTO utente (username, email, password, dataNascita, residenza, tipologia) VALUES (user, mail, pass, nascita, citta, tipo);
		SET risultato = 1;
	END IF;
COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Stat1` ()  BEGIN
CREATE OR REPLACE VIEW StatAtt AS
SELECT A.nome, AVG(C.votazione) as Voto, A.citta
      FROM attrattiva as A, commento as C
      WHERE A.nome=C.nomeAttrattiva
      GROUP BY A.nome
      ORDER BY Voto DESC;   
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Stat2` ()  BEGIN
CREATE OR REPLACE VIEW StatPer AS

SELECT P.nomePercorso, COUNT(*) as Tot, P.citta
      FROM percorso as P, preferiti as Pr
      WHERE   P.nomePercorso=Pr.nomePercorso
      GROUP BY P.nomePercorso
      ORDER BY Tot DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Stat3` ()  BEGIN 
CREATE OR REPLACE VIEW StatUt AS

SELECT U.username, COUNT(*) as Tot
      FROM utente as U, attrattiva as A
      WHERE U.username= A.nomeInseritore
      GROUP BY U.username
      ORDER BY Tot DESC, U.username ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `visualizzaAttrattiva` (IN `attrattiva` VARCHAR(45))  BEGIN
 START TRANSACTION;
	SELECT * FROM attrattiva WHERE attrattiva=nome;
 end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `visualizzaCommento` (IN `attrattiva` VARCHAR(45))  BEGIN
 START TRANSACTION;
	SELECT * FROM commento WHERE attrattiva=nomeAttrattiva;
 end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `visualizzaPartecipanti` (IN `user` VARCHAR(45))  BEGIN
 START TRANSACTION;
	SELECT * FROM partecipazioneevento WHERE user=nomeUtente;
 end$$

DELIMITER ; --fine procedure


/*

	TABELLE DATABASE

 */




CREATE TABLE `attivita` (
  `nome` varchar(45) NOT NULL,
  `prezzo` int(11) NOT NULL,
  `orarioApertura` time NOT NULL,
  `orarioChiusura` time NOT NULL,
  `giornoChiusura` enum('Lunedi','Martedi','Mercoledi','Giovedi','Venerdi','Sabato','Domenica') DEFAULT 'Domenica',
  `citta` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `attivita` (`nome`, `prezzo`, `orarioApertura`, `orarioChiusura`, `giornoChiusura`, `citta`) VALUES
('xsdsd', 12, '00:00:23', '00:00:23', 'Lunedi', 'Bologna');

-- --------------------------------------------------------


CREATE TABLE `attrattiva` (
  `nome` varchar(45) NOT NULL,
  `indirizzo` varchar(45) NOT NULL,
  `latitudine` int(11) NOT NULL,
  `longitudine` varchar(45) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `citta` varchar(45) NOT NULL,
  `tipologia` enum('Monumento','Attivita') NOT NULL,
  `nomeInseritore` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `attrattiva` (`nome`, `indirizzo`, `latitudine`, `longitudine`, `foto`, `citta`, `tipologia`, `nomeInseritore`) VALUES
('asdasdasd', 'asasdasd', -1, '-1', 0x626f6c6f676e612d363230783337322e6a7067, 'Bologna', 'Monumento', 'a'),
('sdasdasd', 'asasda', -1, '-1', 0x626f6c6f676e612d363230783337322e6a7067, 'Bologna', 'Monumento', 'Ma'),
('xasdasd', 'asdasdasd', -1, '-1', 0x626f6c6f676e612d363230783337322e6a7067, 'Bologna', 'Monumento', 'Ma'),
('xsdsd', 'dsdasd', -1, '-1', 0x626f6c6f676e612d363230783337322e6a7067, 'Bologna', 'Attivita', 'Ma'),
('zxzsdasdasd', 'dasdasd', -1, '-1', 0x626f6c6f676e612d363230783337322e6a7067, 'Bologna', 'Monumento', 'a');

-- --------------------------------------------------------


CREATE TABLE `attrattivamonumento` (
`nome` varchar(45)
,`indirizzo` varchar(45)
,`latitudine` int(11)
,`longitudine` varchar(45)
,`foto` varchar(200) 
,`citta` varchar(45)
,`tipologia` enum('Monumento','Attivita')
,`descrizione` varchar(255)
,`stato` enum('Visitabile','Non visitabile','Visitabile gratuitamente')
,`prezzo` int(11)
,`orarioApertura` time
,`orarioChiusura` time
,`giornoChiusura` enum('Lunedi','Martedi','Mercoledi','Giovedi','Venerdi','Sabato','Domenica')
);

-- --------------------------------------------------------


CREATE TABLE `citta` (
  `nome` varchar(45) NOT NULL,
  `regione` varchar(45) NOT NULL,
  `stato` varchar(45) NOT NULL,
  `foto` varchar(200)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `citta` (`nome`, `regione`, `stato`, `foto`) VALUES
('Bologna', 'Emilia-Romagna', 'Italia', NULL),
('La Spezia', 'Liguria', 'Italia', NULL),
('Forli', 'Emilia Romagna', 'Italia', NULL),
('Lugo', 'Emilia Romagna', 'Italia', NULL),
('Napoli ', 'Campania ', 'Italia', NULL),
('Milano', 'Lombardia', 'Italia', NULL),
('Padova ', 'Veneto', 'Italia', NULL),
('Reggio Emilia', 'Emilia Romagna', 'Italia', NULL),
('Roma', 'Lazio', 'Italia', NULL),



-- --------------------------------------------------------


CREATE TABLE `commento` (
  `testo` varchar(300) NOT NULL,
  `dataCommento` date NOT NULL,
  `votazione` enum('1','2','3','4','5') NOT NULL,
  `usernameUtente` varchar(45) NOT NULL,
  `nomeAttrattiva` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `commento` (`testo`, `dataCommento`, `votazione`, `usernameUtente`, `nomeAttrattiva`) VALUES
('bellissimo!', '2018-07-01', '1', 'a', 'asdasdasd');

-- --------------------------------------------------------


CREATE TABLE `composizionepercorso` (
  `nomePercorso` varchar(45) NOT NULL,
  `nomeAttrattiva` varchar(45) NOT NULL,
  `durata` time NOT NULL,
  `posizione` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------


CREATE TABLE `evento` (
  `nomeOrganizzatore` varchar(45) NOT NULL,
  `nomeAttivita` varchar(45) NOT NULL,
  `titolo` varchar(45) NOT NULL,
  `descrizione` varchar(300) NOT NULL,
  `dataEvento` date NOT NULL,
  `orarioInizio` time NOT NULL,
  `numeroPartecipanti` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `stato` enum('Aperto','Chiuso') NOT NULL,
  `citta` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `evento` (`nomeOrganizzatore`, `nomeAttivita`, `titolo`, `descrizione`, `dataEvento`, `orarioInizio`, `numeroPartecipanti`, `numero`, `stato`, `citta`) VALUES
('a', 'a', 'asdasd', 'asdasd', '2018-12-31', '00:00:23', 2, 1, 'Aperto', 'Bologna');


/*
	TRIGGER EVENTO
 */

DELIMITER $$
CREATE TRIGGER `chiusura` BEFORE UPDATE ON `evento` FOR EACH ROW BEGIN

          IF( (NEW.numeroPartecipanti = NEW.numero) AND (NEW.stato='Aperto') ) THEN
              SET NEW.stato='Chiuso';
            END IF;
           END
$$
DELIMITER ;

-- --------------------------------------------------------



CREATE TABLE `gestore` (
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `dataNascita` date NOT NULL,
  `residenza` varchar(45) NOT NULL,
  `nomeAttivita` varchar(45) NOT NULL,
  `indirizzo` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `sitoWeb` varchar(45) NOT NULL,
  `tipologia` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `gestore` (`username`, `email`, `password`, `dataNascita`, `residenza`, `nomeAttivita`, `indirizzo`, `telefono`, `sitoWeb`, `tipologia`) VALUES
('a', 'a@a', '0cc175b9c0f1b6a831c399e269772661', '2018-12-31', 'Bologna', 'a', 'a', 'a', 'a', 'Gestore');

-- --------------------------------------------------------



CREATE TABLE `messaggio` (
  `idMessaggio` int(11) NOT NULL,
  `titolo` varchar(45) NOT NULL,
  `dataInvio` date NOT NULL,
  `descrizione` varchar(300) NOT NULL,
  `tipoMessaggio` enum('Privato','Pubblico') NOT NULL,
  `nomeMittente` varchar(45) NOT NULL,
  `nomeDestinatario` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `messaggio` (`idMessaggio`, `titolo`, `dataInvio`, `descrizione`, `tipoMessaggio`, `nomeMittente`, `nomeDestinatario`) VALUES
(24, 'asdasd', '2018-06-01', 'asdasd', 'Pubblico', 'a', 'a');

-- --------------------------------------------------------



CREATE TABLE `monumeto` (
  `nome` varchar(45) NOT NULL,
  `descrizione` varchar(255) NOT NULL,
  `stato` enum('Visitabile','Non visitabile','Visitabile gratuitamente') NOT NULL,
  `citta` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `monumeto` (`nome`, `descrizione`, `stato`, `citta`) VALUES
('asdasdasd', 'dasasdasd', 'Visitabile', 'Bologna'),
('sdasdasd', 'sdadasd', 'Visitabile', 'Bologna'),
('xasdasd', 'asdasd', 'Visitabile', 'Bologna'),
('zxzsdasdasd', 'asasease', 'Visitabile', 'Bologna');

-- --------------------------------------------------------



CREATE TABLE `partecipazioneevento` (
  `titoloEvento` varchar(45) NOT NULL,
  `nomeUtente` varchar(45) NOT NULL,
  `nomeAttivita` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `partecipazioneevento` (`titoloEvento`, `nomeUtente`, `nomeAttivita`) VALUES
('asdasd', 'a', 'a');

-- --------------------------------------------------------



CREATE TABLE `percorso` (
  `nomePercorso` varchar(45) NOT NULL,
  `categoria` varchar(45) NOT NULL,
  `durata` datetime NOT NULL,
  `citta` varchar(45) NOT NULL,
  `creatorePercorso` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------



CREATE TABLE `preferiti` (
  `nomePercorso` varchar(45) NOT NULL,
  `nomeUtente` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------



CREATE TABLE `premium` (
  `username` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `premium` (`username`) VALUES
('Ma');
-- --------------------------------------------------------


CREATE TABLE `statper` (
`nomePercorso` varchar(45)
,`Tot` bigint(21)
,`citta` varchar(45)
);


-- --------------------------------------------------------


CREATE TABLE `statatt` (
`nome` varchar(45)
,`Voto` decimal(5,4)
,`citta` varchar(45)
);


-- --------------------------------------------------------


CREATE TABLE `statut` (
`username` varchar(45)
,`Tot` bigint(21)
);

-- --------------------------------------------------------



CREATE TABLE `utente` (
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `dataNascita` date NOT NULL,
  `residenza` varchar(45) NOT NULL,
  `tipologia` enum('Semplice','Premium','Gestore') NOT NULL,
  `numeroAttrattiveInserite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `utente` (`username`, `email`, `password`, `dataNascita`, `residenza`, `tipologia`, `numeroAttrattiveInserite`) VALUES
('a', 'a@a', '0cc175b9c0f1b6a831c399e269772661', '2018-12-31', 'Bologna', 'Gestore', 2),
('Ma', 'm@a', '0cc175b9c0f1b6a831c399e269772661', '2018-12-31', 'Bologna', 'Premium', 3);

/*

	TRIGGER UTENTE

 */
DELIMITER $$
CREATE TRIGGER `promozione` BEFORE UPDATE ON `utente` FOR EACH ROW BEGIN
          IF( (NEW.numeroAttrattiveInserite>2) AND (NEW.tipologia='Semplice') ) THEN
              SET NEW.tipologia='Premium';
            END IF;
           END
$$
DELIMITER ;

-- --------------------------------------------------------


DROP TABLE IF EXISTS `attrattivamonumento`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `attrattivamonumento`  AS  select `attrattiva`.`nome` AS `nome`,`attrattiva`.`indirizzo` AS `indirizzo`,`attrattiva`.`latitudine` AS `latitudine`,`attrattiva`.`longitudine` AS `longitudine`,`attrattiva`.`foto` AS `foto`,`attrattiva`.`citta` AS `citta`,`attrattiva`.`tipologia` AS `tipologia`,`monumeto`.`descrizione` AS `descrizione`,`monumeto`.`stato` AS `stato`,`attivita`.`prezzo` AS `prezzo`,`attivita`.`orarioApertura` AS `orarioApertura`,`attivita`.`orarioChiusura` AS `orarioChiusura`,`attivita`.`giornoChiusura` AS `giornoChiusura` from ((`attrattiva` join `monumeto`) join `attivita`) where ((`attrattiva`.`nome` = `monumeto`.`nome`) or (`attrattiva`.`nome` = `attivita`.`nome`)) ;

-- --------------------------------------------------------


DROP TABLE IF EXISTS `statatt`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `statatt`  AS  select `a`.`nome` AS `nome`,avg(`c`.`votazione`) AS `Voto`,`a`.`citta` AS `citta` from (`attrattiva` `a` join `commento` `c`) where (`a`.`nome` = `c`.`nomeAttrattiva`) group by `a`.`nome` order by avg(`c`.`votazione`) desc ;

-- --------------------------------------------------------


DROP TABLE IF EXISTS `statper`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `statper`  AS  select `p`.`nomePercorso` AS `nomePercorso`,count(0) AS `Tot`,`p`.`citta` AS `citta` from (`percorso` `p` join `preferiti` `pr`) where (`p`.`nomePercorso` = `pr`.`nomePercorso`) group by `p`.`nomePercorso` order by count(0) desc ;

-- --------------------------------------------------------


DROP TABLE IF EXISTS `statut`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `statut`  AS  select `u`.`username` AS `username`,count(0) AS `Tot` from (`utente` `u` join `attrattiva` `a`) where (`u`.`username` = `a`.`nomeInseritore`) group by `u`.`username` order by count(0) desc,`u`.`username` ;

-- ----------------------------------------------------------

ALTER TABLE `attivita`
  ADD PRIMARY KEY (`nome`);


ALTER TABLE `attrattiva`
  ADD PRIMARY KEY (`nome`);


ALTER TABLE `citta`
  ADD PRIMARY KEY (`nome`);


ALTER TABLE `commento`
  ADD PRIMARY KEY (`testo`),
  ADD KEY `idUtente` (`usernameUtente`),
  ADD KEY `idAttrattiva` (`nomeAttrattiva`);


ALTER TABLE `composizionepercorso`
  ADD PRIMARY KEY (`nomePercorso`,`nomeAttrattiva`);

ALTER TABLE `evento`
  ADD PRIMARY KEY (`nomeAttivita`,`titolo`);


ALTER TABLE `gestore`
  ADD PRIMARY KEY (`username`);


ALTER TABLE `messaggio`
  ADD PRIMARY KEY (`idMessaggio`,`titolo`);


ALTER TABLE `monumeto`
  ADD PRIMARY KEY (`nome`);



ALTER TABLE `partecipazioneevento`
  ADD PRIMARY KEY (`titoloEvento`,`nomeUtente`);


ALTER TABLE `percorso`
  ADD PRIMARY KEY (`nomePercorso`), 
  ADD KEY (`citta`);


ALTER TABLE `preferiti`
  ADD PRIMARY KEY (`nomePercorso`,`nomeUtente`);


ALTER TABLE `premium`
  ADD PRIMARY KEY (`username`);


ALTER TABLE `utente`
  ADD PRIMARY KEY (`username`),
  ADD KEY `residenza` (`residenza`);


