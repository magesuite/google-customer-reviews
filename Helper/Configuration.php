<?php
declare(strict_types=1);

namespace MageSuite\GoogleCustomerReviews\Helper;

class Configuration extends \Magento\Framework\App\Helper\AbstractHelper
{
    public const XML_PATH_GENERAL_ENABLED = 'google_customer_reviews/general/enabled';
    public const XML_PATH_GENERAL_MERCHANT_ID = 'google_customer_reviews/general/merchant_id';
    public const XML_PATH_GENERAL_DELIVERY_TIME_IN_DAYS = 'google_customer_reviews/general/delivery_time_in_days';
    public const XML_PATH_GENERAL_BADGE_POSITION = 'google_customer_reviews/general/badge_position';

    public function isEnabled($storeId = null): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_GENERAL_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function getMerchantId($storeId = null): int
    {
        return (int)$this->scopeConfig->getValue(
            self::XML_PATH_GENERAL_MERCHANT_ID,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function getDeliveryTimeInDays($storeId = null): int
    {
        return (int)$this->scopeConfig->getValue(
            self::XML_PATH_GENERAL_DELIVERY_TIME_IN_DAYS,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function getBadgePosition($storeId = null): string
    {
        return (string)$this->scopeConfig->getValue(
            self::XML_PATH_GENERAL_BADGE_POSITION,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
}
