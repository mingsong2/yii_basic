<?php
namespace app\models;

use yii\db\ActiveRecord;

class Customer extends ActiveRecord{
    // 帮助顾客获取订单信息
    public function getOrders(){

        $orders = $this->hasMany(Order::className(),['customer_id' => 'id'])->asArray()->all();
        return $orders;
    }
}