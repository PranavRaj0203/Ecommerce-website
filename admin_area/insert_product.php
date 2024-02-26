<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../include/connect.php');

if (isset($_POST['insert_product'])) {
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_categories'];
    $product_brands = $_POST['product_brands'];
    $product_price = $_POST['product_price'];
    $product_status = 'true';

    // Accessing images
    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];

    // Accessing image temporary names
    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];
    $temp_image3 = $_FILES['product_image3']['tmp_name'];

    // Checking empty condition
    if (empty($product_title) || empty($product_description) || empty($product_keywords) || empty($product_category) || empty($product_brands) || empty($product_price) || empty($product_image1) || empty($product_image2) || empty($product_image3)) {
        echo "<script>alert('Please fill all the available fields')</script>";
        exit();
    } else {
        // Move uploaded files to the target directory
        $target_dir = "./product_images/";
        $target_file1 = $target_dir . basename($product_image1);
        $target_file2 = $target_dir . basename($product_image2);
        $target_file3 = $target_dir . basename($product_image3);

        // Check if the file uploads were successful
        $upload1 = move_uploaded_file($temp_image1, $target_file1);
        $upload2 = move_uploaded_file($temp_image2, $target_file2);
        $upload3 = move_uploaded_file($temp_image3, $target_file3);

        if ($upload1 && $upload2 && $upload3) {
            // Insert query
            $insert_product = "INSERT INTO `products` (product_title, product_description, product_keywords, category_id, brand_id, product_image1, product_image2, product_image3, product_price, date, status) VALUES ('$product_title', '$product_description', '$product_keywords', '$product_category', '$product_brands', '$product_image1', '$product_image2', '$product_image3', '$product_price', NOW(), '$product_status')";

            $result_query = mysqli_query($con, $insert_product);
            if ($result_query) {
                echo "<script>alert('Successfully inserted the product')</script>";
            } else {
                echo "<script>alert('Error inserting the product: " . mysqli_error($con) . "')</script>";
            }
        } else {
            echo "<script>alert('Error moving uploaded files')</script>";
        }
    }
}
?>.
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nsert Products-Admin Dashboard</title>


    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


    <!-- fontawesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css link -->

    <link rel="stylesheet" href="../style.css">

</head>
<body calss = "bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Products</h1>
        <form action="index.php" method="post" enctype="multipart/form-data">
      <!-- title -->
        <div class="form-outlibe mb-4 w-50 m-auto">
            <label for="product_title" class="form-label">Product title</label>

            <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" autocomplete="off" required="required">
        </div>
         
        <!-- description -->
         

        <div class="form-outlibe mb-4 w-50 m-auto">
            <label for="product_description" class="form-label">Product Description</label>

            <input type="text" name="product_description" id="product_title" class="form-control" placeholder="Enter product description" autocomplete="off" required="required">
        </div>


        <!-- keywords -->

        <div class="form-outlibe mb-4 w-50 m-auto">
            <label for="product_keywords" class="form-label">Product Keywords</label>

            <input type="text" name="product_keywords" id="product_keywords" class="form-control" placeholder="Enter product keywords" autocomplete="off" required="required">
        </div>


        <!-- categories -->


        <div class="form-outlibe mb-4 w-50 m-auto">
           <select name="product_categories" id="" class="form-select">
           
              <option value="">Select a category</option>

              <?php
              $select_query="Select * from `categories`";

              $result_query=mysqli_query($con,$select_query);
  while($row=mysqli_fetch_assoc($result_query)){
    $category_title=$row['category_title'];
    $category_id=$row['category_id'];
    echo "   <option value='$category_id'>$category_title</option>";
  }
              
              ?>
           


           </select>
        </div>


        <!-- brands -->


        
        <div class="form-outlibe mb-4 w-50 m-auto">
           <select name="product_brands" id="" class="form-select">
           
              <option value="">Select a brand</option>

              <?php
              $select_brand="Select * from `brands`";

              $result_brand=mysqli_query($con,$select_brand);
  while($row_data=mysqli_fetch_assoc($result_brand)){
    $brand_name=$row_data['brand_name'];
    $brand_id=$row_data['brand_id'];
    echo "<option value='$brand_id'>$brand_name</option>";
  }
              
              ?>
              


           </select>
        </div>


        <!-- image 1 -->

        
        <div class="form-outlibe mb-4 w-50 m-auto">
            <label for="product_image1" class="form-label">Product image1</label>

            <input type="file" name="product_image1" id="product_image1" class="form-control" required="required">
        </div>


        <!-- image2 -->

        <div class="form-outlibe mb-4 w-50 m-auto">
            <label for="product_image2" class="form-label">Product image2</label>

            <input type="file" name="product_image2" id="product_image2" class="form-control" required="required">
        </div>


        <!-- image3 -->

        <div class="form-outlibe mb-4 w-50 m-auto">
            <label for="product_image3" class="form-label">Product image3</label>

            <input type="file" name="product_image3" id="product_image3" class="form-control" required="required">
        </div>

        <!-- price -->
    
        <div class="form-outlibe mb-4 w-50 m-auto">
            <label for="product_price" class="form-label">Product Price</label>

            <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter product price" autocomplete="off" required="required">
        </div>

<!-- price button -->

<div class="form-outlibe mb-4 w-50 m-auto">
<input type="submit" name="insert_product" class="btn btn-info mb-3 " value="Insert Products">


        </div>

        </form>


    </div>
</body>
</html>