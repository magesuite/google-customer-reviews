<?php
declare(strict_types=1);

namespace Creativestyle\CustomizationIpetFutterwahl\Test\Integration\Model;

class BadgeTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \MageSuite\GoogleCustomerReviews\ViewModel\Badge
     */
    protected $badgeViewModel;

    /**
     * @var \Magento\Framework\Serialize\SerializerInterface
     */
    protected $serializer;

    protected function setUp(): void
    {
        $objectManager = \Magento\TestFramework\ObjectManager::getInstance();
        $this->badgeViewModel = $objectManager->get(\MageSuite\GoogleCustomerReviews\ViewModel\Badge::class);
        $this->serializer = $objectManager->get(\Magento\Framework\Serialize\SerializerInterface::class);
    }

    /**
     * @magentoDbIsolation enabled
     * @magentoAppIsolation enabled
     * @magentoConfigFixture current_store google_customer_reviews/general/merchant_id 123456789
     * @magentoConfigFixture current_store google_customer_reviews/badge/enabled 1
     * @magentoConfigFixture current_store google_customer_reviews/badge/position INLINE
     */
    public function testIfReturnProperJsonData()
    {
        $expectedData = [
            'merchant_id' => 123456789,
            'position' => 'INLINE'
        ];

        $this->assertEquals(
            $this->serializer->serialize($expectedData),
            $this->badgeViewModel->getJsonConfig()
        );
    }
}
