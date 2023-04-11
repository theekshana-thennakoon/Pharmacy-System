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
    <title>Selected Drugs</title>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
	
	<link href="assets/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
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

<section class="category contact" id="pickup">
	<h1 class='heading'>Selected <span style = 'color:#fe2121;'>Drugs </span></h1>
</section>
   
<hr><br> 

<section class="category contact" id="pickup">
    
    <br>
	<table border = '1'>
	    <tr class = 'thead'>
	        <th style = 'background:#fe2121;'>Name</th>
	        <th style = 'background:#fe2121;'>Action</th>
	    </tr>
	    
	    <?php
	    
	    
	    $sqla = "SELECT * FROM tilprint";
	    $resulta = $conn->query($sqla);
		if ($resulta->num_rows > 0){
			while($rowa = $resulta->fetch_assoc()){
				$drugs = $rowa['drugs'];
				$drugs = $rowa['drugs'];
				for ($a = 0; $a <= strlen($drugs);$a++){
				    if ($drugs[$a] != ','){
				        $sqlb = "SELECT * FROM products where id = $drugs[$a]";
                	    $resultb = $conn->query($sqlb);
                		if ($resultb->num_rows > 0){
                			while($rowb = $resultb->fetch_assoc()){
                				$did = $rowb['id'];
                				$name = $rowb['name'];
                				echo "<tr>
                        	        <th data-label = 'Name' style = 'text-align:left;'>$name</th>
                        	        <th data-label = 'Action'>
                        	            <a href = '#'><i class='fa fa-pencil' aria-hidden='true'></i> Edit</a> | 
                        	            <a href = '#'><i class='fa fa-times' aria-hidden='true'></i> Remove
                        	        </th>
                        	    </tr>";
                			}
                		}
				    }
				}
				
			}
		}
	    
	    ?>
    </table>
</section>
</body>
</html>