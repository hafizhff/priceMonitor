<?php
/**
 * @author Hafizh FF
 * @copyright Copyright (c) 2020 Magento (https://www.magento.com)
 * @package Hz_PriceMonitor
 */
namespace Hz\PriceMonitor\Controller\Product;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Hz\PriceMonitor\Helper\Data;
use Magento\Framework\Controller\ResultFactory;

class Add extends \Magento\Framework\App\Action\Action
{
	/**
	 * @var PageFactory
	 */
	protected $resultPageFactory;
	
	/**
	 * @var Data
	 */
	protected $helper;

	/**
	 * @var \Hz\PriceMonitor\Model\PriceMonitorFactory
	 */
	protected $priceMonitor;

	/**
	 * @var \Magento\Framework\Message\ManagerInterface
	 */
	protected $messageManager;
	
	/**
	 * Class Constructor
	 * 
	 * @param Context                                    $context           [description]
	 * @param PageFactory                                $resultPageFactory [description]
	 * @param Data                                       $helper            [description]
	 * @param \Hz\PriceMonitor\Model\PriceMonitorFactory $priceMonitor      [description]
	 */
	public function __construct (
		Context $context,  
		PageFactory $resultPageFactory, 
		Data $helper,
		\Hz\PriceMonitor\Model\PriceMonitorFactory $priceMonitor,
		\Magento\Framework\Message\ManagerInterface $messageManager
	) {
		$this->resultPageFactory = $resultPageFactory;
		$this->helper = $helper;
		$this->priceMonitor = $priceMonitor;
		$this->messageManager = $messageManager;
		parent::__construct($context);
	}
	
	/**
	 * Execute Submit Url
	 * 
	 * @return void
	 */
	public function execute()
	{
		$urlParam = $this->getRequest()->getParam('product_url');
		$data  = $this->helper->httpRequest($urlParam);

		$links = $this->helper->extractElementsBySpanClass('base', $data);
		$price = $this->helper->extractElementsBySpanClass('price', $data);
		$description = $this->helper->extractElementsByDivId('description', $data);
		// $image = $this->helper->extractElementImageClass('fotorama__img', $data);

		$modelData = array(
			"url" => $urlParam,
			"name" => $links,
			"price" => $this->reFormatPrice($price),
			"description" => $description,
			"image" => ''
		);

		$collection = $this->priceMonitor->create();
		$collection->setData($modelData)->save();

        $this->messageManager->addSuccessMessage('Product Url has been Inserted');

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
	}

	/**
	 * Remove Rp and Dot from Price
	 * 
	 * @param  string $price 
	 * @return string       
	 */
	protected function reFormatPrice($price)
	{
		$removeRp = str_replace('Rp ', '', $price);
		$removeDot = str_replace('.','',$removeRp);
		return $removeDot;
	}
}