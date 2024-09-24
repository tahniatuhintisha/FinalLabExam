<?php
// Start session for user authentication purposes
session_start();

require_once('../Model/Product.php'); // Ensure the Product model is loaded

class ProductController {
    private $productModel;

    public function __construct() {
        $this->productModel = new Product(); // Instantiate the Product model
    }

    // Display the product list page
    public function displayProductList() {
        // Fetch the list of products from the model
        $products = $this->productModel->getProducts();

        // Load the view to display the product list, passing the products data
        require_once('../View/ProductList.php');
    }

    // Add a product for a specific user (by email)
    public function addProduct($email, $productName) {
        // Sanitize the product name
        $productName = htmlspecialchars(trim($productName));

        if (!empty($productName)) {
            // Call the model function to insert the product associated with the user's email
            if ($this->productModel->addProduct($email, $productName)) {
                $_SESSION['success'] = "Product added successfully!";
            } else {
                $_SESSION['error'] = "Failed to add the product.";
            }
        } else {
            $_SESSION['error'] = "Product name cannot be empty.";
        }

        // Redirect back to the product list page
        header("Location: ../View/ProductList.php");
        exit();
    }

    // Remove a product by its ID for a specific user
    public function removeProduct($productId, $email) {
        if ($this->productModel->removeProduct($productId, $email)) {
            $_SESSION['success'] = "Product removed successfully!";
        } else {
            $_SESSION['error'] = "Failed to remove the product.";
        }

        // Redirect back to the product list page
        header("Location: ../View/ProductList.php");
        exit();
    }

    // Display billing details for a user
    public function displayBillingDetails($userId) {
        // Fetch the billing details for the user
        $billing = $this->productModel->getBillingDetails($userId);

        // Load the view to display billing details
        require_once('../View/BillingDetails.php');
    }
}
