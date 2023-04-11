<?php
session_start();
?>
<?php
include('database.php');
?>
<?php

    if (isset($_GET['editproductid'])){
        $editproductid = $_GET['editproductid'];
        $sqla = "SELECT * FROM products where id = $editproductid";
    	$resulta = $conn->query($sqla);
    	if ($resulta->num_rows > 0){
    		while($rowa = $resulta->fetch_assoc()){
    			$ida = $rowa['id'];
    			$name = $rowa['name'];
    			$stock = $rowa['stock'];
    			$price = $rowa['price'];
    			$exp_date = $rowa['exp_date'];
    		}
    	}
    }
    else{
        header('Location:viewproduct.php');
    }
    

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Add Product</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <script src="sweetalert.min.js"></script>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Edit Product Details</h3></div>
                                    <div class="card-body">
                                        <div id = 'error' style = 'padding:2%;margin-bottom:1%;width:100%;background:#f00;color:#fff;border-radius:3px;display:none;'></div>
                                        <form action = 'editproduct.php' method = 'post'>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputstName" name = 'editid' type="hidden" value = '<?php echo $editproductid;?>' placeholder="Enter Product Name" />
                                                        <input class="form-control" id="inputFirstName" name = 'pname' type="text" value = '<?php echo $name;?>' placeholder="Enter Product Name" />
                                                        <label for="inputFirstName">Product name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="inputLastName" name = 'price' type="text" value = '<?php echo $price;?>' placeholder="Enter Product Price" />
                                                        <label for="inputLastName">Product Price</label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                            
                                            
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPassword" name = 'stock' type="text" value = '<?php echo $stock;?>' placeholder="Stock" />
                                                        <label for="inputPassword">Stock</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPasswordConfirm" name = 'edate' type="date" value = '<?php echo $exp_date;?>' placeholder="Expire Date" />
                                                        <label for="inputPasswordConfirm">Expire Date</label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid"><button class="btn btn-primary btn-block" name ="addproduct">Edit Product Details</button></div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <!--<div class="small"><a href="login.php">Have an account? Go to login</a></div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        
        <?php
        
            if(isset($_POST['addproduct'])){
                $editid = $_POST['editid'];
                $pname = $_POST['pname'];
                $price = $_POST['price'];
                $stock = $_POST['stock'];
                $edate = $_POST['edate'];
            	
            	$sqli = "update products set stock = $stock, price = '$price', exp_date = '$edate' where id = $editid";
                if($conn->query($sqli) === TRUE){
                    header('Location:viewproduct.php');
                }

            }
        
        ?>
        
    </body>
</html>
