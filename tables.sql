CREATE DATABASE IF NOT EXISTS `organizational_chart` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `organizational_chart`;

CREATE TABLE `node_tree`
(
    `idNode` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `level`  int(11) unsigned NOT NULL,
    `iLeft`  int(11) unsigned NOT NULL,
    `iRight` int(11) unsigned NOT NULL,
    PRIMARY KEY (`idNode`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

CREATE TABLE `node_tree_names`
(
    `idNode`   int(11) unsigned NOT NULL,
    `language` enum('english','italian') NOT NULL DEFAULT 'english',
    `nodeName` varchar(75) NOT NULL DEFAULT '',
    KEY        `language` (`language`),
    KEY        `nodeName` (`nodeName`),
    KEY        `idNode` (`idNode`),
    CONSTRAINT `node_tree_names_ibfk_1` FOREIGN KEY (`idNode`) REFERENCES `node_tree` (`idNode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
