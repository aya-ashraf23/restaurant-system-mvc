<?php

namespace Aslam\Test\Model;

use Aslam\Test\public\Model;
use Aslam\Test\public\Session;

class Order extends Model{
    protected $tableName = "order_list";
    private $session;
    public function __construct(){
        parent::__construct();
        $this->session = new Session;
    }
    public function placeOrder($orderData){

        $orderData['user_id'] = $this->session->getSession('user_id');
        $orderData['code'] = $this->generateCode();
        $orderData['queue'] = $this->extractQueue($orderData['code']);
        $orderListResult = $this->insertOrderList($orderData);
        if($orderListResult['success'] == true){
            $order_id = $orderListResult['order_id'];
            $orderItemResult = $this->insertOrderItem($orderData , $order_id);
            if($orderItemResult['success'] == true){
                return json_encode([
                    'status' => 'success',
                    'msg' => 'order has been placed',
                    'order_id' => $order_id
                ]);
            }else{
                return json_encode([
                    'status' => 'fail',
                    'msg' => 'order could not be placed',
                    'error' => $orderItemResult['error']
                ]);
            }
        }else{
            return json_encode([
                'status' => 'fail',
                'msg' => 'order could not be placed',
                'error' => $orderListResult['error']
            ]);
        }
    }

    private function insertOrderList($data){
        $orderFields = ['user_id' , 'code' , 'queue' , 'total_amount' , 'tendered_amount'];
        $fields = [];
        $placeholders= [];
        foreach( $data as $key => $value){
            if(in_array($key , $orderFields) && !is_array($value)){
                $fields[]= $key;
                $placeholders[] = ":{$key}";
            }
        }
        // fields = [user_id , code , queue , total_amount , tendered_amout]
        // placeholders = [:user_id , :code , :queue , :total_amount , :tendered_amout]
        $query = "INSERT INTO $this->tableName (" . implode(',' , $fields) . ") 
                VALUES (" . implode(',' , $placeholders) . ")"; 
        $this->query($query);
        foreach( $data as $key => $value){
            if(in_array($key , $orderFields) && !is_array($value)){
               $this->bind(':' .$key, $value);
            }
        }
        $success = $this->execute();
        if ($success){
            return ['success'=> true , 'order_id'=> $this->connection->lastInsertId()];
        }else{
            return ['success'=> false , 'error'=> $this->connection->errorInfo()];
        }
    }

    private function insertOrderItem($order_data , $order_id){
        $data = '';
        foreach($order_data['menu_id'] as $key => $value){  
            if(!empty($data)){                              
                $data .= ',';
            }   
            $data .= "('{$order_id}' , '{$order_data['menu_id'][$key]}' , '{$order_data['price'][$key]}'
                   , '{$order_data['quantity'][$key]}')" ;                                        
        }
        $query = "INSERT INTO order_items (order_id , menu_id , price , quantity) VALUES $data";
        $this->query($query);
        $success = $this->execute();
        if($success){
            return ['success' => true];
        }else{
            return ['success' => false , 'error'=> $this->connection->errorInfo()];
        }
    }

    private function generateCode(){   

        $prefix = date('Ymd');
        $code = sprintf("%'.05d" , 1);
        while(true){
            $query = "SELECT * FROM $this->tableName where code = '{$prefix}{$code}'";
            $this->query($query);
            $row = $this->single();
            if($row){
                $code = sprintf("%'.05d" , $code + 1);
            }else{
                return $prefix . $code;
            }
        }
    }

    private function extractQueue($code){
        return substr($code , -5);
    }

    public function getOrderDetails($id){
        $query = "SELECT * FROM $this->tableName WHERE id = $id";
        $this->query($query);
        return $this->single(); 
    }
    public function getOrderItemDetails($id){
        $query = "SELECT oi.*, concat(ml.code,'-', ml.name) as item
                  FROM order_items oi
                  JOIN menu_list ml ON oi.menu_id = ml.id
                  WHERE oi.order_id = $id";
        $this->query($query);
        return $this->single(); 
    }

    public function getAllOrders(){
        $query = "SELECT * FROM $this->tableName";
        $this->query($query);
        return $this->resultSet(); 
    }
    public function getOrdersById($userId){
        $query = "SELECT * FROM $this->tableName where user_id = $userId";
        $this->query($query);
        return $this->resultSet(); 
    }
    public function deleteOrder($id){
        $query = "DELETE FROM $this->tableName WHERE id = $id";
        $this->query($query);
        return $this->execute();
    }

}