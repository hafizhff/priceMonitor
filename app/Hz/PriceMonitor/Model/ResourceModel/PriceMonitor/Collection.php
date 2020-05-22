<?php
/**
 * @author Hafizh FF
 * @copyright Copyright (c) 2020 Magento (https://www.magento.com)
 * @package Hz_PriceMonitor
 */
namespace Hz\PriceMonitor\Model\ResourceModel\PriceMonitor;
 
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;	 

class Collection extends AbstractCollection
{
	/**
	 * @var string
	 */
	protected $_idFieldName = 'id';
	
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
		$this->_init(
				'Hz\PriceMonitor\Model\PriceMonitor',
				'Hz\PriceMonitor\Model\ResourceModel\PriceMonitor'
			);
		$this->_map['fields']['id'] = 'main_table.id';
    }
	
}