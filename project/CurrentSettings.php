<?php

if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}

# LOCAL DEV SETTINGS
#
# Profiling:
$wgProfileToDatabase = true;
$wgEnableProfileInfo = true; // See: http://docs.webplatform.local/w/profileinfo.php
#
# SMTP:
#  See to add http://www.mediawiki.org/wiki/Manual_talk:$wgSMTP

## All current wiki specific configuration goes into this file.
## In general, most configuration should go into test, then
## into the shared configuration. This should likely only have
## the database config, the upload location, and the script and
## article path.

#$wgDBssl = true;
$wgDBservers = array(
	array(
		'host' => "localhost",
		'dbname' => "wpwiki",
		'user' => "root",
		'password' => "",
		'type' => "mysql",
		'flags' => DBO_DEFAULT,
		'load' => 0,
	),
);
##
##
##
##
##
##    TRUNCATED
##
##
##
##
##

$wgScriptPath       = "/w";
$wgArticlePath = '/wiki/$1';
$wgDBname = "wpwiki";

#$wgUploadDirectory = "$IP/../images";
$wgUploadDirectory = "/srv/webplatform/wiki/images/";

##
## TRUNCATED
##

## Add shared configuration
require_once( "$IP/../Settings.php" );
