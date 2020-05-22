<?php
/**
 * @author Hafizh FF
 * @copyright Copyright (c) 2020 Magento (https://www.magento.com)
 * @package Hz_PriceMonitor
 */
namespace Hz\PriceMonitor\Cron;
use Hz\PriceMonitor\Helper\Data;

class Checking
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
	 * Class Constructor
	 * 
	 * @param Data                                          $helper          
	 * @param \Hz\PriceMonitor\Model\PriceMonitorFactory    $priceMonitor    
	 * @param \Hz\PriceMonitor\Model\PriceMonitorLogFactory $priceMonitorLog 
	 */
	public function __construct ( 
		Data $helper,
		\Hz\PriceMonitor\Model\PriceMonitorFactory $priceMonitor,
		\Hz\PriceMonitor\Model\PriceMonitorLogFactory $priceMonitorLog
	) {
		$this->helper = $helper;
		$this->priceMonitor = $priceMonitor;
		$this->priceMonitorLog = $priceMonitorLog;
	}

	/**
	 * Execute Hourly Monitoring Product Price
	 * 
	 * @return void
	 */
	public function execute()
	{	
		$collection = $this->priceMonitor->create()->getCollection();
		
		if ($collection->getSize() == 0) {
			return;
		}

		foreach ($collection as $item) {
			$url = $item->getUrl();
			$reloadRequest = $this->helper->httpRequest($url);
			$price = $this->helper->extractElementsBySpanClass('price', $data);

			$itemId = $item->getId();
			$modelCollection = $this->priceMonitor->create();
			$modelCollection->load($itemId);
	        $modelCollection->setPrice($price);
	        $modelCollection->setId($itemId);
	        $modelCollection->save();

	        $priceMonitorLog = $this->priceMonitorLog->create();
	        $data = array(
	        	'url' => $url,
	        	'price' => $price
	        );
	        $priceMonitor->setData($data)->save();
		}

		return;

	}
}