<?php
# debugging
#error_reporting( E_ALL );
#ini_set( 'display_errors', 1 );

# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
  exit;
}

## Uncomment this to disable output compression
# $wgDisableOutputCompression = true;

$wgSitename      = "[LOCAL] WebPlatform Docs";

$wgScriptExtension  = ".php";

## The protocol and server name to use in fully-qualified URLs
$wgServer           = "http://docs.webplatform.local";

## The relative URL path to the skins directory
$wgStylePath        = "$wgScriptPath/skins";

## The relative URL path to the logo.  Make sure you change this from the default,
## or else you'll overwrite your logo when you upgrade!
$wgLogo             = "/wpdlogo.png";

## UPO means: this is also a user preference option

$wgEnableEmail      = true;
$wgEnableUserEmail  = true; # UPO

$wgEmergencyContact = "root@localhost";
$wgPasswordSender   = "root@localhost";

$wgEnotifUserTalk      = true; # UPO
$wgEnotifWatchlist     = true; # UPO
$wgEmailAuthentication = true;
$wgEmailConfirmToEdit = true;

# MySQL specific settings
$wgDBprefix         = "";

# MySQL table options to use during installation or update
$wgDBTableOptions   = "ENGINE=InnoDB, DEFAULT CHARSET=binary";

# Experimental charset support for MySQL 5.0.
$wgDBmysql5 = false;

## To enable image uploads, make sure the 'images' directory
## is writable, then set this to true:
$wgEnableUploads  = true;
#$wgEnableUploads  = false;
$wgUseImageMagick = true;
$wgImageMagickConvertCommand = "/usr/bin/convert";

# InstantCommons allows wiki to use images from http://commons.wikimedia.org
$wgUseInstantCommons  = false;

## If you use ImageMagick (or any other shell command) on a
## Linux server, this will need to be set to the name of an
## available UTF-8 locale
$wgShellLocale = "en_US.utf8";

## If you want to use image uploads under safe mode,
## create the directories images/archive, images/thumb and
## images/temp, and make them all writable. Then uncomment
## this, if it's not already uncommented:
#$wgHashedUploadDirectory = false;

$wgFileExtensions = array( 'png', 'gif', 'jpg', 'jpeg', 'ppt', 'pdf', 'psd', 'mp3', 'xls', 'xlsx', 'swf', 'doc','docx', 'odt', 'odc', 'odp', 'odg', 'mpp', 'svg', 'svgz', 'ai', 'txt');

## Set $wgCacheDirectory to a writable directory on the web server
## to make your wiki go slightly faster. The directory should not
## be publically accessible from the web.
$wgCacheDirectory = "$IP/cache";

# Site language code, should be one of the list in ./languages/Names.php
$wgLanguageCode = "en";

$wgSecretKey = "NOTSOSECRETANYMORE1";

# Site upgrade key. Must be set to a string (default provided) to turn on the
# web installer while LocalSettings.php is in place
$wgUpgradeKey = "NOTSOSECRETANYMORE2";

## Default skin: you can change the default skin. Use the internal symbolic
## names, ie 'standard', 'nostalgia', 'cologneblue', 'monobook', 'vector':
$wgDefaultSkin = "webplatform";

## For attaching licensing metadata to pages, and displaying an
## appropriate copyright notice / icon. GNU Free Documentation
## License and Creative Commons licenses are supported so far.
## # Set to the title of a wiki page that describes your license/copyright
$wgRightsPage = "MediaWiki:Site-terms-of-service";
$wgRightsUrl  = "http://creativecommons.org/licenses/by/3.0/";
$wgRightsText = "Creative Commons Attribution license";
$wgRightsIcon = "{$wgStylePath}/common/images/cc-by.png";
$wgLicenseTerms = "MediaWiki:Site-terms-of-service";

# Path to the GNU diff3 utility. Used for conflict resolution.
$wgDiff3 = "/usr/bin/diff3";

