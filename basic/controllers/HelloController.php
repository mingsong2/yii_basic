<?php
namespace app\controllers;

use yii\web\Controller;
use yii\web\Cookie;

class HelloController extends Controller{

    /**
     * 获取请求参数
     */
    public function actionRequest(){
        
        $request = \YII::$app->request;

        $id = $request->get('id',1);

        $username = $request->post('name','jack');

        $userIp = $request->userIp;

        echo $userIp;
    }

    /**
     * 响应处理
     */
    public function actionResponse(){

        $res = \YII::$app->response;

        $res->statusCode = '404';

        $res->headers->add('pragma','no-cache');
        $res->headers->set('pragma','max-age=5');
        $res->headers->remove('pragma');

        //跳转
        $res->headers->add('location','http://baidu.com');
        $this->redirect('http://baidu.com');

        //文件下载
        $res->headers->add('content-disposition','attachment;filename=""a.jpg');
        $res->sendFile('./a.jpg');

    }

    /**
     * session处理
     */
    public function actionSession(){
        $session = \YII::$app->session;

        $session->open();
        // 判断session是否打开
        echo $session->isActive;

        // 设置session
        $session->set('user','张三');

        $session->get('user');

        $session->remove();

        $session['user'] = 'jack';
        unset($session['user']);


    }

    /**
     * cookie处理
     */
    public function actionCookie(){
        $cookies = \YII::$app->response->cookies; // YII 全局类  $app应用实体 response应用组件 cookies集合

        $arr = array(
            'name' => 'user',
            'value' => 'zhangsan'
        );
        $cookies->add(new Cookie($arr));
        $cookies->remove('user');

        // 获取请求浏览器中的cookie
        $cookies = \YII::$app->request->cookies;
        $cookies->getValue('user','jack'); //如果user不存在 则返回jack
    }

    /**
     * 视图展示，前端样式文件方在 \View\Hello\View下面
     */
    public function actionView(){
        $data = array(
            'title' => 'hello yii<script>alert(4)</script>'
        );
        return $this->renderPartial('index',$data);
    }

    /**
     * 布局文件
     */
    public $layout = 'common';
    public function actionAbout(){

        return $this->render('about');
    }
}

