<?php
/**
*
* @package phpBB3
* @version $Id$
* @author: Gerco Versloot
* @date: 6 - 8 - 2012
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @Gumbo Millennium
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
    exit;
}

if (empty($lang) || !is_array($lang))
{
    $lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine


// Adding the trancelation
// user side
$lang = array_merge($lang, array(
    'SPONSOR'           => 'Sponsors',
    'PLAZACAM'          => 'Plaza CAM', 
    'OVER_ONS'          => 'About Gumbo',
    'SOCIETEIT'         => 'Society',
    'CONTACT'           => 'Contact',
    'BOARD_OF_DIRECTORS'=> 'The Daily Board',
    'AC'                => 'The Activity Commission',
    'BC'                => 'The Bras Commission',
    'DC'                => 'De Digital Commission',
    'KC'                => 'De Kas Commission',
    'SC'                => 'De Soos Commission',
    'GC'                => 'De Gumbode Commission',
    'PC'                => 'De Plaza Commission',
    'IB'                => 'The Intro Board',
    'NICKNAME'          => 'Nickname',
    'REALNAME'          => 'Real Name',
    'STORY'             => 'The Story',
    'ONDERSCHRIFT'      => 'Subtitle',
    'EVENTS'            => 'Events',
    'EVENTS_ACP'        => 'Events Management',
    'GUMBO_MEMBERS'     => 'Gumbo Members',
    'NON_MEMBERS'       => 'Non-Members',
    'WHY_GUMBO'         => 'Why Gumbo?',
    'DISPUTES'          => 'Disputes',
    
    'EQUESTER'          => 'Equester',
    'M-POWER'           => 'M-Power',
    'PROXIMUS'          => 'Proximus',
    'ALIQUANDO'         => 'Aliquando',
    'COMMISSION'        => 'Commission',

    'BOARD_HISTORY'     => 'Board History',
    'NEWS_AND_EVENTS'   => 'News and Events',
    'NEWS'              => 'News',
    'RECENT_NEWS'       => 'Recent News',
    'ARCHIVE_NEWS'      => 'Archive News',
    'GUMBODES'          => 'Gumbodes',
    'PICTURES'          => 'Pictures',
    'DOC_SYSTEM'        => 'Document System',
    'SHOP'              => 'Shop',
    'FORUM_SUBSCRIBED'  => 'Subscribed Forum Treads',
    'MEMBER_PANELS'     => 'Member Panels',

    'FORUM_UNREAD_POSTS'    => 'Unread Posts', 
    'FORUM_BOOKMARKS'       => 'Bookmarks', 
    'UCP_OVERVIEW'          => 'Overview', 
    'UCP_PROFILE'           => 'Profile', 
    'UCP_PREFS'             => 'Board Preferences', 
    'UCP_USERGROUPS'        => 'Usergroups', 
    'UCP_ZEBRA_FOES'        => 'Friends and Foes', 
    'MCP_CONTROL_PANEL'     => 'Control Panel', 
    'MCP_QUEUE'             => 'Queue', 
    'MCP_REPORTS'           => 'Report', 
    'MCP_NOTES'             => 'User Notes', 
    'MCP_WARN'              => 'Warnings', 
    'MCP_LOGS'              => 'Moderators Log', 
    'MCP_BAN'               => 'Banning', 

    'BACK'                  => 'Back', 
    'NAVIGATION'            => 'Navigation', 
    'GO_TO_NEWS'            => 'Jump to News', 
    'NEWS_AVAILABLE_TITLE'  => 'There is currently no news', 
    'NEWS_AVAILABLE_TEXT'   => 'Try again on a later date or time', 

    'PIC_INVALID_YEAR'      => '%d is an invalided year or there are no pictures from that year',

));

?>
