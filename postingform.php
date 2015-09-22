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
$select_post_type		= request_var('select_post_type', 0);
$select_topic_id		= request_var('select_topic_id', 0);
$select_post_title 		= utf8_normalize_nfc(request_var('select_post_title', '', true));
$select_message 		= utf8_normalize_nfc(request_var('select_message', '', true));

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
			'S_FORUMS_LIST'	=> ($row) ? true : false,
		));
		
		$template->assign_block_vars('forums_list', array(
			'FORUM_ID'			=> $row['forum_id'],
			'FORUM_NAME'		=> $row['forum_name'],
			'FORUM_SELECTED'	=> ($row['forum_id'] == $select_forum_id) ? ' selected="selected"' : '',
			'S_IS_CAT'			=> ($row['forum_type'] == FORUM_CAT) ? true : false,
			'S_IS_LINK'			=> ($row['forum_type'] == FORUM_LINK) ? true : false,
			'S_IS_POST'			=> ($row['forum_type'] == FORUM_POST) ? true : false,
		));
    }
	$db->sql_freeresult($result_forums_list);
	
// Starting topics list
	if ($select_forum_id) // Only if a forum was selected
	{
		$sql_topics_list = 'SELECT topic_id, forum_id, topic_title, topic_time, topic_poster
		FROM ' . TOPICS_TABLE . '
		WHERE forum_id = ' . $select_forum_id;

		$result_topics_list = $db->sql_query($sql_topics_list);
		
		$topics_list = array();
		while ($row = $db->sql_fetchrow($result_topics_list))
		{
			$template->assign_vars(array(
				'S_TOPICS_LIST'	=> ($row) ? true : false,
			));
			
			$template->assign_block_vars('topics_list', array(
				'TOPIC_ID'			=> $row['topic_id'],
				'TOPIC_TITLE'		=> $row['topic_title'],
				'TOPIC_SELECTED'	=> ($row['topic_id'] == $select_topic_id) ? ' checked="checked"' : '',
			));
		}
		$db->sql_freeresult($result_topics_list);
	}

// Starting topic/post title
	if ($select_post_type == 1)
	{	
		$findme = 'Re: ';
		$pos = strpos($select_post_title, $findme);
		
			if ($pos !== FALSE)
			{
				$select_post_title = '';
			}
			else
			{
				$select_post_title = $select_post_title;
			}	
	}
	else
	{
			if (!$select_topic_id)
			{
				$select_post_title = '';
			}
			else
			{
				$sql = 'SELECT topic_id, topic_title
					FROM ' . TOPICS_TABLE . '
					WHERE topic_id = ' . $select_topic_id;
				$result = $db->sql_query_limit($sql, 1);
				$row_topic = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);
			
				$select_post_title = 'Re: ' . $row_topic['topic_title'];
			}	
	}

// Starting time publication


// Starting members list


// Starting form submission


// Starting some assign_vars()

		
// Output page
page_header($user->lang['POSTING_FORM_TITLE']);

// Some vars
		$template->assign_vars(array(
			'S_FORUM_ID'	=> ($select_forum_id) ? true : false,
			'S_POST_TYPE'	=> ($select_post_type) ? true : false,
			'S_TOPIC_ID'	=> ($select_topic_id) ? true : false,
			
			'POST_TYPE_OPTION'	=> $select_post_type,
	
			'POST_TITLE_FIELD'	=> $select_post_title,
			'POST_TEXT_FIELD'	=> $select_message,
			
			'SHOW_POST_TYPE'	=> ($select_forum_id) ? true : false,
			
			'SHOW_TOPICS_LIST'	=> ($select_forum_id && $select_post_type == 2) ? true : false,
		));

// Starting our template page loading
$template->set_filenames(array(
	'body' => 'mods/postingform_body.html',
	)
);

page_footer();

?>