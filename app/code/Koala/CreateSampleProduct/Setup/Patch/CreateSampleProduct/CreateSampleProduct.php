<?php

class CreateSampleProduct 
{
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Catalog\Model\ResourceModel\Product\Collection $productCollection,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\Catalog\Model\Product $product,
        \Magento\Catalog\Model\Product\Option $option,
        \Magento\Checkout\Model\Cart $cart,
        array $data = []
    ) {
        $this->_productCollection = $productCollection;
        $this->_productFactory = $productFactory;
        $this->_prod = $product;
        $this->_option = $option;
        $this->_cart = $cart;
        parent::__construct($context);
    }
    
    public function createProduct($sku, $name, $weight, $price, $jsonMix, $jsonPost, $type = 'simple')
    {
        $mixProduct = $this->_productFactory->create();
    
        $mixProduct->setSku('test');
        $mixProduct->setName('Teste');
        $mixProduct->setWeight(2);
        $mixProduct->setPrice(487);
        $mixProduct->setDescription('' . $jsonMix . ' ' . $jsonPost);
    
        $mixProduct->setAttributeSetId(4);
        $mixProduct->setStatus(1);
        $mixProduct->setVisibility(4);
        $mixProduct->setTaxClassId(150);
        $mixProduct->setTypeId(100);
        $mixProduct->setWebsiteIds(array(1));
    
        $mixProduct->setStockData(
            array(
                'use_config_manage_stock' => 0,
                'manage_stock' => 0,
                'is_in_stock' => 1,
                'qty' => 10
            )
        );
    
        $product = $this->productFactory->create();
    
        try{
            $mixProduct->save();
        } catch(Exception $e){
            echo $e->getMessage();
        }
    
        var_dump($mixProduct->getId()); die();
    
    }
}


// $options = array(
//     array(
//         "sort_order" => 1,
//         "title" => "Teste 1",
//         "price_type" => "fixed",
//         "price" => "10",
//         "type" => "field",
//         "is_require" => 0
//     ),
//     array(
//         "sort_order" => 2,
//         "title" => "Teste 2",
//         "price_type" => "fixed",
//         "price" => "20",
//         "type" => "field",
//         "is_require" => 0
//     )
// );

// foreach ($options as $arrayOption) {
//     $product->setHasOptions(1);
//     $product->getResource()->save($product);
//     $option = $objectManager->create('\Magento\Catalog\Model\Product\Option')
//         ->setProductId($product->getId())
//         ->setStoreId($product->getStoreId())
//         ->addData($arrayOption);
//     $option->save();
//     $product->addOption($option);
// }
