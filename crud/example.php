<?php
// Usage example

require_once 'GenericCrud.php';

$crud = new GenericCrud();

// Create a record
$data = [
    'name' => 'Product 1',
    'description' => 'Description 1',
    'price' => 19.99,
    'image' => 'product1.jpg',
    'category' => 'Category 1',
    'status' => 'Active'
];
$crud->createRecord('products', $data);

// Update a record
$updateData = [
    'name' => 'Updated Product 1',
    'price' => 29.99,
    'status' => 'Inactive'
];
$crud->updateRecord('products', $updateData, 1);

// Delete a record
$crud->deleteRecord('products', 2);

// Get a record
$product = $crud->getRecord('products', 1);
print_r($product);

// Get all records
$allProducts = $crud->getAllRecords('products');
print_r($allProducts);
