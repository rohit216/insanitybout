<html>
<head>
<title> Online Transaction </title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<style>
    
    #fieldset{

     display: block;
    margin-left: 2px;
    margin-right: 2px;
    padding-top: 0.35em;
    padding-bottom: 0.625em;
    padding-left: 0.75em;
    padding-right: 0.75em;
    border: 2px groove (internal value);                
    
        
    }
    
</style>

<script>
    function validateField()
    {
	Console.log('Entered');
        var amount = document.getElementsByName("amount");
        if(isNaN(amount)) {
            
            return false;
        } 
	Console.log('Entered');
        amount = parseInt();
        if(amount < 0) {
            return false;
        }
        Console.log('Entered');
        var accountNum =  document.getElementsByName("fromAccount");
        if (!/[^a-zA-Z]/.test(word)) {
            alert("Enter only numerical digits");
            return false;
        }
	Console.log('Entered');
        accountNum =  document.getElementsByName("destAccountNo");
        if (!/[^a-zA-Z]/.test(word)) {
            return false;
        }
	Console.log('Final');        
        return true;
    }
</script>
</head>
<body>
    <center>
<p><h2 style="color: blue;"> <center> Transaction Portal  </center> </h2> </p>

<h2> <p><center> Make your payment with us </center> </p></h2>
<div class="container-fluid">
    <div><a href ="UserDetails.php"> <button class="btn btn-primary" align="right"> User Details </button> </a></div>
<form class="form-inline" name ="barclays" action= "index.php" method="post">
<fieldset id="fieldset">
<legend> Online Transaction </legend>
<table border="0.5" style="align: center;">

<tr>
 <div class="form-group">
 <td><br><br> From: </td> <td><br><input type="text" name="fromAccount" placeholder="Enter Your Account No" class="form-control" required/> </td> 
 </div>
 </tr>
  <tr>
      
<div class="form-group">

 <td> <br><br>IFSC Code: </td> <td><br><input type="text" name="sourceIfscCode" placeholder="Enter IFSC code" class="form-control" required/>  <br></td><br>
</div>
 </tr>

 <tr>
     
<div class="form-group">

 <td><br><br> Bank Name: </td> <td><br><input type="text" name="bankName" placeholder="Enter Bank Name" class="form-control" required/>  <br></td><br>
</div>
 </tr>

 <tr>
     
<div class="form-group">

 <td><br><br> To: </td> <td><br> <input type="text" name="destAccountNo" placeholder="Enter benificiary account no" class="form-control" required/> <br> </td> <br>
</div>

 </tr>


 <tr>
<div class="form-group">

 <td><br><br> Amount: </td> <td><br> <input type="text" name="amount" placeholder="Enter Amount" class="form-control" required/>  <br></td> <br>
</div>

</tr>
<tr>
<td> </td> <td> <br> <button class="btn btn-success" type="submit" name="submit" value="Submit"> Submit <br></td>
</tr>

</fieldset>

</form>

</table>
</div>
</center>
</body>

</html>

<?php
	
  $hostname="insanitybout.ceazc8sfrkye.ap-south-1.rds.amazonaws.com";
  $username="insanitybout";
  $password="insanitybout";
  $dbname ="insanitybout";
  
  $con = mysqli_connect($hostname,$username,$password,$dbname);
	function validateWithOTP() {
	    	return true;
	}


	function credit($account, $amount) {
	  
	  $hostname="insanitybout.ceazc8sfrkye.ap-south-1.rds.amazonaws.com";
	  $username="insanitybout";
	  $password="insanitybout";
	  $dbname ="insanitybout";
	  
	  
	  $con = mysqli_connect($hostname,$username,$password,$dbname);
	    
	    $validSql1 = "select Balance from Customer where AccountNo = $account";
	    $queryResult1 = mysqli_query($con,$validSql1);
	    $row = mysqli_fetch_array($queryResult1);
	    $descAccountBalance = $row['Balance'];
	    $validSql = "update Customer set Balance = $descAccountBalance + $amount where AccountNo = $account";
	    $queryResult = mysqli_query($con,$validSql);
	    return true;
	}
	 

	function debit($account, $amount) {
  
	  $hostname="insanitybout.ceazc8sfrkye.ap-south-1.rds.amazonaws.com";
	  $username="insanitybout";
	  $password="insanitybout";
	  $dbname ="insanitybout";
	  
	  
	  $con = mysqli_connect($hostname,$username,$password,$dbname);
	    
	    $validSql1 = "select Balance from Customer where AccountNo = $account";
	    $queryResult1 = mysqli_query($con,$validSql1);
	    $row = mysqli_fetch_array($queryResult1);
	    $sourceAccountBalance = $row['Balance'];
	    if(($sourceAccountBalance - $amount) < 0){
	    
		print "<script> alert('Insufficient Amount');</script>";
		return false;
	    }
	    else{
	    $validSql = "update Customer set Balance = $sourceAccountBalance - $amount where AccountNo = $account";
	    $queryResult = mysqli_query($con,$validSql);
	    return true;
	    }
	} 
	    
	if(isset($_POST['submit'])){
	    
	    $srcAccNo= $_POST['fromAccount'];
	    $descAccNo= $_POST['destAccountNo'];
	    $bankName= $_POST['bankName'];
	    $Amount= $_POST['amount'];
	    $bname="SBI";
	    $validSql = "select Balance from Customer where AccountNo = $srcAccNo";
	    $queryResult = mysqli_query($con,$validSql);
	    $validSql1 = "select Balance from Customer where AccountNo = $descAccNo";
	    $queryResult1 = mysqli_query($con,$validSql1);
	    $row = mysqli_fetch_array($queryResult);
	    $row1 = mysqli_fetch_array($queryResult1);
	    $sourceAccountBalance = $row['Balance'];
	    $destAccountBalance = $row1['Balance'];
	    
	    if(validateWithOTP()){
	
		$T_id = rand(100,100000);
	
		$sql = "insert into Transaction(T_id,source_accountNo,dest_accountNo,bankName,Amount,trans_date) values('$T_id','$srcAccNo','$descAccNo','$bankName','$Amount',CURDATE())";
		$result = mysqli_query($con,$sql);
		if($result)
		{
		    if(debit($srcAccNo, $Amount) && credit($descAccNo, $Amount) ) {
			 print "<script> alert('Successfull Transaction');
			 location.href = 'success.php';</script>";
		    } else {
			
			print "<script> alert('Failed');             
			location.href = 'failure.php';</script>";
		    }
		}
		else
		{
		    print "<script>
		    location.href = 'index.php';</script>";
		    //header('location: failure.php');
		} 
	    
	    }
	 
	}
 
?>
