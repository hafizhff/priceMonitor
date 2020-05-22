<?php
/**
 * @author Hafizh FF
 * @copyright Copyright (c) 2020 Magento (https://www.magento.com)
 * @package Hz_PriceMonitor
 */
namespace Hz\PriceMonitor\Model\ResourceModel;
 
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
 
class PriceMonitorLog extends AbstractDb
{
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('hz_price_monitoring_log', 'id');
    }
}