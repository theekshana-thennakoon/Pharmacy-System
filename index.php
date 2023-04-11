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
else{
    $loguser = $_SESSION['loguser'];
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
        <title>Cedra - Pharmacy Management System</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Cedra Pharmacy</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <!--<input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>-->
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <!--<li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>-->
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <form action = 'index.php' method = 'post'>
                            <div class="sb-sidenav-menu-heading">User</div>
                            <button name = 'db' class="nav-link" style = 'background:#212529;border:none;'>
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </button>
                            <button name = 'id' class="nav-link" style = 'background:#212529;border:none;'>
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Issue Drugs
                            </button>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Products
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <button name = 'ap' class="nav-link" style = 'background:#212529;border:none;'>Add Product</button>
                                    <button name = 'vp' class="nav-link" style = 'background:#212529;border:none;'>View Products</button>
                                </nav>
                            </div>
                            <?php
                            
                            if($loguser == 'admin'){
                                echo "
                                
                                    <div class='sb-sidenav-menu-heading'>Admin</div>
                                    <a class='nav-link collapsed' href='#' data-bs-toggle='collapse' data-bs-target='#collapsereports' aria-expanded='false' aria-controls='collapsereports'>
                                    <div class='sb-nav-link-icon'><i class='fas fa-columns'></i></div>
                                        Reports
                                            <div class='sb-sidenav-collapse-arrow'><i class='fas fa-angle-down'></i></div>
                                        </a>
                                    <div class='collapse' id='collapsereports' aria-labelledby='headingOne' data-bs-parent='#sidenavAccordion'>
                                        <nav class='sb-sidenav-menu-nested nav'>
                                            <button name = 'ir' class='nav-link' style = 'background:#212529;border:none;'>Income Reports</button>
                                            <button name = 'pr' class='nav-link' style = 'background:#212529;border:none;'>Product Reports</button>
                                            <button name = 'ar' class='nav-link' style = 'background:#212529;border:none;'>Attendanced Reports</button>
                                            <button name = 'er' class='nav-link' style = 'background:#212529;border:none;'>Employee Reports</button>
                                        </nav>
                                    </div>
                                    
                                    
                                    <a class='nav-link collapsed' href='#' data-bs-toggle='collapse' data-bs-target='#collapseLayoutss' aria-expanded='false' aria-controls='collapseLayoutss'>
                                    <div class='sb-nav-link-icon'><i class='fas fa-columns'></i></div>
                                        Manage User
                                        <div class='sb-sidenav-collapse-arrow'><i class='fas fa-angle-down'></i></div>
                                    </a>
                                <div class='collapse' id='collapseLayoutss' aria-labelledby='headingOne' data-bs-parent='#sidenavAccordion'>
                                    <nav class='sb-sidenav-menu-nested nav'>
                                        <button name = 'ma' class='nav-link' style = 'background:#212529;border:none;'>Mark Attendance</button>
                                        <button name = 'ae' class='nav-link' style = 'background:#212529;border:none;'>Add Employee</button>
                                        <button name = 've' class='nav-link' style = 'background:#212529;border:none;'>View Employee</button>
                                        <button name = 'ps' class='nav-link' style = 'background:#212529;border:none;'>Pay Salary</button>
                                        <button name = 'au' class='nav-link' style = 'background:#212529;border:none;'>Add User</button>
                                    </nav>
                                </div>
                                
                                ";
                            }
                            
                            ?>
                            </form>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small"></div>
                       
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    
                    <?php
                        
                        if (isset($_POST['db'])){
                            echo "<iframe src='dashboard.php' style = 'width:100%;height:89.43vh'></iframe>";
                        }
                        else if (isset($_POST['id'])){
                            echo "<iframe src='issuedrug.php' style = 'width:100%;height:89.43vh'></iframe>";
                        }
                        else if (isset($_POST['ap'])){
                            echo "<iframe src='addproduct.php' style = 'width:100%;height:89.43vh'></iframe>";
                        }
                        else if (isset($_POST['vp'])){
                            echo "<iframe src='viewproduct.php' style = 'width:100%;height:89.43vh'></iframe>";
                        }
                        else if (isset($_POST['ir'])){
                            echo "<iframe src='income.php' style = 'width:100%;height:89.43vh'></iframe>";
                        }
                        else if (isset($_POST['pr'])){
                            echo "<iframe src='productreport.php' style = 'width:100%;height:89.43vh'></iframe>";
                        }
                        else if (isset($_POST['au'])){
                            echo "<iframe src='register.php' style = 'width:100%;height:89.43vh'></iframe>";
                        }
                        else if (isset($_POST['ae'])){
                            echo "<iframe src='addemployee.php' style = 'width:100%;height:89.43vh'></iframe>";
                        }
                        else if (isset($_POST['ma'])){
                            echo "<iframe src='attendance.php' style = 'width:100%;height:89.43vh'></iframe>";
                        }
                        else if (isset($_POST['ve'])){
                            echo "<iframe src='viewemployee.php' style = 'width:100%;height:89.43vh'></iframe>";
                        }
                        else if (isset($_POST['ps'])){
                            echo "<iframe src='paysalary.php' style = 'width:100%;height:89.43vh'></iframe>";
                        }
                        else if (isset($_POST['er'])){
                            echo "<iframe src='employeereport.php' style = 'width:100%;height:89.43vh'></iframe>";
                        }
                        else if (isset($_POST['ar'])){
                            echo "<iframe src='attendancereport.php' style = 'width:100%;height:89.43vh'></iframe>";
                        }
                        else{
                            echo "<iframe src='dashboard.php' style = 'width:100%;height:89.43vh'></iframe>";
                        }
                        
                    
                    ?>
                    
                    
                    
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
