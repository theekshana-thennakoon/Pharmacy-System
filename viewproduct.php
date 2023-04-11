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

<section class="category contact" id="pickup">
	<h3 class='heading'>All <span style = 'color:#0d6efd;'>Products </span></h3>
</section>
   
<hr><br> 

<section class="category contact" id="pickup">
    <form action = 'viewproduct.php' method = 'post'>
        <div class = 'inputBox'>
            <input type = 'text' name = 'search' placeholder = 'Search Using Product Name' style = 'width:96.5%;font-size:12px;' >
        </div>
        <input type = 'submit' name = 'searchsubmit' value = 'Search' class = 'btn' style = 'display: none;'>
    </form>
    <br>
	<table border = '1'>
	    <tr class = 'thead'>
	        <th style = 'background:#0d6efd;'>Name</th>
	        <th style = 'background:#0d6efd;'>Stock</th>
	        <th style = 'background:#0d6efd;'>Price</th>
	        <th style = 'background:#0d6efd;'>Action</th>
	    </tr>
	    
	    <?php
	    
	    if(isset($_POST['searchsubmit'])){
	        $search = $_POST['search'];
	        $sqla = "SELECT * FROM products where name like '%$search%' order by name ASC";
	    }
	    else{
	        $sqla = "SELECT * FROM products order by name ASC";
	    }
	    
		$resulta = $conn->query($sqla);
		if ($resulta->num_rows > 0){
			while($rowa = $resulta->fetch_assoc()){
				$ida = $rowa['id'];
				$name = $rowa['name'];
				$stock = $rowa['stock'];
				$price = $rowa['price'];
				
				if ($stock <= 20){
				    $bgcolor = '#f00';
				}
				else{
				    $bgcolor = '#fff';
				}
				
				echo "<tr style = 'background:{$bgcolor};'>
            	        <th data-label = 'Name' style = 'text-align:left;margin-left:10px;'>{$name}</th>
            	        <th data-label = 'Stock'>{$stock}</th>
            	        <th data-label = 'Price'>{$price}</th>
            	        <th data-label = 'Action'>
            	            <a href = 'editproduct.php?editproductid={$ida}'><i class='fa fa-pencil' aria-hidden='true'></i></a>
            	            <a href = 'x.php?deleteproduct={$ida}'><i class='fa fa-times' aria-hidden='true'></i></a>
            	        </th>
            	</tr>";
			}
		}
	    
	    ?>
    </table>
</section>
</body>
</html>