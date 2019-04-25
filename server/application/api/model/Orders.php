<?php
namespace app\api\Model;

use think\Model;
use think\Loader;

//系统基础字段
class Orders extends Model
{

    //支付宝支付
    public function createAlipayOrder($user_id,$goods_info){
        include_once __DIR__.'/../sdk/alipay-sdk/AopSdk.php';

        $order_info = $this->createOrder($user_id,$goods_info);
        $c = new \AopClient;
        $biz_content = [
            'subject'=> $goods_info['title'],
            'out_trade_no'=> $order_info['order_id'],
            'total_amount'=>  $goods_info['price']/100, //-app_debug-
            'product_code'=> 'QUICK_MSECURITY_PAY',
            'passback_params'=> $goods_info['passback_params'],//异步通知原样返回的信息
        ];
        $content = json_encode($biz_content);

        /**公共参数**/
        $param = array();
        $param['app_id'] = $c->appId;//支付宝分配给开发者的应用ID
        $param['method'] = 'alipay.trade.app.pay';//接口名称
        $param['charset'] = 'utf-8';//请求使用的编码格式
        $param['sign_type'] = 'RSA2';//商户生成签名字符串所使用的签名算法类型
        $param['timestamp'] = date("Y-m-d H:i:s");//发送请求的时间，格式"yyyy-MM-dd HH:mm:ss"
        $param['version'] = '1.0';//调用的接口版本，固定为：1.0
        $param['notify_url'] = 'http://116.62.208.170/index.php/api/app/notify/alipay';//支付宝服务器主动通知地址
        $param['biz_content'] = $content;//业务请求参数的集合,长度不限,json格式
        /**公共参数**/

        //生成签名
        $paramStr = $c->getSignContent($param);
        $sign = $c->alonersaSign($paramStr, $c->rsaPrivateKey, 'RSA2');

        $param['sign'] = $sign;
        return $c->getSignContentUrlencode($param);
    }

    public function checkAlipayOrder($data){
        include_once __DIR__.'/../sdk/alipay-sdk/AopSdk.php';
        $c = new \AopClient;
        return $c->rsaCheckV1($data, NULL, "RSA2");
    }

    //微信支付
    public function createWxpayOrder($user_id,$goods_info){
        include_once __DIR__.'/../sdk/wxpay/WeixinPay.php';

        $order_info = $this->createOrder($user_id,$goods_info);
        $weixinpay = new \WeixinPay(
            $order_info['order_id'],
            $goods_info['title'],
            $goods_info['price'],
            $goods_info['attach']
        );
        $order_str = $weixinpay->pay();
        return $order_str;
    }

    public function checkWeixinOrder($data){
        include_once __DIR__.'/../sdk/wxpay/WeixinPay.php';
        $weixinpay = new \WeixinPay();
        $remote_sign = $data['sign'];
        unset($data['sign']);
        $sign = $weixinpay->getSign($data);
        if($sign == $remote_sign){
            return true;
        }
        return false;
    }

    public function updateOrder($order_id,$data){
        return $this->where('order_id', $order_id)->update($data);
    }

    public function getOrder($id){
        return $this->where('order_id',$id)->find();
    }

    private function createOrder($user_id,$goods_info){
        $order_info = [
            'order_id' => md5($user_id.time()),
            'subject' => $goods_info['title'],
            'user_id' => $user_id,
            'goods_id' => $goods_info['id'],
            'total_amount' => $goods_info['price'],
        ];
        $res = $this->save($order_info);
        if($res){
            return $order_info;
        }else{
            echo Common_jsonRes(0,'数据库保存订单失败');
            exit;
        }
    }

    public function getList($filter){
        foreach ($filter as $key=>$value){
            $this->where($key, $value);
        }
        $this->field('orders.order_id, subject, orders.status, total_amount, pay_amount, pay_time, 
            orders.create_time, name, email, user_id');
        $this->join('users','user_id = users.id');
        $page_size = isset($_POST['page_size']) ? $_POST['page_size'] : 50;
        return $this->order('orders.create_time','desc')->paginate($page_size);
    }

    public function getReports($old_report_time,$new_report_time){
        $this->field('sum(total_amount) total');
//        $this->where('create_time','>',date('Y-m-d 00:00:00',strtotime("-1 day")));
        $this->where('status',1);
        $this->where('create_time','>',$old_report_time);
        $this->where('create_time','<=',$new_report_time);
        $res = $this->find();
        return $res->total;
    }
}