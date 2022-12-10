<?php

// by default, error messages are empty
$call_login=$set_account_number=$account_numberErr=$passErr='';
  
 extract($_POST);

if(isset($login))
{
   
   //input fields are Validated with regular expression
  
   $validEmail="/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
   
 
//Account Number Validation
if(empty($account_number)){
  $account_numberErr="Account number is Required"; 
 
}
else{
  $account_numberErr=true;
}
    
// password validation 
if(empty($password)){
  $passErr="Password is Required"; 
} 
else{
   $passErr=true;
}

// check all fields are valid or not
if( $account_numberErr==1 && $passErr==1)
{
 
   //legal input values
   $account_number=     legal_input($account_number);
 // $password=  legal_input(md5($password));

   //  Sql Query to insert user data into database table
   // Instantiate DB & connect
$database = new Database();
$db = $database->connectmysqli();
   
   $call_login=login($db,$account_number,$password);

}else{
   $set_account_number=$account_number;
}

}

// convert illegal input value to ligal value formate
function legal_input($value) {
  $value = trim($value);
  $value = stripslashes($value);
  $value = htmlspecialchars($value);
  return $value;
}

// function to check valid login data into database table
function login($db,$account_number,$password){

   // checking valid user
  $check_account_number="SELECT account_number FROM customers WHERE account_number='$account_number'";
  $run_account_number=mysqli_query($db,$check_account_number);
  if($run_account_number){
  if(mysqli_num_rows($run_account_number)>0)
  {
    // checking account number and password
    $check_user="SELECT account_number, account_password FROM customers WHERE account_number='$account_number' AND account_password='$password'";
    $run_user= mysqli_query($db,$check_user);
    if(mysqli_num_rows($run_user)>0)
     {
      session_start();
      $_SESSION['account_number']=$account_number;
      header("location:index.php");
     }else
     {
        
       return "Your password is wrong";
     }

  }
  else
  {
    return "Your account_number does not exist";
  }
   }else{
    echo $db->error;
   } 
    
}
?>