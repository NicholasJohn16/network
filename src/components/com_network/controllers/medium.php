<?php

class ComNetworkControllerMedium extends ComMediumControllerDefault
{

	protected function _actionBrowse(KCommandContext $context)
	{
		// should log after loading /notes?layout=list&filter=network if using aliases
		error_log('ComNetworkControllerMedium::_actionBrowse');
		parent::_actionBrowse($context);
		
		if($this->filter == 'network') {
			$query = $this->getList()->getQuery();
			$query->where = array();
			
			$privatable = $query->getRepository()->getBehavior('privatable');
			$config = new KConfig(array(
						'viewer' => get_viewer(),
						'graph_check' => true
					));
			
			$condition = $privatable->buildCondition('owner.id', $config, 'owner.access');
			$query->where($condition);
			
			$this->setList($query->toEntitySet())->getList();
		}
	}

}