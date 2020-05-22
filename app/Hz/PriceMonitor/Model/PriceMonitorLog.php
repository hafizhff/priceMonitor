<?php
/**
 * @author Hafizh FF
 * @copyright Copyright (c) 2020 Magento (https://www.magento.com)
 * @package Hz_PriceMonitor
 */
namespace Hz\PriceMonitor\Model;
 
use Magento\Framework\Model\AbstractModel;
 
class PriceMonitorLog extends AbstractModel
{	    
	/**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('Hz\PriceMonitor\Model\ResourceModel\PriceMonitorLog');
    }
}