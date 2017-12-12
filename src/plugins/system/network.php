<?php

class PlgSystemNetwork extends PlgAnahitaDefault
{

	public function onAfterDispatch()
	{
		error_log(__CLASS__.':'.__FUNCTION__);

		/* Uncomment these try inject behavior into controllers */
		//$networkable = KService::get('com:network.controller.behavior.networkable');
		//KService::get('com:stories.controller.story')->addBehavior($networkable);
		//KService::get('com:medium.controller.default')->addBehavior($networkable);

		/* Uncomment these to try aliasing controllers */
		// KService::setAlias('com:stories.controller.story','com:network.controller.story');
		// KService::setAlias('com://site/medium.controller.default', 'com://site/network.controller.medium');
	}

	/*  Legacy code for event listners
	protected function _initialize(KConfig $config)
	{
		error_log(__CLASS__.':'.__FUNCTION__);
		$config->append(array(
			'event_publishers' => array(
				'com:stories.controller.story',
				'com:medium.controller.abstract'
			)
		));
		parent::_initialize($config);
	}

	public function onAfterControllerBrowse(KEvent $event) {
		error_log(__CLASS__.':'.__FUNCTION__);
		$controller = $event->getPublisher();
		
		if($controller->filter == 'network') {
			$query = $controller->getList()->getQuery();
			$query->where = array();
			
			$privatable = $query->getRepository()->getBehavior('privatable');
			$config = new KConfig(array(
						'viewer' => get_viewer(),
						'graph_check' => true
					));
			
			$condition = $privatable->buildCondition('owner.id', $config, 'owner.access');
			$query->where($condition);
			
			$controller->setList($query->toEntitySet())->getList();
		}
	}
	*/
}