<?php
/**
 * @author Hafizh FF
 * @copyright Copyright (c) 2020 Magento (https://www.magento.com)
 * @package Hz_PriceMonitor
 */
namespace Hz\PriceMonitor\Controller\Product;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Show extends \Magento\Framework\App\Action\Action
{
   	/**
   	 * @var PageFactory
   	 */
	protected $resultPageFactory;
	
	/**
	 * Class Constructor
	 * 
	 * @param Context     $context           [description]
	 * @param PageFactory $resultPageFactory [description]
	 */
	public function __construct (
		Context $context,  
		PageFactory $resultPageFactory
	) {
		$this->resultPageFactory = $resultPageFactory;
		parent::__construct($context);
	}
	
	/**
	 * Show List Recorded Product
	 * 
	 * @return PageFactory
	 */
	public function execute()
	{
		return $this->resultPageFactory->create();
	}
}