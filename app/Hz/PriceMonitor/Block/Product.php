<?php
/**
 * @author Hafizh FF
 * @copyright Copyright (c) 2020 Magento (https://www.magento.com)
 * @package Hz_PriceMonitor
 */
namespace Hz\PriceMonitor\Block;

use Magento\Framework\View\Element\Template;

class Product extends Template
{
    /**
     * @var Data
     */
    protected $helper;

    /**
     * @var \Hz\PriceMonitor\Model\PriceMonitorFactory 
     */
    protected $priceMonitor;

    /**
     * @var \Hz\PriceMonitor\Model\PriceMonitorLogFactory 
     */
    protected $priceMonitorLog;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * Class Constructor
     * 
     * @param Template\Context                              $context         [description]
     * @param \Hz\PriceMonitor\Model\PriceMonitorFactory    $priceMonitor    [description]
     * @param \Hz\PriceMonitor\Model\PriceMonitorLogFactory $priceMonitorLog [description]
     * @param \Magento\Framework\Registry                   $registry        [description]
     * @param array                                         $data            [description]
     */
    public function __construct(
        Template\Context $context,
        \Hz\PriceMonitor\Model\PriceMonitorFactory $priceMonitor,
        \Hz\PriceMonitor\Model\PriceMonitorLogFactory $priceMonitorLog,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        parent::__construct($context);
        $this->registry = $registry;
        $this->priceMonitor = $priceMonitor;
        $this->priceMonitorLog = $priceMonitorLog;
    }

    /**
     * Get List Product
     * 
     * @return \Hz\PriceMonitor\Model\PriceMonitorFactory
     */
    public function getListProduct()
    {
        $collection = $this->priceMonitor->create()->getCollection();
        return $collection;
    }

    /**
     * Get Param Stored on Registry
     * 
     * @return string
     */
    public function getParamItemId()
    {
        return $this->registry->registry('item_id');
    }

   /**
    * Get Product By ID
    * 
    * @return bool|\Hz\PriceMonitor\Model\PriceMonitorFactory
    */
    public function getCollectionById()
    {
        $id = $this->getParamItemId();
        $collection = $this->priceMonitor->create()->getCollection()->addFieldToFilter('id', $id);
        if ($collection->getSize() == 0) {
            return false;
        } else {
            return $collection->getFirstItem();
        }
    }

   /**
    * Get Monitoring Data
    * 
    * @param  string $url
    * @return bool|\Hz\PriceMonitor\Model\PriceMonitorLogFactory 
    */
    public function getCollectionLogByUrl($url)
    {
        $collection = $this->priceMonitorLog->create()->getCollection()->addFieldToFilter('url', $url);
        if ($collection->getSize() == 0) {
            return false;
        } else {
            return $collection;
        }
   }

}