# Query string length limit for ResourceLoader. You should only set this if
# your web server has a query string length limit (then set it to that limit),
# or if you have suhosin.get.max_value_length set in php.ini (then set it to
# that value)
$wgResourceLoaderMaxQueryLength = -1;

# The following permissions were set based on your choice in the installer
$wgGroupPermissions['*']['createaccount'] = true;
$wgGroupPermissions['*']['edit'] = false;

$wgShowIPinHeader = false;
$wgDisableCounters = true;

$wgAllowUserCss = true;
$wgAllowUserJs = true;

# Jobs are run by cron, disable jobs run via page requests
$wgJobRunRate = 0;

##
##
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
##
##
##
##

# Object cache (and session) settings
$wgObjectCaches['memcached-pecl'] = array(
  'class'      => 'MemcachedPeclBagOStuff',
  #'serializer' => 'igbinary',
  'servers'    => array(
    'localhost:11211',
    #'memcache2.dho.wpdn:11211',
  )
);

$wgMainCacheType = 'memcached-pecl';
$wgParserCacheType = 'memcached-pecl';
$wgMessageCacheType = 'memcached-pecl';
$wgMemCachedPersistent = false;
$wgUseMemCached = true;
$wgMemCachedTimeout = 250000;
$wgMemCachedInstanceSize = 3072;
$wgSessionCacheType = 'memcached-pecl';
$wgSessionsInObjectCache = true;

# Frontend cache settings
$wgUseSquid = true;
$wgSquidServers = array('api.fastly.com:80');

# Custom Namespaces
define("NS_WPD", 3000);
define("NS_WPD_TALK", 3001);
define("NS_STEWARDS", 3010);
define("NS_STEWARDS_TALK", 3011);
define("NS_META", 3020);
define("NS_META_TALK", 3021);

$wgExtraNamespaces[NS_WPD] = "WPD";
$wgExtraNamespaces[NS_WPD_TALK] = "WPD_talk";
$wgExtraNamespaces[NS_STEWARDS] = "Stewards";
$wgExtraNamespaces[NS_STEWARDS_TALK] = "Stewards_talk";
$wgExtraNamespaces[NS_META] = "Meta";
$wgExtraNamespaces[NS_META_TALK] = "Meta_talk";

# Subpages
$wgNamespacesWithSubpages[NS_MAIN] = true;
$wgNamespacesWithSubpages[NS_WPD] = true;
$wgNamespacesWithSubpages[NS_STEWARDS] = true;
$wgNamespacesWithSubpages[NS_META] = true;

$wgContentNamespaces = array (NS_MAIN, NS_WPD, NS_STEWARDS);
$wgContentNamespaces[] = NS_WPD;

# allow lowercase page titles
$wgCapitalLinks = false;

# Read Control - set to off until launch
$wgGroupPermissions['*']['read']    = true;
# Allow users to read the request account page, so they can request accounts
$wgWhitelistRead = array('Special:RequestAccount','Main Page');

# only show the page title, not parent pages
# $wgRestrictDisplayTitle = true;

# Favicon
$wgFavicon = "/favicon.ico";

# Ajax functionality
$wgUseAjax = true;
$wgAjaxWatch = true;

# Remove normal table of contents
# $wgDefaultUserOptions['showtoc'] = 0;

$wgCrossSiteAJAXdomains = '*';

##
##
##
##
##
##
##
##
##
##
##
##  TRUNCATED
##
##
##
##
##
##
##
##
##
##
##
##


# EventLogging
require_once("$IP/extensions/EventLogging/EventLogging.php");

# Piwik settings, but look at extensions/piwik/Piwik.php as it might
# need to be adjusted later --renoirb
$wgPiwikURL = "tracking.webplatform.org";
$wgPiwikIDSite = "1";

###################
# Extensions

require_once( "$IP/skins/webplatform/resourcemodules.php" );

