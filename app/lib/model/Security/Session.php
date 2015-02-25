<?php
namespace App\Model\Security;

/**
 * Description of Session
 *
 * @author KuBik
 */
class Session {
	//put your code here
}
/*
 
--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `sid` varchar(32) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `user_id` int(5) NOT NULL DEFAULT '0',
  `login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_response` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `usr_link` varchar(20) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `session`
--
ALTER TABLE `session`
 ADD PRIMARY KEY (`sid`), ADD KEY `user_id` (`user_id`), ADD KEY `sid` (`sid`);

 */