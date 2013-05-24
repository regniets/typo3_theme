#
# Table structure for table 'pages'
#
CREATE TABLE pages (
	titletag text NOT NULL,
	cssattribute text NOT NULL,
	datum text NOT NULL
);

#
# Table structure for table 'pages_language_overlay'
#
CREATE TABLE pages_language_overlay (
	titletag text NOT NULL,
	cssattribute text NOT NULL,
	datum text NOT NULL
);

#
# Table structure for table 'typoscript_mapping'
#
CREATE TABLE typoscript_mapping (
    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    identifier varchar(255) DEFAULT '' NOT NULL,

    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid)
);

#
# Table structure for table 'be_users'
#
CREATE TABLE be_users (
	typoscript_mapping int(11) DEFAULT '0' NOT NULL
);

#
# Table structure for table 'be_groups'
#
CREATE TABLE be_groups (
	typoscript_mapping int(11) DEFAULT '0' NOT NULL
);