# Piwik
require_once( "$IP/extensions/piwik/Piwik.php" );

require_once( "$IP/extensions/Renameuser/Renameuser.php" );

# Change title element
require_once( "$IP/extensions/TopicTitle/topictitle.php" );

# Syntax Highlighting Extension
require_once( "$IP/extensions/SyntaxHighlight_GeSHi/SyntaxHighlight_GeSHi.php" );
$wgSyntaxHighlightDefaultLang = "html5";

require_once( "$IP/extensions/Cite/Cite.php" );

require_once( "$IP/extensions/Vector/Vector.php" );
$wgDefaultUserOptions['vector-collapsiblenav'] = 1;
$wgVectorUseSimpleSearch = true;

require_once( "$IP/extensions/WikiEditor/WikiEditor.php" );
$wgDefaultUserOptions['usebetatoolbar'] = 1;
$wgDefaultUserOptions['usebetatoolbar-cgd'] = 1;
require_once( "$IP/extensions/Gadgets/Gadgets.php" );

require_once("$IP/extensions/CategoryTree/CategoryTree.php");

require_once( "$IP/extensions/ParserFunctions/ParserFunctions.php");

include_once("$IP/extensions/Validator/Validator.php");

include_once("$IP/extensions/SemanticMediaWiki/SemanticMediaWiki.php");
enableSemantics('webplatform');

# Semantic Forms Extension
include_once("$IP/extensions/SemanticForms/SemanticForms.php");
$sfgRenameEditTabs = true;

# SemanticResultFormats, an extra set of printers for SMW
require_once("$IP/extensions/SemanticResultFormats/SemanticResultFormats.php");

include_once("$IP/extensions/AdminLinks/AdminLinks.php");

# Article FeedBack Extension
#require_once( "$IP/extensions/PrefSwitch/PrefSwitch.php" );
#require_once( "$IP/extensions/SimpleSurvey/SimpleSurvey.php" );

#require_once( "$IP/extensions/UserDailyContribs/UserDailyContribs.php" );
#require_once( "$IP/extensions/ClickTracking/ClickTracking.php" );
require_once( "$IP/extensions/EmailCapture/EmailCapture.php" );
#require_once( "$IP/extensions/ArticleFeedbackv5/ArticleFeedbackv5.php" );


$wgArticleFeedbackLotteryOdds = 100; // Will turn on the voting on all pages
$wgArticleFeedbackNamespaces = array( NS_MAIN );
$wgArticleFeedbackDashboard = true;

# ConfirmAccount Extension
#require_once("$IP/extensions/ConfirmAccount/ConfirmAccount.php");
#$wgAccountRequestMinWords = 0;

# Captcha Extension
require_once( "$IP/extensions/ConfirmEdit/ConfirmEdit.php" );
$wgCaptchaTriggers['edit']          = false;
$wgCaptchaTriggers['create']        = false;
$wgCaptchaTriggers['addurl']        = false;
$wgCaptchaTriggers['createaccount'] = true;
$wgCaptchaTriggers['badlogin']      = false;
require_once( "$IP/extensions/ConfirmEdit/WpdCaptcha.php");
$wgCaptchaClass = 'WpdCaptcha';

# user blocking settings
$wgSysopRangeBans = false;


# nuke mass-delete extension
require_once("$IP/extensions/Nuke/Nuke.php");

# comments extension
require_once("$IP/extensions/Comments/Comment.php");
$wgCommentsEnabledNS = array( NS_MAIN );
require_once("$IP/extensions/WebplatformSectionCommentsSMW/WebplatformSectionCommentsSMW.php");

##
##
##
##
##
##
##  TRUNCATED
##
##
##
##
##
##

$wgWebPlatformAuthSecret = "NOTSOSECRETANYMORE3";

require_once( "$IP/extensions/WebPlatformSearchAutocomplete/WebPlatformSearchAutocomplete.php" );

