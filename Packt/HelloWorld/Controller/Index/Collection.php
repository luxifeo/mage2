<?php
namespace Packt\HelloWorld\Controller\Index;
class Collection extends \Magento\Framework\App\Action\Action {
    public function execute() {
        $productCollection = $this->_objectManager
            ->create('Magento\Catalog\Model\ResourceModel\Product\Collection')
            ->addAttributeToSelect(['name', 'price', 'image']) // SELECT name, price, image
            //->addAttributeToFilter('name', 'Panties%')  // WHERE name = 'Panties'
            //->addAttributeToFilter('entity_id', array('in' => array(1, 2, 4))) // WHERE entity_in IN (1, 2, 4)
            ->addAttributeToFilter('name', array('like' => '%panties%')) // WHERE name LIKE '%panties%'
            ->setPageSize(10,1);
        $output = '';
        $productCollection->setDataToAll('price', 8990);
        foreach ($productCollection as $product) {
            $output .= \Zend_Debug::dump($product->debug(), null, false);
        }
        $productCollection->save();
        //$output = $productCollection->getSelect()->__toString(); // print SQL query
        $this->getResponse()->setBody($output);
    }
}