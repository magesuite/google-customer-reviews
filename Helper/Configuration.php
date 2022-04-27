<?php
declare(strict_types=1);

namespace MageSuite\GoogleCustomerReviews\Helper;

class Configuration extends \Magento\Framework\App\Helper\AbstractHelper
{
    public const XML_PATH_GENERAL_MERCHANT_ID = 'google_customer_reviews/general/merchant_id';
    public const XML_PATH_BADGE_ENABLED = 'google_customer_reviews/badge/enabled';
    public const XML_PATH_BADGE_POSITION = 'google_customer_reviews/badge/position';
    public const XML_PATH_OPT_IN_ENABLED = 'google_customer_reviews/opt_in/enabled';
    public const XML_PATH_OPT_IN_DELIVERY_TIME_IN_DAYS = 'google_customer_reviews/opt_in/delivery_time_in_days';

    public function getMerchantId($storeId = null): int
    {
        return (int)$this->scopeConfig->getValue(
            self::XML_PATH_GENERAL_MERCHANT_ID,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function isBadgeEnabled($storeId = null): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_BADGE_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function getBadgePosition($storeId = null): string
    {
        return (string)$this->scopeConfig->getValue(
            self::XML_PATH_BADGE_POSITION,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function isOptInEnabled($storeId = null): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_OPT_IN_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function getDeliveryTimeInDays($storeId = null): int
    {
        return (int)$this->scopeConfig->getValue(
            self::XML_PATH_OPT_IN_DELIVERY_TIME_IN_DAYS,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
}
