<?php
session_start();
?>
<?php
include('database.php');
?>
<?php

    if (!isset($_SESSION['loguser'])){
        header('Location:login.php');
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
        <title>Register - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Issue Drugs</h3></div>
                                    <div class="card-body">
                                        <div id = 'error' style = 'padding:2%;margin-bottom:1%;width:100%;background:#f00;color:#fff;border-radius:3px;display:none;'></div>
                                        <form action = 'issuedrug.php' method = 'post'>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <select class="form-control" id="inputdrug" name = 'dname[]' multiple data-live-search="true">
                                                            <option value = '#'>Select Drug</option>
                                                            <?php
                                                            
                                                            $sql = "SELECT * FROM products";
                                                        	$result = $conn->query($sql);
                                                        	if ($result->num_rows > 0){
                                                        		while($row = $result->fetch_assoc()){
                                                        			$did = $row['id'];
                                                        			$dname = $row['name'];
                                                                    echo "<option value = '{$did}'>{$dname}</option>";
                                                        		}
                                                        	}
                                                            
                                                            ?>
                                                        </select>
                                                        <label for="inputdrug">Select Drug</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <select class="form-control" id="inputdose" name = 'dose'>
                                                            <option value = '#'>Select Dose</option>
                                                            <option value = '1 pills each twice'>1 pills each twice</option>
                                                            <option value = '2 pills each twice'>2 pills each twice</option>
                                                            <option value = '1 each three times'>1 each three times</option>
                                                            <option value = '2 each three times'>2 each three times</option>
                                                            <option value = '1 each once'>1 each once</option>
                                                            <option value = '2 each once'>2 each once</option>
                                                            <option value = '1 at night'>1 at night</option>
                                                        </select>
                                                        <label for="inputdose">Select Dose</label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPassword" name = 'daycount' type="number" placeholder="No of Days" />
                                                        <label for="inputPassword">No of Days</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <div class="d-grid"><button class="btn btn-primary btn-block" name ="togove" style = 'padding:6%;'>Select</button></div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="printbill.php">Print Bill</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="scripts.js"></script>
        
        <?php
        
            if(isset($_POST['togove'])){
                if (!empty($_POST['dname'])) {
                    $dnme = '';
                    foreach ($_POST['dname'] as $dname){
                        $dnme = $dnme . ',' . $dname;
                    }
                }
                
                $dose = $_POST['dose'];
                $daycount = $_POST['daycount'];
            	
            	
            	$sqli = "insert into tilprint(drugs,dose,daycount) values('$dnme','$dose',$daycount)";
                if($conn->query($sqli) === TRUE){
                    //do nothing
            	}
            	
            }
        
        ?>
        
    </body>
</html>
