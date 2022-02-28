<?php
declare(strict_types=1);

namespace MageSuite\GoogleCustomerReviews\Observer;

class SetOrderForBlock implements \Magento\Framework\Event\ObserverInterface
{
    protected \Magento\Framework\View\LayoutInterface $layout;

    public function __construct(\Magento\Framework\View\LayoutInterface $layout)
    {
        $this->layout = $layout;
    }

    public function execute(\Magento\Framework\Event\Observer $observer): void
    {
        $order = $observer->getEvent()->getOrder();
        $block = $this->layout->getBlock('magesuite.google_customer_reviews.survey');

        if (!$order instanceof \Magento\Sales\Model\Order || !$block) {
            return;
        }

        $block->setOrder($order);
    }
}
