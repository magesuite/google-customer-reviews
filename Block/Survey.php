<?php
declare(strict_types=1);

namespace MageSuite\GoogleCustomerReviews\Block;

class Survey extends \Magento\Framework\View\Element\Template
{
    protected \MageSuite\GoogleCustomerReviews\Helper\Configuration $configuration;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \MageSuite\GoogleCustomerReviews\Helper\Configuration $configuration,
        array $data = []
    ) {
        $this->configuration = $configuration;
        parent::__construct($context, $data);
    }

    public function setOrder(\Magento\Sales\Model\Order $order)
    {
        return $this->setData('order', $order);
    }

    public function getOrder(): ?\Magento\Sales\Model\Order
    {
        return $this->getData('order');
    }

    protected function _toHtml()
    {
        if (!$this->configuration->isEnabled() || !$this->getOrder()) {
            return '';
        }

        return parent::_toHtml();
    }
}
