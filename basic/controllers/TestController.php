<?php
namespace app\controllers;

use yii\web\Controller;
use app\models\Test;
use app\models\Customer;
use app\models\Order;

class TestController extends Controller{

    // 数据首页
    public function actionIndex(){  
        echo 111;exit;
        $test = new Test;
        $test->id =1;
        $test->title = 'title1';
        $res = $test->save();
        echo $res;
    }
    // 数据的修改
    public function actionEdit(){


    }

    // 关联查询，一对多，(根据顾客查询他的订单信息)
    public function actionGetOrder(){
        $customer = Customer::find()->where(['id' => 1])->one();
        // $orders = $customer->hasMany('app\models\Order',['customer_id' => 'id'])->asArray()->all();

        // $orders = $customer->hasMany(Order::className(),['customer_id' => 'id'])->asArray()->all();

        // $orders = $customer->getOrders();  

        /**
         * $order是customer实例的属性，由于在app\models\Order类中并没有定义$order属性，
         * 所以会自动触发__get()方法，而__get方法会自动去调用get方法并在后面加上orders,
         * 所以当使用$customer->orders时，其实就是在调用customer中的getOrders方法
         */
        $orders = $customer->$orders; 
        
    }

    // 关联查询 一对一，(根据订单查询客户信息)
    public function actionGetCustomer(){
        $order = Order::find()->where(['id' =>1])->one();

        $order->getCustomer();
    }

    // 关联查询的多次查询
    public function actionMultiQuery(){
        // 相当于 
        // select * from customer 
        // select * from order where customer_id in(...)
        $customer = Customer::find()->with('orders')->all();  // with('orders) 其实就是访问app\models\customer的属性 由于orders属性不存在，所以其实就是访问customer的getOrders方法
        
    }
}