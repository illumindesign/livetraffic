
--
-- Table structure for table `livetraffic`
--

CREATE TABLE `livetraffic` (
  `id` int(11) NOT NULL,
  `session` int(10) NOT NULL DEFAULT '0',
  `site` varchar(64) NOT NULL DEFAULT '',
  `type` varchar(8) NOT NULL DEFAULT '',
  `country` varchar(2) NOT NULL DEFAULT '',
  `ip` varchar(15) NOT NULL DEFAULT '',
  `browser` varchar(255) DEFAULT NULL,
  `resolution` varchar(11) NOT NULL DEFAULT '',
  `language` varchar(16) NOT NULL DEFAULT '',
  `flashver` varchar(8) NOT NULL DEFAULT '',
  `page` varchar(64) NOT NULL DEFAULT '',
  `time` int(5) NOT NULL DEFAULT '0',
  `date` int(11) NOT NULL DEFAULT '0',
  `update` int(11) NOT NULL DEFAULT '0',
  `mobile` int(1) NOT NULL DEFAULT '0',
  `bot` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for table `livetraffic`
--
ALTER TABLE `livetraffic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`site`),
  ADD KEY `ip` (`ip`),
  ADD KEY `session` (`session`),
  ADD KEY `mobile` (`mobile`),
  ADD KEY `bot` (`bot`);

--
-- AUTO_INCREMENT for table `livetraffic`
--
ALTER TABLE `livetraffic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
