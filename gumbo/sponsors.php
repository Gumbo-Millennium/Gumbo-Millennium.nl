<?php
	/**
	*
	* @package phpBB3
	* @version $Id$
	* @copyright (c) 2005 phpBB Group
	* @license http://opensource.org/licenses/gpl-license.php GNU Public License
	*
	*/

	/**
	*/

	/**
	* @ignore
	*/
	define('IN_PHPBB', true);
	$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './../';
	$phpEx = substr(strrchr(__FILE__, '.'), 1);
	include($phpbb_root_path . 'common.' . $phpEx);
	include($phpbb_root_path . 'includes/bbcode.' . $phpEx);
	include_once($phpbb_root_path . 'includes/functions_display.' . $phpEx);

	// Start session management
	$user->session_begin();
	$auth->acl($user->data);
	$user->setup('viewforum');
	
	// Get the page content and title
	$sql = 'SELECT * FROM ' . POSTS_TABLE . ' AS p WHERE post_id = 27';

	$result = $db->sql_query_limit($sql, 1);
	$row = $db->sql_fetchrow($result);
	
	$options = 	($row['enable_bbcode'] ? OPTION_FLAG_BBCODE : 0) +
				($row['enable_smilies'] ? OPTION_FLAG_SMILIES : 0) + 
				($row['enable_magic_url'] ? OPTION_FLAG_LINKS : 0);
	
	$message = generate_text_for_display($row['post_text'], $row['bbcode_uid'], $row['bbcode_bitfield'], $options);
	
	$image_links = array();
	if(preg_match_all('/<img[^>]+src="([^"]*)"[^>]+>/i', $message, $images))
	{	
		foreach($images[1] as $image)
		{	
			$image_links[$image] = false;
		}
	}

	if(preg_match_all('#<a[^>]+href="([^>^"]*)"[^>]+>(.*?)</a>#i', $message, $links))
	{	
		foreach($links[2] as $index => $innerhtml)
		{	
			if(preg_match_all('/<img[^>]+src="([^>^"]*)"[^>]+>/i', $innerhtml, $images))
			{	
				foreach($images[1] as $image)
				{	
					$image_links[$image] = $links[1][$index];
				}
			}
		}
	}
	
	foreach($image_links as $image => $link)
	{	
		$template->assign_block_vars('sponsors', array(
			'IMAGE' => $image,
			'LINK' => $link
		));
	}
	
	//$template->assign_var('MESSAGE_TEXT', $message);
	
	$db->sql_freeresult($result);
	
	// Add the title/breadcrumbs bar
	$template->assign_vars(array(
		'PAGE_TITLE_BOX_HIDE'	=> false
	));
	
	// Set the breadcrumbs
	$template->assign_block_vars('navlinks', array(
		'FORUM_NAME'		=> $user->lang['OVER_ONS'],
		'U_VIEW_FORUM'		=> append_sid("{$phpbb_root_path}gumbo/over_ons.$phpEx" )) //The path to the custom file relative to the phpbb root path.            
	);
	
	$template->assign_block_vars('navlinks', array(
		'FORUM_NAME'		=> $user->lang['SPONSOR'],
		'U_VIEW_FORUM'		=> append_sid("{$phpbb_root_path}gumbo/sponsors.$phpEx" )) //The path to the custom file relative to the phpbb root path.            
	);
	
	// Output page
	page_header($user->lang['SPONSOR']);
	
	$template->set_filenames(array(
		'body' => 'sponsors.html')
	);

	page_footer();

?>