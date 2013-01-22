<?php defined('SYSPATH') OR die('No direct script access.');

class Model_Forum_Poll_Vote extends ORM {

	protected $_belongs_to = array(
		'poll' => array(
			'model' => 'Forum_Poll',
			'foreign_key' => 'poll_id',
		),
	);

	public function create_vote($values, $expected)
	{
		// Validation for vote
		$extra_validation = Validation::Factory($values)
			->rule('option_id', 'Model_Forum_Poll_Option::option_exists');
 		return $this->values($values, $expected)
			->create($extra_validation);
	}

}