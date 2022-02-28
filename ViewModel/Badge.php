<?php
declare(strict_types=1);

namespace MageSuite\GoogleCustomerReviews\ViewModel;

class Badge implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    protected \MageSuite\GoogleCustomerReviews\Helper\Configuration $configuration;

    protected \Magento\Framework\Serialize\SerializerInterface $serializer;

    public function __construct(
        \MageSuite\GoogleCustomerReviews\Helper\Configuration $configuration,
        \Magento\Framework\Serialize\SerializerInterface $serializer
    ) {
        $this->configuration = $configuration;
        $this->serializer = $serializer;
    }

    public function isEnabled(): bool
    {
        return $this->configuration->isEnabled();
    }

    public function getJsonConfig(): string
    {
        $data = [
            'merchant_id' => $this->configuration->getMerchantId(),
            'position' => $this->configuration->getBadgePosition()
        ];

        return $this->serializer->serialize($data);
    }
}