# subpagelist extension
require_once("$IP/extensions/SubPageList/SubPageList.php");

# DismissableSiteNotice extension
require_once( "$IP/extensions/DismissableSiteNotice/DismissableSiteNotice.php" );


# Semantic_Internal_Objects extension
include_once("$IP/extensions/SemanticInternalObjects/SemanticInternalObjects.php");

# Replace_Text extension
require_once( "$IP/extensions/ReplaceText/ReplaceText.php" );

# StringFunctionsEscaped extension
require_once("$IP/extensions/ParserFunctions/ParserFunctions.php");
$wgPFEnableStringFunctions = true;  // Note: this must be after ParserFunctions and before StringFunctionsEscaped
require_once("$IP/extensions/StringFunctionsEscaped/StringFunctionsEscaped.php");

# testing breadcrumbmenus
require_once( "$IP/extensions/BreadcrumbMenus/breadcrumbmenus.php" );

# Social Profile extension
require_once("$IP/extensions/SocialProfile/SocialProfile.php");
$wgUserProfileDisplay['friends'] = true;
$wgUserProfileDisplay['foes'] = false;


# NewSignupPage extension, for agreeing to site terms
require_once("$IP/extensions/NewSignupPage/NewSignupPage.php");
$wgRegisterTrack = true;
$wgUserStatsPointValues['referral_complete'] = 10;
$wgAutoAddFriendOnInvite = true;
$wgForceNewSignupPageInitialization = true;

# table of contents extension
# require_once("$IP/extensions/CustomTOC/customtoc.php");

# extension to suppress TOC
require_once("$IP/extensions/NoTOC/NoTOC.php");

# EditSection icon extension
require_once("$IP/extensions/EditSectionIcon/editsectionicon.php");

# CLDR extension, for local language names
require_once( "$IP/extensions/cldr/cldr.php" );

# Narayam extension, for extra input methods
require_once("$IP/extensions/Narayam/Narayam.php");

# compatibily table extension
require_once("$IP/extensions/CompaTables/compatables.php");
$wgCompatablesJsonFileUrl = 'http://docs.webplatform.local/compat/data.json';
$wgCompatablesUseESI = true;

# lookup users
require_once( "$IP/extensions/LookupUser/LookupUser.php" );
// Who can use Special:LookupUser?
// If you want that sysops can use it:
$wgGroupPermissions['*']['lookupuser'] = false;
$wgGroupPermissions['sysop']['lookupuser'] = true;

##
##
##
##
##
##
##
##
##
##     TRUNCATED
##
##
##
##
##
##
##
##
##
##
##
##
##

require_once( "$IP/extensions/AbuseFilter/AbuseFilter.php" );
$wgGroupPermissions['sysop']['abusefilter-modify'] = true;
$wgGroupPermissions['*']['abusefilter-log-detail'] = true;
$wgGroupPermissions['*']['abusefilter-view'] = true;
$wgGroupPermissions['*']['abusefilter-log'] = true;
$wgGroupPermissions['sysop']['abusefilter-private'] = true;
$wgGroupPermissions['sysop']['abusefilter-modify-restricted'] = true;
$wgGroupPermissions['sysop']['abusefilter-revert'] = true;

# only allow seasoned and confirmed editors to create pages
$wgGroupPermissions['*']['createpage'] = false;
$wgGroupPermissions['user']['createpage'] = false;
$wgGroupPermissions['autoconfirmed']['createpage'] = true;
$wgAutoConfirmAge = 1 * 3600 * 24;   // one day
$wgAutoConfirmCount = 10;

## Uncomment the following line to disable account creation
#$wgGroupPermissions['*']['createaccount'] = false;
## Uncomment the following line to enable read-only mode
#$wgReadOnly = 'Disallowing writes for site maintenance';
$wgShowExceptionDetails = true;
$wgMemCachedDebug = true;

$wgRCMaxAge = 365*24*3600;  # 10 years
