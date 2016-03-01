<?php

namespace Visibility\Model\Behavior;

use Cake\ORM\Behavior; 				# parent class
use Cake\ORM\Query;					# Query class needed for findXYZ ops

class VisibilityBehavior extends Behavior{

	/**
	 * Default configuration settings.
	 * Can be overridden in `Table->addBehavior('Visiblity', [ .. settings ..])`
	 */
	protected $_defaultConfig = [
		'field' => 'is_visible',	# field used to monitor visibility, e.g. `Ewoks.is_visible`
		];

	/**
	 * Filters Query to only show records that are marked visible
	 * exposed to tables as `$table->find('visible')`
	 * @param Query $query
	 * @param array $options
	 * @return Query
	 */
	public function findVisible(Query $query, array $options){
		# get the merged (possibly customized) config values
		$config = $this->config();

		# filter the query by visibility
		return $query->where(["{$this->_table->alias()}.{$config['field']}" => true]);
	}
}
