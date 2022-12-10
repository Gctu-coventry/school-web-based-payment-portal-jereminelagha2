<?php 
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


$paymentmethod = isset($_GET['paymentmethod']) ? $_GET['paymentmethod'] : die();



$acc->tsn_date = isset($_GET['tsn_date']) ? $_GET['tsn_date'] : die();
$acc->account_number = json_decode($_POST['account_number']);
$acc->to_account_number = json_decode($_POST['to_account_number']);
$acc->amount = json_decode($_POST['amount']);
$acc->tsn_type = isset($_GET['tsn_type']) ? $_GET['tsn_type'] : die();
$acc->order_id = isset($_GET['order_id']) ? $_GET['order_id'] : die();
$acc->tsn_status = '200';


// Make payment
if($acc->makepayment($paymentmethod)) {
  echo json_encode(
    array('message' => 'Payment was successful')
  );
} else {
  echo json_encode(
    array('message' => 'Payment was not successful')
  );
}
