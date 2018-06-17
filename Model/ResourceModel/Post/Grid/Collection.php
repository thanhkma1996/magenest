<?php
namespace  Mageplaza\HelloWorld\Model\ResourceModel\Post\Grid;
/**
 * Subscription Collection
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {
    /**
     * Initialize resource collection
     *
     * @return void
     */
    public function _construct() {
        $this->_init(' Mageplaza\HelloWorld\Model\Post',
            ' Mageplaza\HelloWorld\Model\ResourceModel\Post');
    }
}