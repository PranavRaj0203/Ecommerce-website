<?php
//include connect file
include('./include/connect.php');
// getting products
// $con = mysqli_connect("localhost", "username", "password", "database");

// function getProduct(){
//     global $con;


//     // condition to check isset or not

//     if(!isset($_GET['categories'])){

//         if(!isset($_GET['brands'])){
//     $select_query = "Select * from `products`";
//     $result_query = mysqli_query($con, $select_query);

  
//       while ($row = mysqli_fetch_assoc($result_query)) {
//         $product_id = $row['product_id'];
//         $product_title = $row['product_title'];
//         $product_description = $row['product_description'];
//         $product_image1 = $row['product_image1'];
//         $category_id = $row['category_id'];
//         $brand_id = $row['brand_id'];
//         $product_prīce=$row['product_price'];

        


//         echo " <div class='col-md-4 mb-2'>
//         <div class='card'>
//                    <img src='./images/$product_image1' class='card-img-top' alt='$product_title'>
//                     <div class='card-body'>
//                     <h5 class='cardtitle'>$product_title</h5>
//                    <p class='cardtext'>$product_description</p>
//                    <a href='#' class='btn  btn-info'>Add to Cart</a>
//                    <a href='#' class='btn  btn-secondary'>View 
//                      more</a>
//                   </div>
//                  </div>
//                  </div>";

//       }
// }
// }
// }


function getProduct()
{
    global $con;

    // Check if categories and brands are set in the $_GET array
    $categories = isset($_GET['category']) ? $_GET['category'] : null;
    $brands = isset($_GET['brand']) ? $_GET['brand'] : null; // Modify parameter name here

    // Construct the SQL query based on the provided categories and brands
    $select_query = "SELECT * FROM `products`";

    $conditions = array();

    if (!empty($categories)) {
        $conditions[] = "`category_id` IN ('$categories')";
    }

    if (!empty($brands)) {
        $conditions[] = "`brand_id` IN ('$brands')";
    }

    if (!empty($conditions)) {
        $select_query .= " WHERE " . implode(" AND ", $conditions);
    }

    $result_query = mysqli_query($con, $select_query);

    // Check for errors in the query execution
    if (!$result_query) {
        // Handle the error, e.g., log it or display a meaningful error message
        echo "Error executing query: " . mysqli_error($con);
        return;
    }

    while ($row = mysqli_fetch_assoc($result_query)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $product_image1 = $row['product_image1'];
        $category_id = $row['category_id'];
        $brand_id = $row['brand_id'];
        $product_price = $row['product_price'];

        echo " <div class='col-md-4 mb-2'>
            <div class='card'>
                <img src='./images/$product_image1' class='card-img-top' alt='$product_title'>
                <div class='card-body'>
                    <h5 class='card-title'>$product_title</h5>
                    <p class='card-text'>$product_description</p>
                    <a href='#' class='btn btn-info'>Add to Cart</a>
                    <a href='#' class='btn btn-secondary'>View more</a>
                </div>
            </div>
        </div>";
    }
}


// getting unique categories


// function get_unique_categories(){
//     global $con;


//     // condition to check isset or not

//     if(isset($_GET['categories'])){
//         $category_id=$_GET['categories'];
//         // if(!isset($_GET['brands'])){
//     $select_query = "Select * from `products` where category_id=$category_id";
//     $result_query = mysqli_query($con, $select_query);

  
//       while ($row = mysqli_fetch_assoc($result_query)) {
//         $product_id = $row['product_id'];
//         $product_title = $row['product_title'];
//         $product_description = $row['product_description'];
//         $product_image1 = $row['product_image1'];
//         $category_id = $row['category_id'];
//         $brand_id = $row['brand_id'];
//         $product_prīce=$row['product_price'];

        


//         echo " <div class='col-md-4 mb-2'>
//         <div class='card'>
//                    <img src='./images/$product_image1' class='card-img-top' alt='$product_title'>
//                     <div class='card-body'>
//                     <h5 class='cardtitle'>$product_title</h5>
//                    <p class='cardtext'>$product_description</p>
//                    <a href='#' class='btn  btn-info'>Add to Cart</a>
//                    <a href='#' class='btn  btn-secondary'>View 
//                      more</a>
//                   </div>
//                  </div>
//                  </div>";

//       }
// }
// }
// }
function get_unique_categories()
{
    global $con;

    if (!empty($_GET['category'])) {
        $category_id = mysqli_real_escape_string($con, $_GET['category']); // Escape the category ID for security

        $select_query = "SELECT * FROM `products` WHERE `category_id` = $category_id";
        $result_query = mysqli_query($con, $select_query);

        // Check for errors in the query execution
        if (!$result_query) {
            // Handle the error, e.g., log it or display a meaningful error message
            echo "Error executing query: " . mysqli_error($con);
            return;
        }

        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];
            $product_price = $row['product_price'];

            echo " <div class='col-md-4 mb-2'>
            <div class='card'>
                       <img src='./images/$product_image1' class='card-img-top' alt='$product_title'>
                        <div class='card-body'>
                        <h5 class='card-title'>$product_title</h5>
                       <p class='card-text'>$product_description</p>
                       <a href='#' class='btn btn-info'>Add to Cart</a>
                       <a href='#' class='btn btn-secondary'>View more</a>
                      </div>
                     </div>
                     </div>";
        }
    }
}


//displaying brands in sidsenav
function getBrands(){
    global $con;
    $select_brands = "select * from `brands`";
$result_brands = mysqli_query($con,$select_brands);
// $row_data = mysqli_fetch_assoc($result_brands);
while($row_data = mysqli_fetch_assoc($result_brands)){
  $brand_name=$row_data['brand_name'];

  $brand_id=$row_data['brand_id'];
echo "<li class='nav-item '>
<a href='index.php?brand=$brand_id' class='nav-link text-light'>$brand_name
</a>
</li>";

}
}

// categories 
function getCategories(){
    global $con;
    $select_categories = "select * from `categories`";
$result_categories = mysqli_query($con,$select_categories);
// $row_data = mysqli_fetch_assoc($result_brands);
while($row_data = mysqli_fetch_assoc($result_categories)){
  $categories_name=$row_data['category_title'];

  $categories_id=$row_data['category_id'];
echo "<li class='nav-item '>
<a href='index.php?category=$categories_id' class='nav-link text-light'>$categories_name
</a>
</li>";

}
}
?>