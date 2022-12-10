<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Acc.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate acc object
  $acc = new Acc($db);

   // Get order_id
   //$acc->order_id = isset($_GET['order_id']) ? $_GET['order_id'] : die();



  // transaction history query
  $result = $acc->allpayments();
  // Get row count
  $num = $result->rowCount();

  // Check if any posts
  if($num > 0) {
    // Acc array
    $acc_arr = array();
    

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $acc_item = array(
        'tsn_type' => $tsn_type,
        'tsn_date' => $tsn_date,
        'account_number' => $account_number,
        'amount' => $amount,
        'tsn_status' => $tsn_status,
        'order_id' => $order_id
        
      );

      // Push to "data"
      array_push($acc_arr, $acc_item);

    }

    // Turn to JSON & output
    echo json_encode($acc_arr);

  } else {
    // No Transactions
    echo json_encode(
      array('message' => 'No transaction found')
    );
  }