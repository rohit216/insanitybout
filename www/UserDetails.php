<html>
<head>
<title> Online Transaction </title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<style type="html/css">
    
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

p.account{
    
    text-align:right;
}


p.bname{
    
    text-align:right;
    
}

p.balance{
    
    text-align:right;
    
}

    
</style>
</head>
<body>
    <center>
<br> <br> <br>
<table border="0.5" style="align: center;">

        <form name="userdetails" class="form-group" action="UserDetails.php" method="post">
        <fieldset id="fieldset">
    <legend>User Details </legend>
<tr>
 <div class="form-group">
 <td><br>Account No : </td> <td><br><input type="text" name="userAccount" placeholder="Enter Your Account No" class="form-control" required/> </td> 
 </div>
 </tr>
 
 <tr>
 <div class="form-group">
 <td><br> </td> <br> <td> <br> <button class="btn button-primary" type="submit" name="submit" /> Get Details </button> </td> 
 </div>
 </tr>
 </fieldset>
 </form>
 </table>
 
  <center>
      <br><br>
      <table border='1'>  
        
        <tr> <th> Transaction Id </th> 
        <th> Source Account </th> 
        <th> Destination Account </th>
        <th> Amount </th> 
        <th> TimeStamp </th> 
        </tr>
        
<?php

    
    
    require_once('config.php');
    
    if(isset($_POST['submit'])){
    
    $accountNo = $_POST['userAccount'];
    $bankName;
    $balance;
    $T_id;
    $sourceAccNo;
    $desAccNO;
    $debitedAmount;
    $date;
    
    $sql = "select * from Customer where accountNo = $accountNo";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);
    
    $transSql = "select *from Transaction";
    $transResult = mysqli_query($con,$transSql);
    if($row){
        
        print "<p class='account'> <h4> Account No: $row[accountNo] </p>";
        print "<p class='bname'><h4> Bank name : $row[BankName] </p> ";
        print "<p class='balance'> <h4>Balance : $row[Balance] </p>";
            
    }
     
    else{
        
        print "<script> alert('Please enter valid Account No'); </script>";
    }

    print "<div> <h3> Transaction History </h3> </div>";
    
    while($row = mysqli_fetch_array($transResult))
    {
          
          $trans_id=$row['T_id'];
		  $source=$row['source_accountNo'];
		  $destination=$row['dest_accountNo'];
		  $date=$row['trans_date'];
		  $amount = $row['Amount'];
		  
		  print "<tr>";
		  echo "<td>  $trans_id </td>";
		  print "<td> $source </td>";
		  print "<td> $destination </td>";
		  print "<td> $amount </td>";
		  print "<td> $date </td>";
    
		 print "</tr>";
		  
    }    
}

?>

</table>
</body>
</html>