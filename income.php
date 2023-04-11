<?php
session_start();
?>
<?php
include('database.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hazard Reports</title>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
    <!-- custom css file link  -->
	
	<link href="assets/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/styles.css">
    <style>
    *{
        margin:5px;
        padding:2px;
    }
	.inputBox input{
	  padding:1rem;
	  font-size: 1.7rem;
	  background:#f7f7f7;
	  text-transform: none;
	  margin:1rem 0;
	  border:.1rem solid rgba(0,0,0,.3);
	  width: 100%;
  }
  table{width:100%;border:1px solid #000;border-collapse:collapse;}
  table tr:nth-child(odd){background:#f5f5f5;}
  th,td{padding:1%;border:1px solid #000;font-size:14px;}
  th{text-align:center;}
  .thead{color:#fff;}
  @media(max-width:720px){
      .thead{display:none;}
      
      table tr, table th{display:block;width:100%;}
      
      table th{
          text-align:right;
          padding-left:50%;
          text-align:right;
          position:relative;
      }
      
      table tr{margin-bottom:15px;}
      
      table th::before{
          content:attr(data-label);
          position:absolute;
          left:0;
          width:50%;
          padding-left:15px;
          font-size:15px;
          font-weight:bold;
          text-align:left;
      }
  }
    </style>
</head>
<body>

<!-- header section starts  -->

<!-- header section ends -->

<!-- Pickup section starts  -->
<?php
    if ($_SESSION['loguser'] == 'admin'){
        echo "<center><button class='btn btn-light text-dark shadow-sm mt-1 me-1' id='download' target='_blank' style = 'cursor:pointer;background:#0d6efd;color:#fff;'><font style = 'color:#fff;'>Download Report</font></button></center>
        <hr>";
    }
?>

<section class="category contact" id="invoice">
    <section class="category contact" id="pickup">
    
    	<center><h3 class='heading'>Monthly <span style = 'color:#0d6efd;'>Income </span>Report</h3></center>
    </section>
       
    <!--<form action = 'viewproduct.php' method = 'post'>
        <div class = 'inputBox'>
            <input type = 'text' name = 'search' placeholder = 'Search From Month' style = 'width:96.5%;font-size:12px;' >
        </div>
        <input type = 'submit' name = 'searchsubmit' value = 'Search' class = 'btn' style = 'display: none;'>
    </form>-->
    <br>
	<table border = '1'>
	    <tr class = 'thead'>
	        <th style = 'background:#0d6efd;'>Date / Description</th>
	        <th style = 'background:#0d6efd;'>Income</th>
	    </tr>
	    
	    <?php
	    $month = date('Y-m');
	    if(isset($_POST['searchsubmit'])){
	        $search = $_POST['search'];
	        $sqla = "SELECT * FROM products where name like '%$search%' order by name ASC";
	    }
	    else{
	        $sqla = "SELECT sum(price) as sprice , date FROM give where month = '{$month}' group by date order by date DESC";
	        $sqlc = "SELECT sum(salary) as ssalary FROM salary where month = '{$month}'";
	    }
	    $sumprice = 0;
		$resulta = $conn->query($sqla);
		if ($resulta->num_rows > 0){
			while($rowa = $resulta->fetch_assoc()){
				$sprice = $rowa['sprice'];
				$date = $rowa['date'];
				$sumprice += $sprice;
				echo "<tr>
            	        <th data-label = 'Date' style = 'text-align:left;margin-left:10px;'>{$date}</th>
            	        <th data-label = 'Stock'>{$sprice}</th>
            	</tr>";
			}
		}
	    
	    $sumsalary = 0;
	    $resultc = $conn->query($sqlc);
		if ($resultc->num_rows > 0){
			while($rowc = $resultc->fetch_assoc()){
				$ssalary = $rowc['ssalary'];
				$sumsalary += $ssalary;
				echo "<tr>
            	        <th data-label = 'Salary' style = 'text-align:left;margin-left:10px;'><font style = 'color:#f00;'>For Salary</font></th>
            	        <th data-label = 'Stock'><font style = 'color:#f00;'>{$ssalary}</font></th>
            	</tr>";
			}
			echo "<tr>
            	    <th data-label = 'Total' style = 'text-align:left;margin-left:10px;'><font style = 'color:#0d6efd;'>Total</font></th>
            	    <th data-label = 'Stock'><font style = 'color:#0d6efd;'>{$sumprice}</font></th>
            	</tr>";
            	$subtotal = $sumprice - $ssalary;
            echo "<tr>
            	    <th data-label = 'Subtotal' style = 'text-align:left;margin-left:10px;'><font style = 'color:#0d6efd;'>Sub Total</font></th>
            	    <th data-label = 'Stock'><font style = 'color:#0d6efd;'>{$subtotal}</font></th>
            	</tr>";
		}
	    
	    ?>
    </table>
</section>
<script>
    window.onload = function () {
        document.getElementById("download")
        .addEventListener("click", () => {
            const invoice = this.document.getElementById("invoice");
            console.log(invoice);
            console.log(window);
            var opt = {
                margin: 0.5,
                filename: 'Monthly_income_report.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'landscape' }
            };
            html2pdf().from(invoice).set(opt).save();
        })
    }
</script>
</body>
</html>