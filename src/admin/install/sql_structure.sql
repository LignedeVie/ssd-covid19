CREATE TABLE `ts_log` (
  `id` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `stempel` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ip` varchar(50) DEFAULT NULL,
  `sid` varchar(250) DEFAULT NULL,
  `apl` varchar(50) NOT NULL,
  `akt` char(1) DEFAULT NULL,
  `login` varchar(100) DEFAULT NULL,
  `port` int(11) DEFAULT NULL,
  `odp` varchar(100) DEFAULT NULL,
  `idsesji` varchar(100) DEFAULT NULL,
  `usr_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
ALTER TABLE `ts_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `akt` (`akt`),
  ADD KEY `login` (`login`),
  ADD KEY `stempel` (`stempel`),
  ADD KEY `ip` (`ip`),
  ADD KEY `usr_id` (`usr_id`);
ALTER TABLE `ts_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
CREATE TABLE `ts_sesje` (
  `id` int(11) NOT NULL,
  `ids` varchar(80) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `idd` varchar(50) DEFAULT NULL,
  `sid` varchar(250) DEFAULT NULL,
  `idsesji` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
ALTER TABLE `ts_sesje`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ids` (`ids`),
  ADD KEY `IDX_sesje_2` (`ids`),
  ADD KEY `IDX_sesje_3` (`ip`),
  ADD KEY `IDX_sesje_4` (`login`),
  ADD KEY `sid` (`sid`),
  ADD KEY `idsesji` (`idsesji`);
ALTER TABLE `ts_sesje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
CREATE TABLE `ts_users` (
  `id` int(11) NOT NULL,
  `login` varchar(80) NOT NULL,
  `haslo` varchar(80) NOT NULL,
  `rola` varchar(80) NOT NULL,
  `dodany` datetime NOT NULL,
  `stempel` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `stempel_kto` varchar(50) DEFAULT NULL,
  `grupa` varchar(50) DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `klasa` varchar(80) NOT NULL,
  `jednostka` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
ALTER TABLE `ts_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login_2` (`login`),
  ADD KEY `login` (`login`),
  ADD KEY `email` (`email`);
ALTER TABLE `ts_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;