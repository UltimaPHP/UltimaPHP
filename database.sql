CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(9) NOT NULL,
  `account` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `maxchars` tinyint(1) NOT NULL DEFAULT '5',
  `creation_date` datetime NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `plevel` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `accounts` (`id`, `account`, `password`, `maxchars`, `creation_date`, `last_login`, `plevel`, `status`) VALUES
(1, 'test', '098f6bcd4621d373cade4e832627b4f6', 5, '2015-08-16 02:41:25', NULL, 7, 1),
(2, 'test2', '098f6bcd4621d373cade4e832627b4f6', 5, '2015-08-16 02:41:25', NULL, 7, 1);

CREATE TABLE IF NOT EXISTS `players` (
  `id` int(9) NOT NULL,
  `account` int(9) NOT NULL,
  `name` varchar(255) NOT NULL,
  `body` varchar(20) NOT NULL,
  `color` varchar(8) NOT NULL DEFAULT '0',
  `sex` tinyint(1) NOT NULL DEFAULT '1',
  `race` tinyint(1) NOT NULL DEFAULT '1',
  `position` varchar(15) NOT NULL,
  `hits` int(4) NOT NULL DEFAULT '1',
  `maxhits` int(11) NOT NULL DEFAULT '4',
  `mana` int(4) NOT NULL DEFAULT '1',
  `maxmana` int(4) NOT NULL DEFAULT '1',
  `stam` int(4) NOT NULL DEFAULT '1',
  `maxstam` int(4) NOT NULL DEFAULT '1',
  `str` float(4,1) NOT NULL,
  `maxstr` float(4,1) NOT NULL,
  `int` float(4,1) NOT NULL,
  `maxint` float(4,1) NOT NULL,
  `dex` float(4,1) NOT NULL,
  `maxdex` float(4,1) NOT NULL,
  `statscap` int(4) DEFAULT NULL,
  `pets` int(4) NOT NULL DEFAULT '0',
  `maxpets` int(4) NOT NULL DEFAULT '5',
  `resist_fire` int(4) NOT NULL DEFAULT '0',
  `resist_cold` int(4) NOT NULL DEFAULT '0',
  `resist_poison` int(4) NOT NULL DEFAULT '0',
  `resist_energy` int(4) NOT NULL DEFAULT '0',
  `luck` int(4) NOT NULL DEFAULT '0',
  `damage_min` int(4) NOT NULL DEFAULT '0',
  `damage_max` int(4) NOT NULL DEFAULT '0',
  `karma` int(10) NOT NULL DEFAULT '0',
  `fame` int(10) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `players` (`id`, `account`, `name`, `body`, `color`, `sex`, `race`, `position`, `hits`, `maxhits`, `mana`, `maxmana`, `stam`, `maxstam`, `str`, `maxstr`, `int`, `maxint`, `dex`, `maxdex`, `statscap`, `pets`, `maxpets`, `resist_fire`, `resist_cold`, `resist_poison`, `resist_energy`, `luck`, `damage_min`, `damage_max`, `karma`, `fame`, `title`) VALUES
(1, 1, 'Owner test', '400', '33770', 0, 0, '1000,1000,0,0', 100, 100, 100, 100, 100, 100, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 225, 0, 5, 0, 0, 0, 0, 28, 10, 10, 10000, 10000, 'Shard Owner'),
(2, 2, 'Player test', '401', '33770', 1, 0, '1000,1003,0,0', 100, 100, 100, 100, 100, 100, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, NULL, 0, 5, 0, 0, 0, 0, 0, 0, 0, 10000, 10000, NULL);

CREATE TABLE IF NOT EXISTS `starting_locations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `position` varchar(15) NOT NULL,
  `clioc` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO `starting_locations` (`id`, `name`, `area`, `position`, `clioc`) VALUES
(1, 'Yew', 'The Sturdy Bow', '567,978,0,0', 1075072),
(2, 'Minoc', 'The Barnacle Tavern', '2477,407,15,0', 1075073),
(3, 'Britain', 'Sweet Dreams Inn', '1496,1629,10,0', 1075074),
(4, 'Moonglow', 'The Scholars Inn', '4404,1169,0,0', 1075075),
(5, 'Trinsic', 'The Traveller''s Inn', '1844,2745,0,0', 1075076),
(6, 'New Magincia', 'The Great Horns Tavern', '3738,2223,20,0', 1075077),
(7, 'Jhelom', 'The Morning Star Inn', '1378,3817,0,0', 1075078),
(8, 'Skara Brae', 'The Falconers Inn', '594,2227,0,0', 1075079),
(9, 'Vesper', 'The Ironwood Inn', '2271,977,0,0', 1075080);

ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `players`
  ADD PRIMARY KEY (`id`), ADD KEY `idx_account` (`account`);

ALTER TABLE `starting_locations`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `accounts`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;

ALTER TABLE `players`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;

ALTER TABLE `starting_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
  
ALTER TABLE `players`
ADD CONSTRAINT `fk_account` FOREIGN KEY (`account`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;