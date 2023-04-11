<?php
session_start();
?>
<?php
include('database.php');
?>
<?php

    if (isset($_SESSION['loguser'])){
        header('Location:index.php');
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <div id = 'error' style = 'padding:2%;margin-bottom:1%;width:100%;background:#f00;color:#fff;border-radius:3px;display:none;'></div>
                                        <form action = 'login.php' method = 'post'>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" name = 'username' type="text" placeholder="username" />
                                                <label for="inputEmail">Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" name = 'password' type="password" placeholder="Password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <!--<a class="small" href="password.html">Forgot Password?</a>-->
                                                <button type = 'submit' class="btn btn-primary" name = 'loginsubmit'>Login</button>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        
        <?php
        
            if(isset($_POST['loginsubmit'])){
                $user = $_POST['username'];
            	$pwd = $_POST['password'];
            	
            	$sql = "SELECT * FROM user WHERE username = '$user' limit 1";
            	$result = $conn->query($sql);
            	if ($result->num_rows == 1){
            		while($row = $result->fetch_assoc()){
            			$passworddb = $row['password'];
            			$id = $row['id'];
            		}
            		//$passwordcheck = password_verify($password, $passworddb);
            		
            		if($pwd == $passworddb){
            			$_SESSION['loguser'] = $user;
            			header('location:index.php');
            		}
            		else{
            			echo "<script>
            			    let error = document.getElementById('error');
            			    error.innerHTML = 'Check Your Password';
            			    error.style.display = 'block';
            			</script>";
            		}
            	}
            	else{
            			echo "<script>
            			    let error = document.getElementById('error');
            			    error.innerHTML = 'Check Your Username';
            			    error.style.display = 'block';
            			</script>";
            		}
            }
        
        ?>
        
    </body>
</html>
