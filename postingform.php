<?php
/**
*
* @package phpBB3
* @version $Id: ppostingform.php AscraeusFrance $
* @copyright (c) 2015 AscraeusFrance ( http://www.ascraeus-france.fr )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
*/

/**
* @ignore
*/
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

$user->session_begin();
$auth->acl($user->data);

// Starting language keys loading
$user->setup('mods/postingform');

// Starting some vars
$select_forum_id		= request_var('select_forum_id', 0);

// Starting forums list
	$sql_forums_list = 'SELECT forum_id, forum_name, forum_type, forum_status, left_id, right_id
	FROM ' . FORUMS_TABLE . '
	WHERE forum_status = ' . ITEM_UNLOCKED . '
	ORDER BY left_id';
	
	$result_forums_list = $db->sql_query($sql_forums_list);
	
	$forums_list = array();
	while ($row = $db->sql_fetchrow($result_forums_list))
	{

		$template->assign_vars(array(
			'S_FORUM_ID'	=> (!$select_forum_id) ? false : true,
			'S_FORUMS_LIST'	=> (!$row) ? false : true,
		));
		
		$template->assign_block_vars('forums_list', array(
			'FORUM_ID'		=> $row['forum_id'],
			'FORUM_NAME'	=> $row['forum_name'],
			'SELECTED'		=> ($row['forum_id'] == $select_forum_id) ? ' selected="selected"' : '',
			'S_IS_CAT'		=> ($row['forum_type'] == FORUM_CAT) ? true : false,
			'S_IS_LINK'		=> ($row['forum_type'] == FORUM_LINK) ? true : false,
			'S_IS_POST'		=> ($row['forum_type'] == FORUM_POST) ? true : false,
		));
    }
	$db->sql_freeresult($result_forums_list);
	
// Starting topics list


// Starting topic/post title


// Starting time publication


// Starting members list


// Starting form submission


// Starting some assign_vars()


// Output page
page_header($user->lang['POSTING_FORM']);


// Starting our template page loading
$template->set_filenames(array(
	'body' => 'mods/postingform_body.html',
	)
);

page_footer();

?>