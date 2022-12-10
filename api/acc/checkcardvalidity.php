<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Acc.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Acc object
  $acc = new Acc($db);

  // Get account number
  $acc->card_acc_name  = isset($_GET['card_acc_name']) ? $_GET['card_acc_name'] : die();
  $acc->card_number= isset($_GET['card_number']) ? $_GET['card_number'] : die();
  $acc->card_expiry= isset($_GET['card_expiry']) ? $_GET['card_expiry'] : die();
  $acc->card_cvv= isset($_GET['card_cvv']) ? $_GET['card_cvv'] : die();
 

 
  $result = $acc->checkcard();
  // Get row count
  $num = $result->rowCount();

  // Check if any posts
  if($num > 0) {
    // Acc array
    $acc_arr = array();
    

    $row = $result->fetch(PDO::FETCH_ASSOC);

    $acc_arr = array(
        'card_balance' => $row['card_balance'],
        'id' => $row['id'],
        'isvalid' => 'yes',
       
    );

     
    

  } 
  else 
  {
    // No Transactions
  
    $acc_arr = array('card_balance' => '0',
    'id' => '0',
      'isvalid' => 'no',);
      

  }

  print_r(json_encode($acc_arr));
  