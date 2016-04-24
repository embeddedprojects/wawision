CREATE TABLE `user` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(100) default NULL,
  `password` varchar(255) default NULL,
  `description` varchar(255) default NULL,
  `settings` text NOT NULL,
  `parentuser` int(11) default NULL,
  `activ` int(11) default '0',
  `type` varchar(100) default '',
  `person` int(20) NOT NULL,
PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1000 ;


CREATE TABLE `useronline` (
  `user_id` int(5) NOT NULL default '0',
  `login` int(1) NOT NULL default '0',
  `sessionid` varchar(255) NOT NULL default '',
  `ip` varchar(200) NOT NULL default '',
  `time` datetime NOT NULL default '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

