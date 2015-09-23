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
$submit = $request->is_set_post('post'); // Did we press submit button ?

$select_forum_id		= request_var('select_forum_id', 0);
$select_post_type		= request_var('select_post_type', 0);
$select_topic_id		= request_var('select_topic_id', 0);
$select_post_title 		= utf8_normalize_nfc(request_var('select_post_title', '', true));
$select_message 		= utf8_normalize_nfc(request_var('select_message', '', true));
$select_post_time_day 	= utf8_normalize_nfc(request_var('select_post_time_day', '', true));
$select_post_time_hour 	= utf8_normalize_nfc(request_var('select_post_time_hour', '', true));
$select_user_type		= request_var('select_user_type', 0);
$select_user_name 		= utf8_normalize_nfc(request_var('select_user_name', '', true));
$select_user_mail 		= utf8_normalize_nfc(request_var('select_user_mail', '', true));
$select_user_id			= request_var('select_user_id', 0);

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
	$date_day = explode('/', $select_post_time_day);
	$date_hour = explode(':', $select_post_time_hour);
	$date_timestamp = ($select_post_time_day && $select_post_time_hour) ? mktime($date_hour[0], $date_hour[1], $date_hour[2], $date_day[1], $date_day[0], $date_day[2]) : '';

// Starting members list
	if ($select_user_type == 2)
	{
		$sql_users_list = 'SELECT user_id, user_type, username
					FROM ' . USERS_TABLE . '
					WHERE user_type <> ' . USER_IGNORE;
			
		$result_users_list = $db->sql_query($sql_users_list);
		
		$users_list = array();
		while ($row = $db->sql_fetchrow($result_users_list))
		{
			$template->assign_vars(array(
				'S_USERS_LIST'	=> ($row) ? true : false,
			));
			
			$template->assign_block_vars('users_list', array(
				'USER_ID'			=> $row['user_id'],
				'USER_NAME'		=> $row['username'],
				'USER_SELECTED'	=> ($row['user_id'] == $select_user_id) ? ' selected="selected"' : '',
			));			
		}
		$db->sql_freeresult($result_users_list);
	}
	
