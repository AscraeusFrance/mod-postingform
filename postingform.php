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


// Starting forums list


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