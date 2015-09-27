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
	
	// Post fields
	'POST_TITLE'			=> 'Titre du message',
	'POST_MESSAGE'			=> 'Message',
	'POST_MESSAGE_EXPLAIN'	=> 'Veuillez entrer du texte brut. Ni les balises HTML, ni les BBCodes, ne sont pris en charge',
	'POST_DATE'			=> 'Date',
	'POST_DATE_EXPLAIN'			=> 'Au format <strong>JJ/MM/AAAA</strong>',
	'POST_TIME'			=> 'Heure',
	'POST_TIME_EXPLAIN'			=> 'Au format <strong>HH:MM:SS</strong>',
	
	// Users management
	'USERS_TYPE_TITLE'		=> 'Type d’utilisateur',
	'USERS_TYPE_NEW'		=> 'Nouvel utilisateur',
	'USERS_TYPE_REGISTERED'	=> 'Déjà enregistré',
	'USER_SELECT_TITLE'		=> 'Choisissez un membre',
	'NO_USER_REGISTERED'	=> 'Nous sommes désolés, mais il n’y a aucun membre enregistré.',
	'USER_NAME_FIELD'		=> 'Pseudo',
	'USER_MAIL_FIELD'		=> 'Adresse e-mail',
	'USER_NO_SUCCESSFUL'	=> 'L’enregistrement du membre a échoué',
	'USER_SUCCESSFUL'		=> 'Membre enregistré avec succès',
	'USER_DAY'				=> 'Jour d’enregistrement',
	'USER_DAY_EXPLAIN'		=> 'Au format <strong>JJ/MM/AAAA</strong>',
	'USER_TIME'				=> 'Heure d’enregistrement',
	'USER_TIME_EXPLAIN'		=> 'Au format <strong>HH:MM:SS</strong>',
	
	// Topics list
	'TOPIC_SELECT_TITLE'	=> 'Sélectionner un sujet',
	'NO_TOPIC'				=> 'Nous sommes désolés, mais il n’y a aucun sujet disponible.',
	
	// Errors
	'ERRORS_EXPLAIN'			=> array(
		1	=> 'Vous avez %d erreur de saisie. Corrigez-la et renvoyez le formulaire.<br />',
		2	=> 'Vous avez %d erreurs de saisie. Corrigez-les et renvoyez le formulaire.<br />',
	),
	'NO_SELECTED_FORUM'			=> 'Aucun forum sélectionné',
	'NO_SELECTED_POST_TYPE'		=> 'Aucun type de message sélectionné',
	'NO_SELECTED_TOPIC_ID'		=> 'Aucun sujet sélectionné',
	'NO_SELECTED_POST_TITLE'	=> 'Aucun titre de message saisi',
	'NO_SELECTED_POST_TEXT'		=> 'Aucun message saisi',
	'NO_SELECTED_POST_DAY'		=> 'Aucune date saisie',
	'NO_SELECTED_POST_TIME'		=> 'Aucune heure saisie',
	'NO_SELECTED_USER_ID'		=> 'Aucun utilisateur sélectionné',
	'NO_SELECTED_USER_NAME'		=> 'Aucun pseudo saisi',
	'NO_SELECTED_USER_DAY'		=> 'Aucun jour d’enregistrement saisi',
	'NO_SELECTED_USER_TIME'		=> 'Aucune heure d’enregistrement saisie',
	'USERNAME_TAKEN'			=> 'Nom d’utilisateur « <strong>%s</strong> » déjà pris',
	'SELECTED_USER_MAIL_INVALID' => 'Vous avez saisi une adresse mail invalide',
));