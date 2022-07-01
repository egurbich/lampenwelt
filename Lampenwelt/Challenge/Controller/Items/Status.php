<?php
declare(strict_types=1);

namespace Lampenwelt\Challenge\Controller\Items;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Lampenwelt\Challenge\Model\Config;

class Status implements ActionInterface
{
    /**
     * @var  \Magento\Framework\View\Result\Page
     */
    protected $resultPageFactory;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @param PageFactory $resultPageFactory
     * @param Config $config
     */
    public function __construct(
        PageFactory $resultPageFactory,
        Config $config
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->config = $config;
    }

    /**
     * Controller for showing list of records on frontend page
     *
     * @return object
     */
    public function execute() : object
    {
        // checking if the module Lampenwelt_Challenge enabled
        if (!$this->config->isEnabled()) {
            return $this;
        }
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Orders List'));
        return $resultPage;
    }
}
