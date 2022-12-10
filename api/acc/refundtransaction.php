<?php 
session_start();
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Acc.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Acc object
  $acc = new Acc($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $acc->order_id = isset($_GET['order_id']) ? $_GET['order_id'] : die();

  $d = isset($_GET['fromt']) ? $_GET['fromt'] : die();

 if( $_SESSION['emailaddress'] =="guest@gmail.com")
 {
$pm = "away";
 }
 else
 {
  $pm = "home";
 }

  
  // Refund trnx
  if($acc->refundtransaction($pm)) {

    echo json_encode(
      array('message' => 'Refund was successful')
    );
    if($d == "yes")
    {
      header('Location:../../shop/receivepayment.php');
    }
    else{
      header('Location:../../shop/transactions.php');
    }
  } else {
    echo json_encode(
      array('message' => 'Refund was not successful')
    );
    if($d == "yes")
    {
      header('Location:../../shop/receivepayment.php');
    }
    else{
      header('Location:../../shop/transactions.php');
    }
    
  }