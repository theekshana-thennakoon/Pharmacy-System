<?php
session_start();
?>
<?php
include('database.php');
?>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/3.0.1/mustache.min.js"></script>
        <style>
            body {
              transition: all 0.3s ease;
            }
            .wrapper {
              display: flex;
              flex-direction: column;
              background: red;
              margin: 50px;
            }
            .prescription_form {
              width: 100%;
              background: white;
            }
            .prescription {
              width: 720px;
              height: auto;
              margin: 0 auto;
              border: 1px solid lightgrey;
            }
            .prescription tr > td {
              padding: 15px;
            }
            .header {
              color: #333;
              width: 100%;
              display: flex;
              justify-content: space-between;
              align-items: center;
            }
            .logo {
              flex: 1;
            }
            .logo img {
              width: 80px;
              height: 80px;
              float: left;
            }
            .credentials {
              flex: 1;
            }
            .credentials h4 {
              line-height: 1em;
              letter-spacing: 1px;
              font-weight: 700;
              margin: 0px;
              padding: 0px;
            }
            .credentials p {
              margin: 0 0 5px 0;
              padding: 3px 0px;
            }
            .credentials small {
              margin: 0;
              padding: 0;
              letter-spacing: 1px;
              padding-right: 80px;
            }
            
            .medicine {
              display: flex;
              flex-flow: column;
              height: auto;
            }
            
            @-webkit-keyframes fadein {
              from {bottom: 0; opacity: 0;} 
              to {bottom: 30px; opacity: 1;}
            }
            
            @keyframes fadein {
              from {bottom: 0; opacity: 0;}
              to {bottom: 30px; opacity: 1;}
            }
            
            @-webkit-keyframes fadeout {
              from {bottom: 30px; opacity: 1;} 
              to {bottom: 0; opacity: 0;}
            }
            
            @keyframes fadeout {
              from {bottom: 30px; opacity: 1;}
              to {bottom: 0; opacity: 0;}
            }
            @media print {
              .hidden-print {
                display: none !important;
              }
        </style>
    </head>
    <form action = 'printbill.php' method = 'post'>
        <button  onclick="javascript:window.print()" class="btn hidden-print" style = 'position:fixed;right:50px;top:50px;background:#0d6efd;padding:2%;color:#fff;' type = 'submit' name = 'printpage'>
            <i class='fa fa-print'></i>
        </button>
    </form>
<div class="wrapper">
    <div class="prescription_form">
        <table class="prescription" data-prescription_id="001" border="1">
            <tbody>
                <tr height="15%">
                    <td colspan="2">
                        <div class="header">
                            <div class="logo">
                                <img
                                    src="https://seeklogo.com/images/H/hospital-clinic-plus-logo-7916383C7A-seeklogo.com.png" />
                            </div>
                            <div class="credentials">
                                <h4 style = 'color:#0d6efd;'>Cedra Pharmacy</h4>
                                <p><?php echo date('Y-m-d');?></p>
                                <small>0712345678</small>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="80%" valign="top">
                        <div class="medicine">
                            <section class="med_list">
                                
                                <?php
                                    $nm = '';
                            	    $sqla = "SELECT * FROM tilprint";
                            	    $resulta = $conn->query($sqla);
                            		if ($resulta->num_rows > 0){
                            			while($rowa = $resulta->fetch_assoc()){
                            				$drugs = $rowa['drugs'];
                            				$drugs = $rowa['drugs'];
                            				for ($a = 0; $a <= strlen($drugs);$a++){
                            				    if ($drugs[$a] != ','){
                            				        $nm = $nm . ',' .  $drugs[$a];
                            				        $sqlb = "SELECT * FROM products where id = $drugs[$a]";
                                            	    $resultb = $conn->query($sqlb);
                                            		if ($resultb->num_rows > 0){
                                            			while($rowb = $resultb->fetch_assoc()){
                                            				echo '<h4>' . $rowb['name'] . '</h4><hr>';
                                            			}
                                            		}
                            				    }
                            				}
                            				
                            			}
                            		}
                            	    
                            	    ?>
                                <h4 style = 'color:#0d6efd;'>Total: </h4>
                            </section>
                        </div>
                    </td>
                    <td width="20%" valign="top" style = 'text-align:left;'>
                        <div class="medicine">
                            <section class="med_list">
                                
                                <?php
                                $p = 0;
                            	    $sqla = "SELECT * FROM tilprint";
                            	    $resulta = $conn->query($sqla);
                            		if ($resulta->num_rows > 0){
                            			while($rowa = $resulta->fetch_assoc()){
                            				$drugs = $rowa['drugs'];
                            				$daycount = $rowa['daycount'];
                            				for ($a = 0; $a <= strlen($drugs);$a++){
                            				    if ($drugs[$a] != ','){
                            				        $sqlb = "SELECT * FROM products where id = $drugs[$a]";
                                            	    $resultb = $conn->query($sqlb);
                                            		if ($resultb->num_rows > 0){
                                            			while($rowb = $resultb->fetch_assoc()){
                                            			    $abc = (int)$rowb['price'] * $daycount;
                                            			    $p = $p + $abc;
                                            				echo "<h4>LKR " . $abc . " /=</h4><hr>";
                                            			}
                                            		}
                            				    }
                            				}
                            				
                            			}
                            		}
                            	    
                            	    ?>
                                <h4 style = 'color:#0d6efd;'>LKR <?php echo $p; ?> /=</h4>
                            </section>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>



<?php
    if (isset($_POST['printpage'])){
        $date = date('Y-m-d');
        $month = date('Y-m');
        $aaa = '';
        for ($tst = 0; $tst < strlen($nm);$tst++){
            if ($nm[$tst] != ','){
                if ($aaa == ''){
                    $aaa = $nm[$tst];
                }
                else{
                    $aaa = $aaa . ',' . $nm[$tst];
                }
            }
            
        }
        $sqli = "insert into give values('$aaa','$p','$date','$month')";
        if($conn->query($sqli) === TRUE){
            $sqlt = "TRUNCATE TABLE tilprint";
            if($conn->query($sqlt) === TRUE){
                header('location:index.php');
            }
        }
    }
     
?>



</body>
</html>