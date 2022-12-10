<?php

class Acc{

private $conn;
private $customertable = 'customers';
private $transactiontable = 'transactions';
private $orderstable = 'orders';
private $normalisedorderstable = 'normalised_orders';
private $validcardstable = "valid_cards";

public $id;
public $tsn_type;
public $account_number;
public $to_account_number;
public $accbal;
public bool $isexist = false;
public $order_id;
public $item_name; 
public $item_quantity;  
public $item_price;
public $sub_total;  
public $customer_id;
public $order_total; 
public $item_count;  
public $order_status;
public $total_amount;
public $mainacc_bal;
public $mainacc_id= '3';
public $refundcode='300';
public $card_acc_name;
public $card_number;
public $card_expiry;
public $card_cvv;

//Transaction Table Columns
public $tsn_date;
public $amount;
public $tsn_status = '2000';

public function __construct($db)
{
    $this->conn = $db;
}

public function checkbalance()
{

    $query = 'SELECT * FROM ' . $this->customertable . ' WHERE account_number =? LIMIT 0,1';

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(1, $this->account_number);

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row != null)
    {
        $this->id = $row['id'];
        $this->accbal = $row['account_balance'];
        $this->isexist = true;
    }

   

}
public function checkcard()
{

    $query = 'SELECT * FROM ' . $this->validcardstable . ' WHERE card_acc_name =? and
    card_number =? and
    card_expiry =? and
    card_cvv =? ';

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(1, $this->card_acc_name);
    $stmt->bindParam(2, $this->card_number);
    $stmt->bindParam(3, $this->card_expiry);
    $stmt->bindParam(4, $this->card_cvv);

    $stmt->execute();

   return $stmt;
   

}

public function getCurrentBalance($accno)
{
    $query = 'SELECT * FROM ' . $this->customertable . ' WHERE account_number ='. $accno . ' LIMIT 0,1';

    $stmt = $this->conn->prepare($query);

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    
    return $row['account_balance'];
        
   

}
public function getCurrentBalancefromCards($accno)
{
    $query = 'SELECT * FROM ' . $this->validcardstable . ' WHERE card_number =? LIMIT 0,1';

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $accno);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    
    return $row['card_balance'];
        
   

}
public function getCurrentBalanceById($accid)
{
    $query = 'SELECT * FROM ' . $this->customertable . ' WHERE id ='. $accid . ' LIMIT 0,1';

    $stmt = $this->conn->prepare($query);

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    
    return $row['account_balance'];
        
    

}
public function getCurrentBalancefromCardsById($accid)
{
    $query = 'SELECT * FROM ' . $this->validcardstable . ' WHERE id ='. $accid . ' LIMIT 0,1';

    $stmt = $this->conn->prepare($query);

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    
    return $row['card_balance'];
        
   

}
public function getAmount($myid)
{
    $query = 'SELECT * FROM ' . $this->transactiontable . ' WHERE id ='. $myid . ' LIMIT 0,1';

    $stmt = $this->conn->prepare($query);

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    
    return $row['amount'];
        
   

}

public function updateRefundTsnCode($myId)
{
    $query = 'UPDATE ' . $this->transactiontable . '
    SET
       tsn_status= 300 
       WHERE id = :id';

   
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(':id', $myId);

    if ($stmt->execute())
    {
         return true;
    }
    else{
        return false;
    }

   

}

public function registeruser($firstname,$lastname,$email,$password,$apikey)
{
    $query = 'INSERT INTO ' . $this->customertable . '
    SET
       account_firstname= :firstname,
       account_lastname= :lastname,
       email_address= :email,
       account_password= :password,
       account_number= 112233445566,
       api_key= :apikey';

    $stmt = $this->conn->prepare($query);

    $firstname =  htmlspecialchars(strip_tags($firstname));
    $lastname =  htmlspecialchars(strip_tags($lastname));
    $email =  htmlspecialchars(strip_tags($email));
    $password =  htmlspecialchars(strip_tags($password));
    $apikey =  htmlspecialchars(strip_tags($apikey));

    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':apikey', $apikey);
    
    if ($stmt->execute())
    {
return true;
    }
   
