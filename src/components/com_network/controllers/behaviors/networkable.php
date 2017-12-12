<?php 

class ComNetworkControllerBehaviorNetworkable extends AnControllerBehaviorAbstract
{

	protected function _initialize(KConfig $config)
    {
        error_log(__CLASS__.':'.__FUNCTION__);
    	parent::_initialize($config);
   	}

	public function onAfterControllerBrowse(KEvent $event) {
		// should log after loading /notes?layout=list&filter=network if injecting behavior
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
}