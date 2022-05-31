<?php
declare(strict_types=1);

namespace MageSuite\GoogleCustomerReviews\Model\Config\Source;

class ProductAttribute implements \Magento\Framework\Data\OptionSourceInterface
{
    protected \Magento\Catalog\Api\ProductAttributeRepositoryInterface $attributeRepository;

    protected \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder;

    protected \Magento\Framework\Convert\DataObject $objectConverter;

    public function __construct(
        \Magento\Catalog\Api\ProductAttributeRepositoryInterface $attributeRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Convert\DataObject $objectConverter
    ) {
        $this->attributeRepository = $attributeRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->objectConverter = $objectConverter;
    }

    public function toOptionArray(): array
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $configProductAttributeList = ['value' => 0, 'label' => __('None')];
        $productAttributes = $this->attributeRepository->getList($searchCriteria)->getItems();
        $options = $this->objectConverter->toOptionArray($productAttributes, 'attribute_code', 'frontend_label');
        array_unshift($options, $configProductAttributeList);

        return $options;
    }
}
