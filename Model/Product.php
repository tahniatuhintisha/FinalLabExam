<?php
class Product {
    private $db;

    // Constructor to initialize the Database connection
    public function __construct() {
        $this->db = new Database(); // Assuming the Database class is correctly implemented
    }

    // Get the list of products for a specific user by email
    public function getProducts($email) {
        $query = "SELECT * FROM shopping_list WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add a product to the shopping list associated with a user's email
    public function addProduct($email, $productName) {
        $query = "INSERT INTO shopping_list (email, item) VALUES (:email, :productName)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':productName', $productName, PDO::PARAM_STR);
        return $stmt->execute(); // Returns true if successful
    }

    // Remove a product by its ID for a specific user
    public function removeProduct($productId, $email) {
        $query = "DELETE FROM shopping_list WHERE id = :productId AND email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        return $stmt->execute(); // Returns true if successful
    }

    // Get billing details for a specific user by user ID
    public function getBillingDetails($userId) {
        $query = "SELECT * FROM billing WHERE user_id = :userId";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
