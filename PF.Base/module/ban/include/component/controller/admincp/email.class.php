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
 * @version 		$Id: email.class.php 979 2009-09-14 14:05:38Z Raymond_Benc $
 */
class Ban_Component_Controller_Admincp_Email extends Phpfox_Component
{
	/**
	 * Controller
	 */
	public function process()
	{
		$this->setParam('aBanFilter', array(
				'title' => Phpfox::getPhrase('ban.emails'),
				'type' => 'email',
				'url' => 'admincp.ban.email',
				'form' => Phpfox::getPhrase('ban.email')
			)
		);
		
		return Phpfox_Module::instance()->setController('ban.admincp.default');
	}
	
	/**
	 * Garbage collector. Is executed after this class has completed
	 * its job and the template has also been displayed.
	 */
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('ban.component_controller_admincp_email_clean')) ? eval($sPlugin) : false);
	}
}

?>