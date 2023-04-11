<?php
include('database.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - Cedra Pharmacy</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    <body class="sb-nav-fixed">
        
        <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Issue Drugs</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="issuedrug.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Add Product</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="addproduct.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">All Products</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="viewproduct.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Income</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="income.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                       Product Stock
                                    </div>
                                    <div style='width: 100%;'><canvas id='myChart'></canvas></div>
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
        $nm = array();
        $stk = array();
        $sqla = "SELECT * FROM products order by name ASC";
	    $resulta = $conn->query($sqla);
		if ($resulta->num_rows > 0){
			while($rowa = $resulta->fetch_assoc()){
				$name = $rowa['name'];
				$stock = $rowa['stock'];
				$nm[] = $name;
				$stk[] = $stock;
			}
		
		}
		?>
		<script type="text/javascript">
            var nm = <?php echo json_encode($nm); ?>;
            var stk = <?php echo json_encode($stk); ?>;
            console.log(nm);
        </script>
		<?php
		    echo "
		    <script>
                const labels = nm;
                const data = {
                    labels: labels,
                    datasets: [{
                        label: 'Product Stock',
                        data: stk,
                        backgroundColor: [
                            'rgba(2,117,216,1)',
                            'rgba(2,117,216,1)',
                            'rgba(2,117,216,1)',
                            'rgba(2,117,216,1)',
                            'rgba(2,117,216,1)',
                            'rgba(2,117,216,1)',
                            'rgba(2,117,216,1)'
                        ],
                        borderColor: [
                            'rgba(2,117,216,1)',
                            'rgba(2,117,216,1)',
                            'rgba(2,117,216,1)',
                            'rgba(2,117,216,1)',
                            'rgba(2,117,216,1)',
                            'rgba(2,117,216,1)',
                            'rgba(2,117,216,1)'
                        ],
                        borderWidth: 1
                    }]
                };
                
                const config = {
                    type: 'bar',
                    data: data,
                    options: {
                        scales: {
                            y: {
                            beginAtZero: true
                            }
                        }
                    },
                };
                    
                var myChart = new Chart(
                    document.getElementById('myChart'),
                config
                );
            </script>";
        ?>
        
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
