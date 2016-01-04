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
 * @version 		$Id: news.class.php 4031 2012-03-20 15:08:25Z Raymond_Benc $
 */
class Core_Component_Block_News extends Phpfox_Component
{
	/**
	 * Controller
	 */
	public function process()
	{
		$aNews = Phpfox::getService('core.admincp')->getNews();
		
		if ($aNews === false)
		{
			return false;
		}		
		
		if (!Phpfox::getUserParam('core.can_view_news_updates'))
		{
			return false;
		}

		if ((is_array($aNews) && !count($aNews)) || is_bool($aNews))
		{
			return false;
		}
		
		$this->template()->assign(array(

			)
		);
		
		return 'block';
	}
	
	/**
	 * Garbage collector. Is executed after this class has completed
	 * its job and the template has also been displayed.
	 */
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('core.component_block_news_clean')) ? eval($sPlugin) : false);
	}
}

?>