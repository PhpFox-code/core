<?php 
/**
 * [Nulled by DarkGoth - NCP TEAM] - 2015
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Friend
 * @version 		$Id: profile.html.php 6041 2013-06-10 18:50:19Z Raymond_Benc $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
{if ($aFriends)}
{foreach from=$aFriends name=friend item=aUser}
	{template file='user.block.rows'}
{/foreach}
{pager}
{/if}