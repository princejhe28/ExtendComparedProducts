<?php

namespace BinaryAnvil\ExtendComparedProducts\Plugin\Product;

use Magento\Framework\Registry;
use Magento\Reports\Block\Product\Compared as OriginalClass;

class Compared
{
    private $registry;

    public function __construct(Registry $registry)
    {
        $this->registry = $registry;
    }

    public function getCurrentCategory()
    {
        return $this->registry->registry('current_category');
    }

    public function afterGetItemsCollection(OriginalClass $subject, $result)
    {
        if ($subject->getData('show_same_category_items_only')) {
            $currentCategory = $this->getCurrentCategory();
            $result->addCategoryFilter($currentCategory);
        }

        return $result;
    }
}
