<?php
declare(strict_types=1);

namespace MageSuite\GoogleCustomerReviews\Model\Config\Source;

class BadgePosition implements \Magento\Framework\Data\OptionSourceInterface
{
    public const OPTION_BOTTOM_RIGHT = 'BOTTOM_RIGHT';
    public const OPTION_BOTTOM_LEFT = 'BOTTOM_LEFT';
    public const OPTION_INLINE = 'INLINE';

    public function toOptionArray(): array
    {
        return [
            self::OPTION_BOTTOM_RIGHT => __('Bottom Right'),
            self::OPTION_BOTTOM_LEFT => __('Bottom Left'),
            self::OPTION_INLINE => __('Inline')
        ];
    }
}
