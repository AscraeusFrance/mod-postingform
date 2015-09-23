<?php
/**
*
* postingform [English]
*
* @package language
* @version $Id: postingform.php AscraeusFrance $
* @copyright (c) 2015 AscraeusFrance ( http://www.ascraeus-france.fr )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* DO NOT CHANGE
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
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	// Form title
	'POSTING_FORM_TITLE'	=> 'Posting Form',
	
	// Forums list
	'FORUM_SELECT_TITLE'	=> 'Select a forum',
	'NO_FORUM'				=> 'Sorry, but there are no forums available.',
	
	// Post types
	'POST_TYPE_TITLE'		=> 'Post type',
	'POST_TYPE_NEW'			=> 'New topic',
	'POST_TYPE_REPLY'		=> 'Reply to a topic',
	
	// Post fields
	'POST_TITLE'			=> 'Post title',
	'POST_MESSAGE'			=> 'Text',
	'POST_MESSAGE_EXPLAIN'	=> 'Please insert only text. Any HTML or BBCode tags will be ignored',
	'POST_DATE'				=> 'Day',
	'POST_DATE_EXPLAIN'		=> 'Format <strong>DD/MM/YYYY</strong>',
	'POST_TIME'				=> 'Hour',
	'POST_TIME_EXPLAIN'		=> 'Format <strong>HH:MM:SS</strong>',

	// Users management
	'USERS_TYPE_TITLE'		=> 'User type',
	'USERS_TYPE_NEW'		=> 'New user',
	'USERS_TYPE_REGISTERED'	=> 'Already registered',
	'USER_SELECT_TITLE'		=> 'Select a member',
	'NO_USER_REGISTERED'	=> 'Sorry, but there are no registered users.',
	'USER_NAME_FIELD'		=> 'Username',
	'USER_MAIL_FIELD'		=> 'User e-mail',
	'USER_NO_SUCCESSFUL'	=> 'Member registration failed',
	'USER_SUCCESSFUL'		=> 'Member successfully added',
	
	// Topics list
	'TOPIC_SELECT_TITLE'	=> 'Select a topic',
	'NO_TOPIC'				=> 'Sorry, but there are no topics available.',
	
	// Errors
	'ERRORS_EXPLAIN'			=> array(
		1	=> 'Vous avez %d erreur de saisie. Corrigez-la et renvoyez le formulaire.<br />',
		2	=> 'Vous avez %d erreurs de saisie. Corrigez-les et renvoyez le formulaire.<br />',
	),
	'NO_SELECTED_FORUM'			=> 'No forum selected',
	'NO_SELECTED_POST_TYPE'		=> 'No post type selected',
	'NO_SELECTED_TOPIC_ID'		=> 'No topic selected',
	'NO_SELECTED_POST_TITLE'	=> 'No post title entered',
	'NO_SELECTED_POST_TEXT'		=> 'No message entered',
	'NO_SELECTED_POST_DAY'		=> 'No date entered',
	'NO_SELECTED_POST_TIME'		=> 'No hour entered',
	'NO_SELECTED_USER_ID'		=> 'No user selected',
	'NO_SELECTED_USER_NAME'		=> 'No username entered',
	'USERNAME_TAKEN'			=> 'Username « <strong>%s</strong> » already taken',
	'SELECTED_USER_MAIL_INVALID' => 'You entered a no valid email',
));