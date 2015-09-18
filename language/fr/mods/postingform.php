<?php
/**
*
* postingform [French]
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
	'POSTING_FORM_TITLE'	=> 'Formulaire de publication de message',
	
	// Forums list
	'FORUM_SELECT_TITLE'	=> 'Sélectionner un forum',
	'NO_FORUM'				=> 'Nous sommes désolés, mais il n’y a aucun forum disponible.',
	
	// Post types
	'POST_TYPE_TITLE'		=> 'Type de message',
	'POST_TYPE_NEW'			=> 'Nouveau sujet',
	'POST_TYPE_REPLY'			=> 'Répondre à un sujet',
	
	// Topics list
	'TOPIC_SELECT_TITLE'	=> 'Sélectionner un sujet',
	'NO_TOPIC'				=> 'Nous sommes désolés, mais il n’y a aucun sujet disponible.',
));