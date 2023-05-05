<?php

require "Database.php";

class User extends Database{
    public function register($data){
        $first_name = $data['first_name'];
        $last_name = $data['last_name'];
        $username = $data['username'];
        $password = $data['password'];

        $secure_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO `users` (`first_name`, `last_name`, `username`, `password`) VALUE ('$first_name', '$last_name', '$username', '$secure_password')";

        if($this->conn->query($sql)){
            header("location: ../views/dashboard.php");
            exit;
        }else{
            exit("Error creating new user: ". $this->conn->error);
        }
    }

    public function login($data){
        $username = $data['username'];
        $password = $data['password'];

        $sql = "SELECT * FROM `users` WHERE `username` = '$username'";

        if($result = $this->conn->query($sql)){
                
            // This if checks if there is a result
            if($result->num_rows == 1){
                $user = $result->fetch_assoc();

                // Verify the password
                if(password_verify($password, $user['password'])){
                    session_start();
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['full_name'] = $user['first_name']. " ". $user['last_name'];

                    header("Location: ../views/dashboard.php");
                    exit;
                }else{
                    // If the password did not match
                    exit("The password incorrect");
                }
            }else{
                // If the username is not found
                exit("Username not found");
            }
        }else{
            // If there was an error in the query
            exit("Query Error: ". $this->conn->error);
        }
    }

    public function addProduct($data){
        $product_name = $data['product_name'];
        $price = $data['price'];
        $quantity = $data['quantity'];

        $sql = "INSERT INTO `products`(`product_name`, `price`, `quantity`) VALUES ('$product_name','$price','$quantity')";

        if($this->conn->query($sql)){
            header("location: ../views/dashboard.php");
            exit;
        }else{
            exit("Error adding new products: ". $this->conn->error);
        }
    }

    public function getAllProducts(){
        $sql = "SELECT * FROM `products`";

        if($result = $this->conn->query($sql)){
            return $result;
            exit;
        }else{
            die("Error in retrieving all products: ". $this->conn->error);
        }
    }

    public function getProduct($id){
        $sql = "SELECT * FROM `products` WHERE `id` = $id";

        if($result = $this->conn->query($sql)){
            return $result->fetch_assoc();
            exit;
        }else{
            die("Error in retrieving all Users: ". $this->conn->error);
        }
    }

    public function editProduct($data){
        // var_dump($data);
        $product_id = $data['id'];
        
        $product_name = $data['product_name'];
        $price = $data['price'];
        $quantity = $data['quantity'];

        $sql = "UPDATE `products` SET `product_name`='$product_name',`price`='$price',`quantity`='$quantity' WHERE `id`='$product_id'";

        if($result = $this->conn->query($sql)){
            header("location: ../views/dashboard.php");
            exit;
        }else{
            die("Error in editing product: ". $this->conn->error);
        }
    }

    public function deleteProduct($id){
        
        $sql = "DELETE FROM `products` WHERE `id` = '$id'";

        if($result = $this->conn->query($sql)){
            header("location: ../views/dashboard.php");
            exit;
        }else{
            die("Error in deleting product: ". $this->conn->error);
        }
    }

    public function payment($data){
        $id = $data['id'];
        $buy_qty = $data['buy_qty'];
        $payment = $data['payment'];

        $sql_get = "SELECT `quantity` FROM `products` WHERE `id` = $id";

        if($result = $this->conn->query($sql_get)){
            $details = $result->fetch_assoc();
            
            $cal_qty = $details['quantity'] - $buy_qty;

            $sql_update = "UPDATE `products` SET `quantity`='$cal_qty' WHERE `id` = $id";

            if($this->conn->query($sql_update)){
                header("location: ../views/dashboard.php");
            }else{
                die("Error in updating products: ". $this->conn->error);
            }

        }else{
        die("Error in retrieving all products: ". $this->conn->error);
    }

    }

    public function buyProduct($data){
        $product_details['id'] = $data['id'];
        $product_details['price'] = $data['price'];
        $product_details['buy_qty'] = $data['buy_qty'];
        $product_details['total_price'] = $product_details['price'] * $product_details['buy_qty'];

        return $product_details;
        
    }
    

}

?>