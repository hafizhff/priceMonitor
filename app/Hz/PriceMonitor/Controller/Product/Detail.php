<?php
/**
 * @author Hafizh FF
 * @copyright Copyright (c) 2020 Magento (https://www.magento.com)
 * @package Hz_PriceMonitor
 */
namespace Hz\PriceMonitor\Controller\Product;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Detail extends \Magento\Framework\App\Action\Action
{
	/**
	 * @var [type]
	 */
	protected $resultPageFactory;
	
	/**
	 * @var PageFactory
	 */
	protected $productFactory;

	/**
	 * @var \Magento\Framework\Registry
	 */
	protected $registry;
	
	/**
	 * [__construct description]
	 * @param Context                     $context           [description]
	 * @param PageFactory                 $resultPageFactory [description]
	 * @param \Magento\Framework\Registry $registry          [description]
	 */
	public function __construct (
		Context $context,  
		PageFactory $resultPageFactory,
		\Magento\Framework\Registry $registry
	) {
		$this->resultPageFactory = $resultPageFactory;
		$this->registry = $registry;
		parent::__construct($context);
	}
	
	/**
	 * [execute description]
	 * 
	 * @return [type] [description]
	 */
	public function execute()
	{
		$itemId = $this->getRequest()->getParam('id');
		if (!$itemId) {
			return;
		}
		$this->registry->register('item_id', $itemId);
		return $this->resultPageFactory->create();
	}
}