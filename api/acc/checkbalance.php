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
  $acc->account_number = json_decode($_GET['account_number']);

  // Get balance
  $acc->checkBalance();

  // Create array

  if($acc->isexist)
  {
    $acc_arr = array(
        'id' => $acc->id,
        'Account Number' => $acc->account_number,
        'Balance' => $acc->accbal,
        'Msg' => '200 OK'
      );
  }
  else
  {
    $acc_arr = array(
        'Msg' => 'Account Number does not exist',
        'Balance' => '0.00',
        
      );
  }
 

  // Make JSON
  print_r(json_encode($acc_arr));