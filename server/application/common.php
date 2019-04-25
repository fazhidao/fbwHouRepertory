<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

//对结果json化
function Common_jsonRes($status,$data=null){
    if(is_array($status)) {
        $arr = array(
            'status' => $status[0],
            'data' => isset($status[1])?$status[1]:'',
        );
    }else {
        $arr = array(
            'status' => $status,
            'data' => $data,
        );
    }
    if($arr['status']==0&&$arr['data']==null){
        $arr['data'] = '服务器错误';
    }
    return json_encode($arr, 320);
}


function Common_uploadFile($class){
    if( isset($_FILES['file']) ) {
        $dir = __DIR__ . "/../public/uploads/$class/";
        is_dir($dir) OR mkdir($dir, 0777, true);
        if ($_FILES["file"]["error"] <= 0) {
            $ext = substr($_FILES["file"]["name"], strrpos($_FILES["file"]["name"], '.'));
            $filename = md5(time() . $_FILES["file"]["name"]) . $ext;
            $res = move_uploaded_file($_FILES["file"]["tmp_name"], $dir . $filename);
            if($res)
                return $class.'/'.$filename;
        }
    }
    return 0;
}


//根据费用规则计算所需费用
function Common_calculate($rule){
    //    $law_list = [
    //        [10000, 50],
    //        [500000, 0.01 * 1.5],
    //        [5000000, 0.01 * 1],
    //        [10000000, 0.01 * 0.5],
    //        [0, 0.01 * 0.1],
    //    ];
    //如上为费用规则，[规则额度,费率]
    $res = 0;
    $len = count($rule);
    for($i=0; $i<$len; $i++){
        if($_POST['money'] <= $rule[$i][0] || $rule[$i][0] == 0){
            if($i == 0) {
                $res += $rule[$i][1];
            }else{
                $res += ($_POST['money'] - $rule[$i-1][0]) * $rule[$i][1];
            }
            break;
        }else{
            if($i == 0) {
                $res += $rule[0][1];
            }else{
                $res += ($rule[$i][0] - $rule[$i-1][0]) * $rule[$i][1];
            }
        }
    }
    return $res;
}