// Starting form submission
if ($submit)
{
	// Starting errors
		$errors = array();
		if (!$select_forum_id)
		{
		$errors[] = $user->lang['NO_SELECTED_FORUM'];
		}
		
		if (!$select_post_type)
		{
		$errors[] = $user->lang['NO_SELECTED_POST_TYPE'];
		}

		if ($select_post_type == 2 && !$select_topic_id)
		{
		$errors[] = $user->lang['NO_SELECTED_TOPIC_ID'];
		}
		
		if ($select_post_type && !$select_post_title)
		{
		$errors[] = $user->lang['NO_SELECTED_POST_TITLE'];
		}
		
		if ($select_post_type && !$select_message)
		{
		$errors[] = $user->lang['NO_SELECTED_POST_TEXT'];
		}
		
		if ($select_post_type && !$select_post_time_day)
		{
		$errors[] = $user->lang['NO_SELECTED_POST_DAY'];
		}
		
		if ($select_post_type && !$select_post_time_hour)
		{
		$errors[] = $user->lang['NO_SELECTED_POST_TIME'];
		}
		
		if ($select_user_type == 2 && !$select_user_id)
		{
		$errors[] = $user->lang['NO_SELECTED_USER_ID'];
		}

		if ($select_user_type == 1)
		{
			// Vérifions que nous avons renseigné un nom d'utilisateur
			if (!$select_user_name)
			{
			$errors[] = $user->lang['NO_SELECTED_USER_NAME'];
			}
			// Vérifions que nous n'avons pas renseigné un nom d'utilisateur déjà pris
			else
			{
				$clean_username = utf8_clean_string($select_user_name);
				$sql = 'SELECT username
					FROM ' . USERS_TABLE . "
					WHERE username_clean = '" . $db->sql_escape($clean_username) . "'";
				$result = $db->sql_query($sql);
				$row = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);

				if ($row)
				{
				$errors[] = $user->lang('USERNAME_TAKEN', $select_user_name);
				}
			}
			
			// Vérifions que nous avons renseigné une adresse mail
			if (!$select_user_mail)
			{
			$errors[] = $user->lang['NO_SELECTED_USER_MAIL'];
			}
			// Vérifions que nous avons renseigné une adresse mail valide
			else
			{
				if (filter_var($select_user_mail, FILTER_VALIDATE_EMAIL) === false)
				{
				$errors[] = $user->lang['SELECTED_USER_MAIL_INVALID'];
				}
			}
		}	
		
		$show_errors = implode('<br />', $errors);
	// Ending errors
	
	// No errors, let's continue
	if (!$show_errors)
	{
		if ($select_user_type == 1) // Did we decide to register a new member ?
		{
			if (!function_exists('user_add')) // Including our function to register our member...
			{
				include($phpbb_root_path . 'includes/functions_user.' . $phpEx);
			}
			
			// Which is the default group ?
				$sql = 'SELECT group_id FROM ' . GROUPS_TABLE . " WHERE group_name = 'REGISTERED' AND group_type = " . GROUP_SPECIAL;
				$result = $db->sql_query($sql);
				$row = $db->sql_fetchrow($result);
				$default_group_id = $row['group_id'];
				
			// User password... sent with our welcome message sent by email
				$string = str_shuffle('abcdefghjkmnpqrstuvwxyz123456789ABCDEFGHJKMNPQRSTUVWXYZ');
				$string2 = substr( $string , 0 , 3 ); // prendre les 10 1ers caractères.
				$string3 = str_shuffle('abcdefghjkmnpqrstuvwxyz123456789ABCDEFGHJKMNPQRSTUVWXYZ');
				$string4 = substr( $string3 , 0 , 5 ); // prendre les 10 1ers caractères
				$string5 = str_shuffle('abcdefghjkmnpqrstuvwxyz123456789ABCDEFGHJKMNPQRSTUVWXYZ');
				$string6 = substr( $string5 , 0 , 5 ); // prendre les 10 1ers caractères.
				
				$pass = $string2 . $string4 . $string6;
	
			// User vars...
			$user_row = array(
				'user_type'             		=> USER_NORMAL,
				'group_id'              		=> $default_group_id,
				'user_regdate'             		=> time(),
				'username'              		=> $select_user_name,
				'username_clean'              	=> utf8_clean_string($select_user_name),
				'user_password'              	=> phpbb_hash($pass),
				'user_email'              		=> $select_user_mail,
				'user_lang'              		=> 'fr', //$row['XXXXXXX'],
				'user_colour'              		=> '008800', //???
			);
			$user_id = user_add($user_row);
			
			$user->setup(array('common', 'ucp')); // Some language files necessary...
			
			// Email template...
			$message = array();
			$message[] = $user->lang['ACCOUNT_ADDED'];
			$email_template = 'user_postingform_welcome';
					
			if ($config['email_enable'])
			{
				if (!class_exists('messenger'))
				{
					include($phpbb_root_path . 'includes/functions_messenger.' . $phpEx);
				}

			$messenger = new messenger(false);

			$messenger->template($email_template, $user_row['user_lang']);

			$messenger->to($user_row['user_email'], $user_row['username']);

			$messenger->headers('X-AntiAbuse: Board servername - ' . $config['server_name']);
			$messenger->headers('X-AntiAbuse: User_id - ' . $user_id);
			$messenger->headers('X-AntiAbuse: Username - ' . $user_row['username']);
			$messenger->headers('X-AntiAbuse: User IP - ' . $user->ip);

			$messenger->assign_vars(array(
				'WELCOME_MSG'	=> htmlspecialchars_decode(sprintf($user->lang['WELCOME_SUBJECT'], $config['sitename'])),
				'USERNAME'		=> htmlspecialchars_decode($select_user_name),
				'PASSWORD'		=> htmlspecialchars_decode($pass),
			));

			$messenger->send(NOTIFY_EMAIL);
			}
	
		// Delete lines 320 to 330 in next version
		if (!$user_id)
		{
			trigger_error($user->lang['USER_NO_SUCCESSFUL']);	
		}
		else
		{
			trigger_error($user->lang['USER_SUCCESSFUL']);			
		}
				
		}
		
	}//no errors
}
else
{
	// Starting form no sent
}


		
// Output page
page_header($user->lang['POSTING_FORM_TITLE']);

// Starting some assign_vars()
		$template->assign_vars(array(
			'ERRORS_LIST'		=> ($submit && $show_errors) ? $show_errors : '',
			'SHOW_ERRORS_LIST'	=> ($submit && sizeof($errors)) ? true : false,
			'ERRORS_EXPLAIN'	=> ($submit && sizeof($errors)) ? $user->lang('ERRORS_EXPLAIN', count($errors)) : '',

			'S_FORUM_ID'	=> ($select_forum_id) ? true : false,
			'S_POST_TYPE'	=> ($select_post_type) ? true : false,
			'S_TOPIC_ID'	=> ($select_topic_id) ? true : false,
			
			'POST_TYPE_OPTION'	=> $select_post_type,
	
			'POST_TITLE_FIELD'	=> $select_post_title,
			'POST_TEXT_FIELD'	=> $select_message,
			'POST_TEXT_DAY'		=> $select_post_time_day,
			'POST_TEXT_HOUR'	=> $select_post_time_hour,
	
			'SHOW_POST_TYPE'	=> ($select_forum_id) ? true : false,
			
			'SHOW_TOPICS_LIST'	=> ($select_forum_id && $select_post_type == 2) ? true : false,
			'SHOW_USERS_LIST'	=> ($select_user_type == 2) ? true : false,
			
			'USERS_TYPE_OPTION'	=> $select_user_type,
			'USER_NAME_FIELD'	=> $select_user_name,
			'USER_MAIL_FIELD'	=> $select_user_mail,
		));

// Starting our template page loading
$template->set_filenames(array(
	'body' => 'mods/postingform_body.html',
	)
);

page_footer();

?>