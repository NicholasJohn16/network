<?php 

class ComNetworkControllerStory extends ComStoryControllerDefault
{

	protected function _actionBrowse(KCommandContext $context)
	{
		// should log after loading /stories?layout=list&filter=network if using aliases
		error_log(__CLASS__.':'.__FUNCTION__);
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