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
        var amount = document.getElementsByName("amount");
        if(isNaN(amount)) {
            
            return false;
        } 
        amount = parseInt();
        if(amount < 0) {
            return false;
        }
        
        var accountNum =  document.getElementsByName("fromAccount");
        if (!/[^a-zA-Z]/.test(word)) {
            alert("Enter only numerical digits");
            return false;
        }
        accountNum =  document.getElementsByName("destAccountNo");
        if (!/[^a-zA-Z]/.test(word)) {
            return false;
        }
        
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
<form class="form-inline" name ="barclays" method="post" action="processTransaction.php" onSubmit="return validateField();">
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
<td> </td> <td> <br> <button class="btn btn-success" type="submit" name="submit" value="Submit"> Submit  <br></td>
</tr>

</fieldset>

</form>

</table>
</div>
</center>
</body>

</html>