return false;
}
public function makepayment($paymethod)
{
;  
    
    $query = 'INSERT INTO ' . $this->transactiontable . '
    SET
       tsn_date= :tsn_date,
       account_number= :account_number,
       to_account_number= :to_account_number,
       amount= :amount,
       order_id= :order_id,
       tsn_type= :tsn_type,
       tsn_status= :tsn_status';

    $stmt = $this->conn->prepare($query);

     $this->tsn_date =  htmlspecialchars(strip_tags($this->tsn_date));
     $this->account_number =  htmlspecialchars(strip_tags($this->account_number));
     $this->amount =  htmlspecialchars(strip_tags($this->amount));
     $this->tsn_status =  htmlspecialchars(strip_tags($this->tsn_status));
     $this->tsn_type =  htmlspecialchars(strip_tags($this->tsn_type));

if($paymethod=="home")
{
    $this->accbal = $this->getCurrentBalance($this->account_number) - $this->amount;
}
else{
    $this->accbal = $this->getCurrentBalancefromCards($this->account_number) - $this->amount;
    
}

     
     if ($this->accbal < 0)
     {
         return false;
     }
    $stmt->bindParam(':tsn_type', $this->tsn_type);
    $stmt->bindParam(':tsn_date', $this->tsn_date);
    $stmt->bindParam(':account_number', $this->account_number);
    $stmt->bindParam(':amount', $this->amount);
    $stmt->bindParam(':tsn_status', $this->tsn_status);
    $stmt->bindParam(':to_account_number', $this->to_account_number);
    $stmt->bindParam(':order_id', $this->order_id);
    

    if ($stmt->execute())
    {
       
        $query2 = 'UPDATE ' . $this->customertable . '
        SET
           account_balance= :account_balance 
           WHERE account_number = :to_account_number';
    
        $stmt2 = $this->conn->prepare($query2);
    
         $this->accbal = $this->amount + $this->getCurrentBalance($this->to_account_number);
         
    
        $stmt2->bindParam(':account_balance', $this->accbal);
        $stmt2->bindParam(':to_account_number', $this->to_account_number);
    
        if ($stmt2->execute())
        {
            if($paymethod=="home")
            {
            $query2 = 'UPDATE ' . $this->customertable . '
            SET
               account_balance= :account_balance 
               WHERE account_number = :account_number';
        
            $stmt2 = $this->conn->prepare($query2);
        
             $this->accbal = $this->getCurrentBalance($this->account_number) - $this->amount;
             
        
            $stmt2->bindParam(':account_balance', $this->accbal);
            $stmt2->bindParam(':account_number', $this->account_number);
            }
            else{
                $query2 = 'UPDATE ' . $this->validcardstable . '
            SET
               card_balance= :account_balance 
               WHERE card_number = :account_number';
        
            $stmt2 = $this->conn->prepare($query2);
        
             $this->accbal = $this->getCurrentBalancefromCards($this->account_number) - $this->amount;
             
        
            $stmt2->bindParam(':account_balance', $this->accbal);
            $stmt2->bindParam(':account_number', $this->account_number);
            }
        
            if ($stmt2->execute())
            {
                return true;
            }
            
        }
    
       printf("Error in updating account balance: %s.\n", $stmt2->error);
        return false;
    }

   printf("Error: %s.\n", $stmt->error);

    return false;

   

}

public function receiveorders()
{

    if($this->item_name != "NULL")
{
    $query = 'INSERT INTO ' . $this->orderstable . '
    SET
    order_id= :order_id,
    item_name= :item_name,
    item_quantity= :item_quantity,
    item_price= :item_price,
    sub_total= :sub_total,
    customer_id= :customer_id';

    $stmt = $this->conn->prepare($query);

     $this->order_id =  htmlspecialchars(strip_tags($this->order_id));
     $this->item_name =  htmlspecialchars(strip_tags($this->item_name));
     $this->item_quantity =  htmlspecialchars(strip_tags($this->item_quantity));
     $this->item_price =  htmlspecialchars(strip_tags($this->item_price));
     $this->sub_total =  htmlspecialchars(strip_tags($this->sub_total));
     $this->customer_id =  htmlspecialchars(strip_tags($this->customer_id));

 
    $stmt->bindParam(':order_id', $this->order_id);
    $stmt->bindParam(':item_name', $this->item_name);
    $stmt->bindParam(':item_quantity', $this->item_quantity);
    $stmt->bindParam(':item_price', $this->item_price);
    $stmt->bindParam(':sub_total', $this->sub_total);
    $stmt->bindParam(':customer_id', $this->customer_id);

    $this->order_total =  $this->order_total + $this->sub_total;
    
    if ($stmt->execute())
    {         
       return true;
    }

   printf("Error: %s.\n", $stmt->error);

}
    return false;

   

}


