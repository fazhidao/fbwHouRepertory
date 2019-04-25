<?php

namespace app\api\Model;

use think\Model;

//手机验证
class Phone_code extends Model
{
    //过期时间600秒
    private $expire_time = 600;

    public function createCode($phone)
    {
        $new_code = rand(100000, 999999);
        $now = time();
        $this->execute("replace into phone_code(phone, code, create_time) values($phone, $new_code, $now)");
        return $new_code;
    }

    public function validateCode($phone,$code){
        $code_in_db = $this->getCode($phone);
        if($code === $code_in_db){
            return true;
        }
        return false;
    }

    public function getCode($phone)
    {
        $code_info = $this->where('phone', $phone)->find();
        if (isset($code_info['create_time'])) {
            if ((time() - $code_info['create_time']) <= $this->expire_time) {
                return $code_info['code'];
            }
        }
        return false;
    }

}