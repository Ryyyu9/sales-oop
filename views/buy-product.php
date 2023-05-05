<?php
session_start();

require "../classes/User.php";


$product_obj = new User;
$product_id = $_GET['product'];
$product = $product_obj->getProduct($product_id);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="modal-body p-5">
        <h1 class="display-4 fw-bold text-success text-center"><i class="fa-solid fa-cash-register"></i> Buy Product</h1>
        <div class="row mb-3">
            <div class="col-md">
                <p>Product Name</p>
                <h2><?= $product['product_name']; ?></h2>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <p>Price</p>
                <h2><?= $product['price']; ?></h2>
            </div>
            <div class="col-md-6">
                <p>Stock Left</p>
                <h2><?= $product['quantity']; ?></h2>
            </div>
        </div>

        <form action="payment.php?product=<?= $product_id; ?>" method="get" class="w-75 mx-auto pt-4 p-5">
            <input type="hidden" name="id" value="<?= $product['id']; ?>">
            <input type="hidden" name="price" value="<?= $product['price']; ?>">
            <div class="row mb-3">
                <div class="col-md">
                    <label for="buy-qty" class="form-label small text-secondary">Buy Quantity</label>
                    <input type="number" name="buy_qty" id="buy-qty" class="form-control" min="1" max="<?= $product['quantity']; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <button type="submit" class="btn btn-success w-100" name="buy_product">Pay</button>
                </div>
            </div>           
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>