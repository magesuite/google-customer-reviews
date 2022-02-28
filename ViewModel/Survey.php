<?php
declare(strict_types=1);

namespace MageSuite\GoogleCustomerReviews\ViewModel;

class Survey implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    protected \MageSuite\GoogleCustomerReviews\Helper\Configuration $configuration;

    protected \Magento\Framework\Serialize\SerializerInterface $serializer;

    protected \Magento\Framework\Stdlib\DateTime\DateTime $dateTime;

    public function __construct(
        \MageSuite\GoogleCustomerReviews\Helper\Configuration $configuration,
        \Magento\Framework\Serialize\SerializerInterface $serializer,
        \Magento\Framework\Stdlib\DateTime\DateTime $dateTime
    ) {
        $this->configuration = $configuration;
        $this->serializer = $serializer;
        $this->dateTime = $dateTime;
    }

    public function getJsonConfig(\Magento\Sales\Model\Order $order): string
    {
        $data = [
            'merchant_id' => $this->configuration->getMerchantId(),
            'order_id' => $order->getIncrementId(),
            'email' => $order->getCustomerEmail(),
            'delivery_country' => $this->getDeliveryCountry($order),
            'estimated_delivery_date' => $this->getEstimatedDeliveryDate(),
            'products' => $this->getProducts($order)
        ];

        return $this->serializer->serialize($data);
    }

    protected function getDeliveryCountry(\Magento\Sales\Model\Order $order): string
    {
        $address = $order->getShippingAddress();

        if ($order->getIsVirtual()) {
            $address = $order->getBillingAddress();
        }

        return $address->getCountryId();
    }

    protected function getProducts(\Magento\Sales\Model\Order $order): array
    {
        $products = [];

        foreach ($order->getAllVisibleItems() as $item) {
            $products[] = [
                'gtin' => $item->getSku()
            ];
        }

        return $products;
    }

    public function getEstimatedDeliveryDate(): string
    {
        $deliveryTimeInDays = $this->configuration->getDeliveryTimeInDays();

        return $this->dateTime->date('Y-m-d', "+{$deliveryTimeInDays} days");
    }
}
