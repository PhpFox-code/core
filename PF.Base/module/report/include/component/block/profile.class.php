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
 * @version 		$Id: profile.class.php 5077 2012-12-13 09:05:45Z Raymond_Benc $
 */
class Report_Component_Block_Profile extends Phpfox_Component
{
	/**
	 * Controller
	 */
	public function process()
	{
		(($sPlugin = Phpfox_Plugin::get('report.component_block_profile_process')) ? eval($sPlugin) : false);
		
		if (isset($bHideReportLink))
		{
			return false;
		}
		
		$aUser = $this->getParam('aUser');
		if (isset($aUser['is_page']) && $aUser['is_page'])
		{
			return false;
		}

		$this->template()->assign('aUser', $aUser);
		$this->template()->assign([
			'bIsBlocked' => (Phpfox::isUser() ? Phpfox::getService('user.block')->isBlocked(Phpfox::getUserId(), $aUser['user_id']) : false)
		]);
	}
	
	/**
	 * Garbage collector. Is executed after this class has completed
	 * its job and the template has also been displayed.
	 */
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('report.component_block_profile_clean')) ? eval($sPlugin) : false);
	}
}

?>