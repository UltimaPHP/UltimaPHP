CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(9) NOT NULL,
  `account` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `maxchars` tinyint(1) NOT NULL DEFAULT '5',
  `creation_date` datetime NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `plevel` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `accounts`
--

INSERT INTO `accounts` (`id`, `account`, `password`, `maxchars`, `creation_date`, `last_login`, `plevel`, `status`) VALUES
(1, 'test', '098f6bcd4621d373cade4e832627b4f6', 5, '2015-08-16 02:41:25', NULL, 7, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `players`
--

CREATE TABLE IF NOT EXISTS `players` (
  `id` int(9) NOT NULL,
  `account` int(9) NOT NULL,
  `name` varchar(255) NOT NULL,
  `body` varchar(20) NOT NULL,
  `position` varchar(15) NOT NULL,
  `str` float(4,1) NOT NULL,
  `maxstr` float(4,1) NOT NULL,
  `int` float(4,1) NOT NULL,
  `maxint` float(4,1) NOT NULL,
  `dex` float(4,1) NOT NULL,
  `maxdex` float(4,1) NOT NULL,
  `karma` int(10) NOT NULL DEFAULT '0',
  `fame` int(10) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `players`
--

INSERT INTO `players` (`id`, `account`, `name`, `body`, `position`, `str`, `maxstr`, `int`, `maxint`, `dex`, `maxdex`, `karma`, `fame`, `title`) VALUES
(1, 1, 'Owner test', '987', '1000,1000,0,0', 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 10000, 10000, 'Shard Owner'),
(2, 1, 'Player test', '987', '1000,1000,0,0', 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 10000, 10000, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `starting_locations`
--

CREATE TABLE IF NOT EXISTS `starting_locations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `position` varchar(15) NOT NULL,
  `clioc` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `starting_locations`
--

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`), ADD KEY `idx_account` (`account`);

--
-- Indexes for table `starting_locations`
--
ALTER TABLE `starting_locations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `starting_locations`
--
ALTER TABLE `starting_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `players`
--
ALTER TABLE `players`
ADD CONSTRAINT `fk_account` FOREIGN KEY (`account`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;