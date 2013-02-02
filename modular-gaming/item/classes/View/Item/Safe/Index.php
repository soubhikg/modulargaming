<?php defined('SYSPATH') OR die('No direct script access.');

class View_Item_Safe_Index extends Abstract_View {

	public $title = 'Safe';
	/**
	 * Pagination HTML
	 * @var string
	 */
	public $pagination = false;
	
	/**
	 * form submit url
	 * @var string
	 */
	public $process_url = false;
	
	/**
	 * Whether or not the user has a shop
	 * @var boolean
	 */
	public $shop = false;
	
	/**
	 * Contains User_Items
	 * @var array
	 */
	public $items = null;
	
	/**
	 * Format item nav
	 * @var aray
	 */
	public $links = array();
	
	/**
	 * Format item data
	 * @return array
	 */
	public function items(){
		$list = array();
		
		$options = array();
		$options[] = array('name' => 'Inventory', 'value' => 'inventory');
		
		if($this->shop == true)
		{
			$options[] = array('name' => 'Shop', 'value' => 'shop');
		}
		
		if(count($this->items) > 0)
		{
			foreach($this->items as $item) {			
				$list[] = array (
					'img' => $item->item->img(),
					'name' => $item->item->name,
					'amount' => $item->amount,
					'id' => $item->id,
					'options' => $options
				);
			}
		}
		
		return $list;
	}
}
