
<?php

require_once('config.php');

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