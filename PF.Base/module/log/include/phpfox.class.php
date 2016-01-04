<?php
/**
 * [Nulled by DarkGoth - NCP TEAM] - 2015
 */

defined('PHPFOX') or exit('NO DICE!');

/**
 * 
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Log
 * @version 		$Id: phpfox.class.php 5582 2013-03-28 08:33:43Z Raymond_Benc $
 */
class Module_Log 
{
	public static $aDevelopers = array(
		array(
			'name' => 'Raymond Benc',
			'website' => ''
		)
	);
	
	public static $aTables = array(
		'session',
		'log_session',
		'log_staff',
		'log_view'
	);
}

?>