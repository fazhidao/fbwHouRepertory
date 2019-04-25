<?php


/* 
 * APP微信支付 
 */


class WeixinPay {


    protected $mch_id;
    protected $key;
    protected $out_trade_no;
    protected $body;
    protected $total_fee;
    protected $attach;
    function __construct($out_trade_no=null,$body=null,$total_fee=null,$attach=null) {
        $this->appid = 'wxf997d3472711cafb';
        $this->mch_id = '1526481241';
        $this->key = 'skdjwi27sud826syw7281kwisj27wj28';
        $this->out_trade_no = $out_trade_no;
        $this->body = $body;
        $this->total_fee = $total_fee;
        $this->attach = $attach;
    }

    //app接口
    public function pay() {
        //统一下单接口
        $unifiedorder = $this->unifiedorder();
        //发送错误时取消注释查看微信返回码
//        print_r($unifiedorder);return 0;
        //统一下单后给APP端str
        $parameters = array(
            'appid' => $this->appid,
            'partnerid' => $this->mch_id,
            'prepayid' => $unifiedorder['prepay_id'],
            'package' => 'Sign=WXPay',
            'timestamp' => '' . time() . '',
            'noncestr' => $this->createNoncestr()
        );
        //签名
        $parameters['sign'] = $this->getSign($parameters);
        return $parameters;
    }

    //统一下单接口
    private function unifiedorder() {
        $url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
        $parameters = array(
            'appid' => $this->appid,
            'mch_id' => $this->mch_id,
            'nonce_str' => $this->createNoncestr(),
            'body' => $this->body,
            'out_trade_no'=> $this->out_trade_no,
            'total_fee' => $this->total_fee,
            'attach' => $this->attach, //原样返回的信息
            'spbill_create_ip' => $_SERVER['REMOTE_ADDR'],
            'notify_url' => 'http://116.62.208.170/index.php/api/app/notify/wxpay',
            'trade_type' => 'APP'
        );
        //统一下单签名
        $parameters['sign'] = $this->getSign($parameters);
        $xmlData = $this->arrayToXml($parameters);
        $return = $this->xmlToArray($this->postXmlCurl($xmlData, $url, 60));
        return $return;
    }

    //作用：生成签名
    public function getSign($Obj) {
        foreach ($Obj as $k => $v) {
            $Parameters[$k] = $v;
        }
        //签名步骤一：按字典序排序参数  
        ksort($Parameters);
        $String = $this->formatBizQueryParaMap($Parameters, false);
        //签名步骤二：在string后加入KEY
        $String = $String . "&key=" . $this->key;
        //签名步骤三：MD5加密  
        $String = md5($String);
        //签名步骤四：所有字符转为大写  
        $sign = strtoupper($String);
        return $sign;
    }

    ///作用：格式化参数，签名过程需要使用
    private function formatBizQueryParaMap($paraMap, $urlencode) {
        $buff = "";
        ksort($paraMap);
        foreach ($paraMap as $k => $v) {
            if ($urlencode) {
                $v = urlencode($v);
            }
            $buff .= $k . "=" . $v . "&";
        }
        $reqPar = false;
        if (strlen($buff) > 0) {
            $reqPar = substr($buff, 0, strlen($buff) - 1);
        }
        return $reqPar;
    }

    //作用：产生随机字符串，不长于32位
    private function createNoncestr($length = 32) {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    //xml转换成数组
    private function xmlToArray($xml) {
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $xmlstring = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        $val = json_decode(json_encode($xmlstring), true);
        return $val;
    }

    //数组转换成xml
    private function arrayToXml($arr) {
        $xml = "<root>";
        foreach ($arr as $key => $val) {
            if (is_array($val)) {
                $xml .= "<" . $key . ">" . arrayToXml($val) . "</" . $key . ">";
            } else {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
            }
        }
        $xml .= "</root>";
        return $xml;
    }

    private static function postXmlCurl($xml, $url, $second = 30)
    {
        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, $second);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); //严格校验
        //设置header
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //post提交方式
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);


        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($ch, CURLOPT_TIMEOUT, 40);
        set_time_limit(0);


        //运行curl
        $data = curl_exec($ch);
        //返回结果
        if ($data) {
            curl_close($ch);
            return $data;
        } else {
            $error = curl_errno($ch);
            curl_close($ch);
            throw new WxPayException("curl出错，错误码:$error");
        }
    }

}  