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
 * @package 		Phpfox_Component
 * @version 		$Id: block.class.php 103 2009-01-27 11:32:36Z Raymond_Benc $
 */
class Feed_Component_Block_Like_List extends Phpfox_Component
{
	/**
	 * Controller
	 */
	public function process()
	{
		$aLikes = Feed_Service_Feed::instance()->getLikes($this->request()->get('feed_id'));
		
		if (!count($aLikes))
		{
			return Phpfox_Error::set(Phpfox::getPhrase('feed.nobody_likes_this'));
		}
		
		$this->template()->assign(array(
				'aLikes' => $aLikes
			)
		);
	}
	
	/**
	 * Garbage collector. Is executed after this class has completed
	 * its job and the template has also been displayed.
	 */
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('feed.component_block_like_list_clean')) ? eval($sPlugin) : false);
	}
}

?>