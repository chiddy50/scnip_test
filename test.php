<?php

$products = [
    [
        'id' => 2,
        'name' => 'Zebra Table',
        'price' => 44.49,
        'created' => '2012-01-04',
        'sales_count' => 301,
        'views_count' => 3279
    ],
    [
        'id' => 1,
        'name' => 'Alabaster Table',
        'price' => 12.99,
        'created' => '2019-01-04',
        'sales_count' => 32,
        'views_count' => 730
    ],
    [
        'id' => 3,
        'name' => 'Coffee Table',
        'price' => 10.00,
        'created' => '2014-05-28',
        'sales_count' => 1048,
        'views_count' => 20123
    ]
];


class Catalog
{
    private $products;

    public function __construct($products)
    {
        $this->products = $products;
    }

    public function getProducts(callable $sorter)
    {
        $sortedProducts = $this->products;

        // Sort the products using the provided sorter function
        usort($sortedProducts, $sorter);

        return $sortedProducts;
    }
}

// Product price sorting strategy
$productPriceSorter = function ($product_1, $product_2) {
    return $product_1['price'] - $product_2['price'];
};

// Sales per view sorting strategy
$productSalesPerViewSorter = function ($product_1, $product_2) {
    $salesPerView1 = $product_1['sales_count'] / $product_1['views_count'];
    $salesPerView2 = $product_2['sales_count'] / $product_2['views_count'];

    return $salesPerView2 <=> $salesPerView1;

};

$catalog = new Catalog($products);
$productsSortedByPrice = $catalog->getProducts($productPriceSorter);
$productsSortedBySalesPerView = $catalog->getProducts($productSalesPerViewSorter);

var_dump($productsSortedByPrice);
var_dump($productsSortedBySalesPerView);