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

  $ordercount = isset($_GET['order_count']) ? $_GET['order_count'] : die();
  $orderdate = isset($_GET['order_date']) ? $_GET['order_date'] : die();
  $orderid = isset($_GET['order_id']) ? $_GET['order_id'] : die();
  $customerid = isset($_GET['customer_id']) ? $_GET['customer_id'] : die();
  $acc->order_total=0;

  $iscomplete=false;

  echo json_encode($_POST['data']);
  $arr = (array) json_decode($_POST['data']);

  for($i=0;$i<$ordercount + 1;$i++)
  {
    $d=array();
    $d = (array) $arr[$i][0];

    if (str_replace('"', "", json_encode($d['item_name'])) != 'NULL')
    {
      $acc->order_id= $orderid;
      $acc->item_name= str_replace('"', "", json_encode($d['item_name'])); 
      $acc->item_quantity= str_replace('"', "", json_encode($d['item_quantity']));  
      $acc->item_price= str_replace('"', "", json_encode($d['item_price']));
      $acc->sub_total= str_replace('"', "", json_encode($d['sub_total']));  
      $acc->customer_id= $customerid;
      $iscomplete=false;
    }
    else{
      $iscomplete=true;
      $acc->total_amount=str_replace('"', "", json_encode($d['total']));
    }
   
    if($iscomplete == false)
  {
    try {

      $acc->receiveorders();
     
      
  }
  catch (exception $e) {
   // $iscomplete=false;
  }
  }

    
    


   
  }

  if($iscomplete)
  {
    $acc->order_id= $orderid;
    $acc->order_date= $orderdate; 
    $acc->item_count= $ordercount;  
    $acc->order_status= '200';  
    $acc->customer_id= $customerid;
    $acc->normaliseorder();
  }
  else
  {

  }