public function normaliseorder()
{

    $query = 'INSERT INTO ' . $this->normalisedorderstable . '
    SET
    order_id= :order_id,
    order_date= :order_date,
    item_count= :item_count,
    amount= :amount,
    order_status= :order_status,
    customer_id= :customer_id';

    $stmt = $this->conn->prepare($query);

     $this->order_id =  htmlspecialchars(strip_tags($this->order_id));
     $this->order_date =  htmlspecialchars(strip_tags( $this->order_date));
     $this->item_count =  htmlspecialchars(strip_tags($this->item_count));
     $this->order_status =  htmlspecialchars(strip_tags($this->order_status));
     $this->total_amount =  htmlspecialchars(strip_tags($this->total_amount));
     $this->customer_id =  htmlspecialchars(strip_tags($this->customer_id));

 
    $stmt->bindParam(':order_id', $this->order_id);
    $stmt->bindParam(':order_date', $this->order_date);
    $stmt->bindParam(':item_count', $this->item_count);
    $stmt->bindParam(':amount', $this->total_amount);
    $stmt->bindParam(':order_status', $this->order_status);
    $stmt->bindParam(':customer_id', $this->customer_id);

    if ($stmt->execute())
    {         
       return true;
    }

   printf("Error: %s.\n", $stmt->error);

    return false;

   

}
public function transactionHistory()
{
    $query = 'SELECT * FROM ' . $this->orderstable . ' WHERE order_id =? ';

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(1, $this->order_id);
    $stmt->execute();

    return $stmt;

    
}

public function allpayments()
{
    $query = 'SELECT * FROM ' . $this->transactiontable . '';

    $stmt = $this->conn->prepare($query);

    $stmt->execute();

    return $stmt;

}
public function authenticatelogin($emailaddress,$password)
{
    $query = 'SELECT * FROM ' . $this->customertable . ' WHERE email_address =:email_address and  
    account_password =:password and isBank =:isBank';

    $isbank ="no";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':email_address', $emailaddress);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':isBank', $isbank);
    $stmt->execute();

    return $stmt;

}

public function refundtransaction($paymethod)
{

   
    $query = 'SELECT * FROM ' . $this->normalisedorderstable . ' WHERE order_id =? LIMIT 0,1';

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(1, $this->order_id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    
    if ($row['order_status'] == '200')
    {
        
        

        $query = 'UPDATE ' . $this->normalisedorderstable . '
        SET
        order_status= :order_status  
           WHERE order_id = :order_id';
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_status', $this->refundcode);
        $stmt->bindParam(':order_id', $this->order_id);
    
        if($paymethod=="home")
{
    $this->accbal = $this->getCurrentBalanceById($row['customer_id']) + $row['amount'];
}
else{
    $this->accbal = $this->getCurrentBalancefromCardsById($row['customer_id']) + $row['amount'];
   
    
}
        
echo $this->getCurrentBalancefromCardsById($row['customer_id']);
         $this->mainacc_bal= $this->getCurrentBalanceById('3') - $row['amount'];
       
    
        if ($stmt->execute())
        {
            if($paymethod=="home")
{
            $query = 'UPDATE ' . $this->customertable . '
            SET
               account_balance= :account_balance  
               WHERE id = :id';
        
            $stmt = $this->conn->prepare($query);
        
            $stmt->bindParam(':id', $row['customer_id']);
            $stmt->bindParam(':account_balance', $this->accbal);
}
else{
    $query = 'UPDATE ' . $this->validcardstable . '
    SET
      card_balance= :account_balance  
       WHERE id = :id';

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(':id', $row['customer_id']);
    $stmt->bindParam(':account_balance', $this->accbal);
}
            
        
            if ($stmt->execute())
            {
                $query = 'UPDATE ' . $this->customertable . '
            SET
               account_balance= :account_balance  
               WHERE id = :id';
        
            $stmt = $this->conn->prepare($query);
        
            $stmt->bindParam(':id', $this->mainacc_id);
            $stmt->bindParam(':account_balance', $this->mainacc_bal);
            if ($stmt->execute())
            {
                $query = 'UPDATE ' . $this->transactiontable . '
        SET
        tsn_status= :tsn_status  
           WHERE order_id = :order_id';
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':tsn_status', $this->refundcode);
        $stmt->bindParam(':order_id', $this->order_id);
        if ($stmt->execute())
        {
            return true;
        }
             return true;
            }

            }
            return true;
        }
    
       printf("Error: %s.\n", $stmt->error);
   

    }
        
       
   

    return false;

   

}

}