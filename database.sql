CREATE TABLE `accounts` (
  `id` int(9) NOT NULL,
  `account` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `maxchars` tinyint(1) NOT NULL DEFAULT '5',
  `creation_date` datetime NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `plevel` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `accounts` (`id`, `account`, `password`, `maxchars`, `creation_date`, `last_login`, `plevel`, `status`) VALUES
(1, 'test', '098f6bcd4621d373cade4e832627b4f6', 5, '2015-08-16 02:41:25', NULL, 7, 1),
(2, 'test2', '098f6bcd4621d373cade4e832627b4f6', 5, '2015-08-16 02:41:25', NULL, 1, 1);

CREATE TABLE `players` (
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
  `str` int(4) NOT NULL,
  `maxstr` int(4) NOT NULL,
  `int` int(4) NOT NULL,
  `maxint` int(4) NOT NULL,
  `dex` int(4) NOT NULL,
  `maxdex` int(4) NOT NULL,
  `statscap` int(4) DEFAULT NULL,
  `pets` int(4) NOT NULL DEFAULT '0',
  `maxpets` int(4) NOT NULL DEFAULT '5',
  `resist_physical` int(4) NOT NULL DEFAULT '0',
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `players` (`id`, `account`, `name`, `body`, `color`, `sex`, `race`, `position`, `hits`, `maxhits`, `mana`, `maxmana`, `stam`, `maxstam`, `str`, `maxstr`, `int`, `maxint`, `dex`, `maxdex`, `statscap`, `pets`, `maxpets`, `resist_physical`, `resist_fire`, `resist_cold`, `resist_poison`, `resist_energy`, `luck`, `damage_min`, `damage_max`, `karma`, `fame`, `title`) VALUES
(1, 1, 'Owner test', '400', '33770', 0, 0, '1000,1000,0,0', 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 300, 0, 5, 0, 0, 0, 0, 0, 0, 0, 0, 10000, 10000, 'Shard Owner'),
(2, 2, 'Player test', '401', '33770', 1, 0, '1000,1003,0,0', 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 225, 0, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Adventurer');

CREATE TABLE `players_skills` (
  `id` int(11) NOT NULL,
  `player` int(11) NOT NULL,
  `alchemy` float(4,1) NOT NULL DEFAULT '0.0',
  `anatomy` float(4,1) NOT NULL DEFAULT '0.0',
  `animallore` float(4,1) NOT NULL DEFAULT '0.0',
  `itemid` float(4,1) NOT NULL DEFAULT '0.0',
  `armslore` float(4,1) NOT NULL DEFAULT '0.0',
  `parrying` float(4,1) NOT NULL DEFAULT '0.0',
  `begging` float(4,1) NOT NULL DEFAULT '0.0',
  `blacksmithing` float(4,1) NOT NULL DEFAULT '0.0',
  `bowcraft` float(4,1) NOT NULL DEFAULT '0.0',
  `peacemaking` float(4,1) NOT NULL DEFAULT '0.0',
  `camping` float(4,1) NOT NULL DEFAULT '0.0',
  `carpentry` float(4,1) NOT NULL DEFAULT '0.0',
  `cartography` float(4,1) NOT NULL DEFAULT '0.0',
  `cooking` float(4,1) NOT NULL DEFAULT '0.0',
  `detectinghidden` float(4,1) NOT NULL DEFAULT '0.0',
  `discordance` float(4,1) NOT NULL DEFAULT '0.0',
  `evaluatingintel` float(4,1) NOT NULL DEFAULT '0.0',
  `healing` float(4,1) NOT NULL DEFAULT '0.0',
  `fishing` float(4,1) NOT NULL DEFAULT '0.0',
  `forensics` float(4,1) NOT NULL DEFAULT '0.0',
  `herding` float(4,1) NOT NULL DEFAULT '0.0',
  `hiding` float(4,1) NOT NULL DEFAULT '0.0',
  `provocation` float(4,1) NOT NULL DEFAULT '0.0',
  `inscription` float(4,1) NOT NULL DEFAULT '0.0',
  `lockpicking` float(4,1) NOT NULL DEFAULT '0.0',
  `magery` float(4,1) NOT NULL DEFAULT '0.0',
  `magicresistance` float(4,1) NOT NULL DEFAULT '0.0',
  `tactics` float(4,1) NOT NULL DEFAULT '0.0',
  `snooping` float(4,1) NOT NULL DEFAULT '0.0',
  `musicianship` float(4,1) NOT NULL DEFAULT '0.0',
  `poisoning` float(4,1) NOT NULL DEFAULT '0.0',
  `archery` float(4,1) NOT NULL DEFAULT '0.0',
  `spiritspeak` float(4,1) NOT NULL DEFAULT '0.0',
  `stealing` float(4,1) NOT NULL DEFAULT '0.0',
  `tailoring` float(4,1) NOT NULL DEFAULT '0.0',
  `taming` float(4,1) NOT NULL DEFAULT '0.0',
  `tasteid` float(4,1) NOT NULL DEFAULT '0.0',
  `tinkering` float(4,1) NOT NULL DEFAULT '0.0',
  `tracking` float(4,1) NOT NULL DEFAULT '0.0',
  `veterinary` float(4,1) NOT NULL DEFAULT '0.0',
  `swordsmanship` float(4,1) NOT NULL DEFAULT '0.0',
  `macefighting` float(4,1) NOT NULL DEFAULT '0.0',
  `fencing` float(4,1) NOT NULL DEFAULT '0.0',
  `wrestling` float(4,1) NOT NULL DEFAULT '0.0',
  `lumberjacking` float(4,1) NOT NULL DEFAULT '0.0',
  `mining` float(4,1) NOT NULL DEFAULT '0.0',
  `meditation` float(4,1) NOT NULL DEFAULT '0.0',
  `stealth` float(4,1) NOT NULL DEFAULT '0.0',
  `removetraps` float(4,1) NOT NULL DEFAULT '0.0',
  `necromancy` float(4,1) NOT NULL DEFAULT '0.0',
  `focus` float(4,1) NOT NULL DEFAULT '0.0',
  `chivalry` float(4,1) NOT NULL DEFAULT '0.0',
  `bushido` float(4,1) NOT NULL DEFAULT '0.0',
  `ninjitsu` float(4,1) NOT NULL DEFAULT '0.0',
  `spellweaving` float(4,1) NOT NULL DEFAULT '0.0',
  `mysticism` float(4,1) NOT NULL DEFAULT '0.0',
  `imbuing` float(4,1) NOT NULL DEFAULT '0.0',
  `throwing` float(4,1) NOT NULL DEFAULT '0.0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `players_skills` (`id`, `player`, `alchemy`, `anatomy`, `animallore`, `itemid`, `armslore`, `parrying`, `begging`, `blacksmithing`, `bowcraft`, `peacemaking`, `camping`, `carpentry`, `cartography`, `cooking`, `detectinghidden`, `discordance`, `evaluatingintel`, `healing`, `fishing`, `forensics`, `herding`, `hiding`, `provocation`, `inscription`, `lockpicking`, `magery`, `magicresistance`, `tactics`, `snooping`, `musicianship`, `poisoning`, `archery`, `spiritspeak`, `stealing`, `tailoring`, `taming`, `tasteid`, `tinkering`, `tracking`, `veterinary`, `swordsmanship`, `macefighting`, `fencing`, `wrestling`, `lumberjacking`, `mining`, `meditation`, `stealth`, `removetraps`, `necromancy`, `focus`, `chivalry`, `bushido`, `ninjitsu`, `spellweaving`, `mysticism`, `imbuing`, `throwing`) VALUES
(1, 1, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0),
(2, 2, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0, 10.0);

CREATE TABLE `starting_locations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `position` varchar(15) NOT NULL,
  `clioc` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `starting_locations` (`id`, `name`, `area`, `position`, `clioc`) VALUES
(1, 'Yew', 'The Sturdy Bow', '567,978,0,0', 1075072),
(2, 'Minoc', 'The Barnacle Tavern', '2477,407,15,0', 1075073),
(3, 'Britain', 'Sweet Dreams Inn', '1496,1629,10,0', 1075074),
(4, 'Moonglow', 'The Scholars Inn', '4404,1169,0,0', 1075075),
(5, 'Trinsic', 'The Traveller\'s Inn', '1844,2745,0,0', 1075076),
(6, 'New Magincia', 'The Great Horns Tavern', '3738,2223,20,0', 1075077),
(7, 'Jhelom', 'The Morning Star Inn', '1378,3817,0,0', 1075078),
(8, 'Skara Brae', 'The Falconers Inn', '594,2227,0,0', 1075079),
(9, 'Vesper', 'The Ironwood Inn', '2271,977,0,0', 1075080);

ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `players`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_account` (`account`);

ALTER TABLE `players_skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `player` (`player`);

ALTER TABLE `starting_locations`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `accounts`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `players`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `players_skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `starting_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `players`
  ADD CONSTRAINT `fk_account` FOREIGN KEY (`account`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `players_skills`
  ADD CONSTRAINT `players_skills_ibfk_1` FOREIGN KEY (`player`) REFERENCES `players` (`id`);