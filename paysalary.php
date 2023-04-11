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
        <title>Login</title>
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
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Mark Attendance</h3></div>
                                    <div class="card-body">
                                        <div id = 'error' style = 'padding:2%;margin-bottom:1%;width:100%;background:#f00;color:#fff;border-radius:3px;display:none;'></div>
                                        <div id = 'error' style = 'padding:2%;margin-bottom:1%;width:100%;background:#f00;color:#fff;border-radius:3px;display:none;'></div>
                                        <form action = 'paysalary.php' method = 'post'>
                                            <div class="form-floating mb-3">
                                                <select class="form-control" id="inputdrug" name = 'nic[]' multiple data-live-search="true">
                                                            <?php
                                                            
                                                            $sql = "SELECT * FROM employee";
                                                        	$result = $conn->query($sql);
                                                        	if ($result->num_rows > 0){
                                                        		while($row = $result->fetch_assoc()){
                                                        			$did = $row['id'];
                                                        			$nic = $row['nic'];
                                                        			$fname = $row['fname'];
                                                        			$lname = $row['lname'];
                                                        			$name = $fname . ' ' . $lname;
                                                                    echo "<option value = '{$nic}'>{$name}</option>";
                                                        		}
                                                        	}
                                                            
                                                            ?>
                                                        </select>
                                                        <label for="inputdrug">Select Employee</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                
                                                <button type = 'submit' class="btn btn-primary" name = 'pay'>Pay</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <!--<div class="small"><a href="register.php">Need an account? Sign up!</a></div>-->
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
        
            if(isset($_POST['pay'])){
               
            	$date = date("Y-m-d");
            	$month = date("Y-m");
            	
            	if (!empty($_POST['nic'])) {
                    foreach ($_POST['nic'] as $nic){
                        $sql = "SELECT * FROM salary WHERE nic = '$nic' and month = '$month'";
                    	$result = $conn->query($sql);
                    	if ($result->num_rows > 0){
                    		//echo 'Already Paid';
                    		echo "<script>
                			    let error = document.getElementById('error');
                			    error.innerHTML = 'Already Paid';
                			    error.style.display = 'block';
                			</script>";
                    	}
                    	else{
                    	    //echo $nic;
                    	    $sqlaaa = "SELECT * FROM employee WHERE nic = '$nic'";
                        	$resultaaa = $conn->query($sqlaaa);
                        	if ($resultaaa->num_rows > 0){
                        	    while($rowaaa = $resultaaa->fetch_assoc()){
                        		    $salary = $rowaaa['salary'];
                        		}
                        		
                        		$fdc = 0;
                        		$hdc = 0;
                        		$sqlaaa = "SELECT * FROM attendance WHERE nic = '$nic'";
                            	$resultaaa = $conn->query($sqlaaa);
                            	if ($resultaaa->num_rows > 0){
                            	    while($rowaaa = $resultaaa->fetch_assoc()){
                            		    $type = $rowaaa['type'];
                            			if ($type == 'fd'){
                            			    $fdc += 1;
                            			}
                            			else{
                            			    $hdc += 1;
                            			}
                            		}
                            		$salaryfd = ((int)$salary / 30) * $fdc;
                            		$salaryhd = ((((int)$salary / 30)) / 2) * $hdc;
                            		$fullsalary = $salaryfd + $salaryhd;
                            		$sqli = "insert into salary values('$nic','$fullsalary','$date','$month')";
                                    if($conn->query($sqli) === TRUE){
                                        
                                    }
                            	}
                        	}
                    	}
                    }
                    
            	}
            }
        
        ?>
        
    </body>
</html>
