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
 * @package  		Module_Forum
 * @version 		$Id: index.class.php 5219 2013-01-28 12:15:53Z Miguel_Espinoza $
 */
class Forum_Component_Controller_Index extends Phpfox_Component
{
	/**
	 * Controller
	 */
	public function process()
	{
		if (($sLegacyTitle = $this->request()->get('req2')) && !empty($sLegacyTitle))
		{
			if (($sLegacyThread = $this->request()->get('req3')) && !empty($sLegacyThread) && !is_numeric($sLegacyTitle))
			{
				$aLegacyItem = Phpfox::getService('core')->getLegacyItem(array(
						'field' => array('thread_id', 'title'),
						'table' => 'forum_thread',		
						'redirect' => 'forum.thread',
						'title' => $sLegacyThread
					)
				);				
			}
			else
			{
				$aForumParts = explode('-', $sLegacyTitle);
				if (isset($aForumParts[1]))
				{
					$aLegacyItem = Phpfox::getService('core')->getLegacyItem(array(
							'field' => array('forum_id', 'name'),
							'table' => 'forum',		
							'redirect' => 'forum',
							'search' => 'forum_id',
							'title' => $aForumParts[1]
						)
					);
				}
			}
		}			
		
		Phpfox::getUserParam('forum.can_view_forum', true);
		
		$aParentModule = $this->getParam('aParentModule');

		if (Phpfox::getParam('core.phpfox_is_hosted') && empty($aParentModule))
		{
			$this->url()->send('');
		}
		else if (empty($aParentModule) && $this->request()->get('view') == 'new')
		{
		    $aDo = explode('/',$this->request()->get('do'));
		    if ($aDo[0] == 'mobile' || (isset($aDo[1]) && $aDo[1] == 'mobile'))
		    {
				Phpfox_Module::instance()->getComponent('forum.forum', array('bNoTemplate' => true), 'controller');

				return;
		    }		    
		}
		    
		if ($this->request()->get('req2') == 'topics' || $this->request()->get('req2') == 'posts')
		{
			return Phpfox_Module::instance()->setController('error.404');
		}
				
		$this->template()->setBreadcrumb(Phpfox::getPhrase('forum.forum'), $this->url()->makeUrl('forum'))
			->setPhrase(array(
					'forum.provide_a_reply',
					'forum.adding_your_reply',
					'forum.are_you_sure',
					'forum.post_successfully_deleted',
					'forum.reply_multi_quoting'
				)
			)			
			->setHeader('cache', array(					
					'forum.css' => 'style_css',
					'forum.js' => 'module_forum'
				)
			);
		
		if ($aParentModule !== null)
		{
			Phpfox_Module::instance()->getComponent('forum.forum', array('bNoTemplate' => true), 'controller');

			return;
		}
		
		if ($this->request()->getInt('req2') > 0)
		{
			return Phpfox_Module::instance()->setController('forum.forum');
		}

		if ($aParentModule === null) {

			Phpfox_Search::instance()->set(array(
				'type' => 'forum',
				// 'filters' => $aFilters,
				// 'field' => 'ft.thread_id',
				'search_tool' => array(
					'table_alias' => 'ft',
					'search' => array(
						'action' => $this->url()->makeUrl('forum.search'),
						'default_value' => 'Search...',
						'name' => 'search',
						'field' => array('ft.title')
					),
					'sort' => array(
						'latest' => array('ft.time_stamp', Phpfox::getPhrase('blog.latest')),
						// 'most-viewed' => array('blog.total_view', Phpfox::getPhrase('blog.most_viewed')),
						// 'most-liked' => array('blog.total_like', Phpfox::getPhrase('blog.most_liked')),
						// 'most-talked' => array('blog.total_comment', Phpfox::getPhrase('blog.most_discussed'))
					),
					'show' => array(5, 10, 15)
				),

				// 'cache' => true,
				'field' => array(
					'depend' => 'result',
					'fields' => array('fp.post_id', 'ft.thread_id')
				)
			));
		}
		
		$this->setParam('bIsForum', true);

		// Phpfox::getService('forum')->buildMenu();

		$aIds = [];
		$aForums = Phpfox::getService('forum')->live()->getForums();
		foreach ($aForums as $aForum) {
			$aIds[] = $aForum['forum_id'];

			$aChilds = (array) Phpfox::getService('forum')->id($aForum['forum_id'])->getChildren();
			foreach ($aChilds as $iId) {
				$aIds[] = $iId;
			}
		}
		Phpfox::getService('forum')->id(null);

		/*
		list($iCnt, $aThreads) = Forum_Service_Thread_Thread::instance()
			->get('ft.forum_id IN(' . implode(',', $aIds) . ') AND ft.group_id = 0 AND ft.view_id >= 0 AND ft.is_announcement = 0', 'ft.order_id DESC', '', 0, 20);
		*/

		$this->template()->setTitle(Phpfox::getPhrase('forum.forum'))
			->assign(array(
				 'aForums' => Phpfox::getService('forum')->live()->getForums(),
					'bHasCategory' => Phpfox::getService('forum')->hasCategory(),
					// 'aThreads' => $aThreads,
					'aCallback' => null
			)
		);
		
		Phpfox::getService('forum')->buildMenu();	
	}
	
	/**
	 * Garbage collector. Is executed after this class has completed
	 * its job and the template has also been displayed.
	 */
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('forum.component_controller_index_clean')) ? eval($sPlugin) : false);
	}
}

?>