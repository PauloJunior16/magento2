<?php

use Magento\Framework\App\Bootstrap;

require __DIR__ . '/app/bootstrap.php';
$params = $_SERVER;
$bootstrap = Bootstrap::create(BP, $params);
$objectManager = $bootstrap->getObjectManager();
$state = $objectManager->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');


$_product = $objectManager->create('Magento\Catalog\Model\Product');
$_product->setName('Teste');
$_product->setTypeId('teste');
$_product->setAttributeSetId(4);
$_product->setSku('test');
$_product->setWebsiteIds(array(1));
$_product->setVisibility(4);
$_product->setPrice(array(1));
$_product->setImage('/testimg/test.jpg');
$_product->setSmallImage('/testimg/test.jpg');
$_product->setThumbnail('/testimg/test.jpg');
$_product->setStockData(array(
        'use_config_manage_stock' => 0, 
        'manage_stock' => 1, 
        'min_sale_qty' => 1, 
        'max_sale_qty' => 2, 
        'is_in_stock' => 1,
        'qty' => 10
        )
    );

$_product->save();

$options = array(
    array(
        "sort_order" => 1,
        "title" => "Teste 1",
        "price_type" => "fixed",
        "price" => "10",
        "type" => "field",
        "is_require" => 0
    ),
    array(
        "sort_order" => 2,
        "title" => "Teste 2",
        "price_type" => "fixed",
        "price" => "20",
        "type" => "field",
        "is_require" => 0
    )
);

foreach ($options as $arrayOption) {
    $product->setHasOptions(1);
    $product->getResource()->save($product);
    $option = $objectManager->create('\Magento\Catalog\Model\Product\Option')
        ->setProductId($product->getId())
        ->setStoreId($product->getStoreId())
        ->addData($arrayOption);
    $option->save();
    $product->addOption($option);
}
