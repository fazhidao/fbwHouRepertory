<?php
namespace app\api\controller;
header('Access-Control-Allow-Origin:*');

require __DIR__.'/SignatureHelper.php';

use think\Controller;
use app\api\model\Phone_code;
use Aliyun\DySDKLite\SignatureHelper;


class Sms extends Controller
{
    private $accessKeyId = 'LTAIzrvzqiPFrmc0';
    private $accessKeySecret = '5u2S4dYzqQqmvHScIJWeV9MLZ8XJHg';
    private $SignName = '法之道';

    public function index(){
        echo 'sms';
    }

    public function getCode(){
        $code_model = new Phone_code();
        $phone = $_POST['phone'];
        $code = $code_model->createCode($phone);
        $res = $this->sendSms($phone,'SMS_157210303','{"code":"'.$code.'"}');
        if($res->Message == 'OK'){
            return Common_jsonRes(1);
        }
        return Common_jsonRes(0,$res->Message);
    }

    private function sendSms($phone,$TemplateCode,$TemplateParam) {

        $params = array ();

        // *** 需用户填写部分 ***
        // fixme 必填：是否启用https
        $security = false;

        $accessKeyId = $this->accessKeyId;
        $accessKeySecret = $this->accessKeySecret;

        $params["PhoneNumbers"] = $phone;

        $params["SignName"] = $this->SignName;

        $params["TemplateCode"] = $TemplateCode;

        $params['TemplateParam'] = $TemplateParam;

        // fixme 可选: 设置发送短信流水号
        $params['OutId'] = time();

        // fixme 可选: 上行短信扩展码, 扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段
        $params['SmsUpExtendCode'] = "1234567";


        // *** 需用户填写部分结束, 以下代码若无必要无需更改 ***
        if(!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
            $params["TemplateParam"] = json_encode($params["TemplateParam"], JSON_UNESCAPED_UNICODE);
        }

        // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
        $helper = new SignatureHelper();

        // 此处可能会抛出异常，注意catch
        $content = $helper->request(
            $accessKeyId,
            $accessKeySecret,
            "dysmsapi.aliyuncs.com",
            array_merge($params, array(
                "RegionId" => "cn-hangzhou",
                "Action" => "SendSms",
                "Version" => "2017-05-25",
            )),
            $security
        );

        return $content;
    }

    private function sendBatchSms($phone_list) {

        $params = array ();

        // *** 需用户填写部分 ***
        // fixme 必填：是否启用https
        $security = false;

        $accessKeyId = $this->accessKeyId;
        $accessKeySecret = $this->accessKeySecret;

        // 必填: 待发送手机号。支持JSON格式的批量调用，批量上限为100个手机号码,批量调用相对于单条调用及时性稍有延迟,验证码类型的短信推荐使用单条调用的方式
        $params["PhoneNumberJson"] = $phone_list;

        $params["SignNameJson"] = array(
            $this->SignName
        );

        // fixme 必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $params["TemplateCode"] = "SMS_1000000";

        // fixme 必填: 模板中的变量替换JSON串,如模板内容为"亲爱的${name},您的验证码为${code}"时,此处的值为
        // 友情提示:如果JSON中需要带换行符,请参照标准的JSON协议对换行符的要求,比如短信内容中包含\r\n的情况在JSON中需要表示成\\r\\n,否则会导致JSON在服务端解析失败
        $params["TemplateParamJson"] = array(
            array(
                "name" => "Tom",
                "code" => "123",
            ),
            array(
                "name" => "Jack",
                "code" => "456",
            ),
        );

        // todo 可选: 上行短信扩展码, 扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段
        // $params["SmsUpExtendCodeJson"] = json_encode(array("90997","90998"));


        // *** 需用户填写部分结束, 以下代码若无必要无需更改 ***
        $params["TemplateParamJson"]  = json_encode($params["TemplateParamJson"], JSON_UNESCAPED_UNICODE);
        $params["SignNameJson"] = json_encode($params["SignNameJson"], JSON_UNESCAPED_UNICODE);
        $params["PhoneNumberJson"] = json_encode($params["PhoneNumberJson"], JSON_UNESCAPED_UNICODE);

        if(!empty($params["SmsUpExtendCodeJson"]) && is_array($params["SmsUpExtendCodeJson"])) {
            $params["SmsUpExtendCodeJson"] = json_encode($params["SmsUpExtendCodeJson"], JSON_UNESCAPED_UNICODE);
        }

        // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
        $helper = new SignatureHelper();

        // 此处可能会抛出异常，注意catch
        $content = $helper->request(
            $accessKeyId,
            $accessKeySecret,
            "dysmsapi.aliyuncs.com",
            array_merge($params, array(
                "RegionId" => "cn-hangzhou",
                "Action" => "SendBatchSms",
                "Version" => "2017-05-25",
            )),
            $security
        );

        return $content;
    }
}