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
  
  th,td{padding:1%;border:1px solid #000;font-size:14px;}
  th{text-align:center;}
  .thead{color:#fff;}
  button{padding:1%;border:none;border-radius:3px;}
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

<center><button class='btn btn-light text-dark shadow-sm mt-1 me-1' id='download' target='_blank' style = 'cursor:pointer;background:#0d6efd;color:#fff;'><font style = 'color:#fff;'>Download Report</font></button></center>

<section class="category contact" id="invoice">
    <section class="category contact" id="pickup">
    	<center><h2 class='heading'>Attendance <span style = 'color:#0d6efd;'>Report </span></h2></center>
    </section>
    <br>
	<table border = '1'>
	    <tr class = 'thead'>
	        <th style = 'background:#0d6efd;'>NIC</th>
	        <th style = 'background:#0d6efd;'>Name</th>
	        <th style = 'background:#0d6efd;'>Address</th>
	        <th style = 'background:#0d6efd;'>Date</th>
	    </tr>
	    
	    <?php
	    
	    $sqla = "SELECT * FROM attendance group by nic";
		$resulta = $conn->query($sqla);
		if ($resulta->num_rows > 0){
			while($rowa = $resulta->fetch_assoc()){
				$nic = $rowa['nic'];
				//echo $nic;
				$sqlb = "SELECT count(date) as cnic FROM attendance where nic = '{$nic}'";
        		$resultb = $conn->query($sqlb);
        		if ($resultb->num_rows > 0){
        			while($rowb = $resultb->fetch_assoc()){
        				$cnic = $rowb['cnic'];
        				//echo $cnic;
        			}
        		}
        		
        		$sqlc = "SELECT * FROM employee where nic = '$nic'";
        		$resultc = $conn->query($sqlc);
        		if ($resultc->num_rows > 0){
        			while($rowc = $resultc->fetch_assoc()){
        				$fname = $rowc['fname'];
        				$lname = $rowc['lname'];
        				$address = $rowc['address'];
        				$name = $fname . ' ' . $lname;
        			}
        		}
				
				$sqld = "SELECT date FROM attendance where nic = '{$nic}'";
        		$resultd = $conn->query($sqld);
        		if ($resultd->num_rows > 0){
        		    echo "<tr>
        		        <th rowspan = '{$cnic}'>{$nic}</th>
        				<th rowspan = '{$cnic}'>{$name}</th>
        				<th rowspan = '{$cnic}'>{$address}</th>";
        			while($rowd = $resultd->fetch_assoc()){
        				$date = $rowd['date'];
        				echo"<th>{$date}</th>";
        				echo "</tr>";  
        			}
        			
        		}
			}
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
                    filename: 'Attendance_report.pdf',
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