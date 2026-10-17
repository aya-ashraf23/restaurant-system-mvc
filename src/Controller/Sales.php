<?php
namespace Aslam\Test\Controller;

use Aslam\Test\Model\Category;
use Aslam\Test\Model\Menu;
use Aslam\Test\Model\Order;
use Aslam\Test\public\Session;
use Aslam\Test\View;

class Sales {
    private $savedCategories;
    private $savedMenus;
    private $newOrder;
    
    public function __construct(){
        $this->savedCategories = new Category;
        $this->savedMenus = new Menu;
        $this->newOrder = new Order;
    }
    public function index(){
        $allCategories = $this->savedCategories->getAllCategories();
        $allMenus = $this->savedMenus->getAllMenus();
        View::render("sales.php" , ['allCategories' => $allCategories , 'allMenus' => $allMenus]);
    }

    public function makeOrder(){
        $orderData = filter_input_array(INPUT_POST);
        echo $this->newOrder->placeOrder($orderData);
        
    }

    public function createReceipt($orderId){  // we need order details & order_item details
        $orderList = $this->newOrder->getOrderDetails($orderId);
        $orderItem = $this->newOrder->getOrderItemDetails($orderId);
        $processedBy = Session::getSession('user_name');
        View::Render('receipt.php', ['orderList'=> $orderList , 'orderItem'=> $orderItem , 'processedBy'=> $processedBy]);
    }
}


