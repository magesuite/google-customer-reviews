<?php
declare(strict_types=1);

namespace Creativestyle\CustomizationIpetFutterwahl\Test\Integration\Model;

class SurveyTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \MageSuite\GoogleCustomerReviews\ViewModel\Survey
     */
    protected $surveyViewModel;

    /**
     * @var \Magento\Framework\Serialize\SerializerInterface
     */
    protected $serializer;

    /**
     * @var \Magento\Sales\Model\OrderFactory
     */
    protected $orderFactory;

    protected function setUp(): void
    {
        $objectManager = \Magento\TestFramework\ObjectManager::getInstance();
        $this->surveyViewModel = $objectManager->get(\MageSuite\GoogleCustomerReviews\ViewModel\Survey::class);
        $this->serializer = $objectManager->get(\Magento\Framework\Serialize\SerializerInterface::class);
        $this->orderFactory = $objectManager->get(\Magento\Sales\Model\OrderFactory::class);
    }

    /**
     * @magentoDbIsolation enabled
     * @magentoAppIsolation enabled
     * @magentoConfigFixture current_store google_customer_reviews/opt_in/enabled 1
     * @magentoConfigFixture current_store google_customer_reviews/general/merchant_id 123456789
     * @magentoConfigFixture current_store google_customer_reviews/opt_in/delivery_time_in_days 3
     * @magentoDataFixture Magento/Sales/_files/order.php
     */
    public function testIfReturnProperJsonData()
    {
        $order = $this->orderFactory->create()->loadByIncrementId('100000001');
        $expectedData = [
            'merchant_id' => 123456789,
            'order_id' => '100000001',
            'email' => 'customer@example.com',
            'delivery_country' => 'US',
            'estimated_delivery_date' => date('Y-m-d', strtotime("+3 days")),
            'products' => [
                ['gtin' => 'simple']
            ]
        ];

        $this->assertEquals(
            $this->serializer->serialize($expectedData),
            $this->surveyViewModel->getJsonConfig($order)
        );
    }
}
