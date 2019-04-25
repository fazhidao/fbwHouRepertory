<?php
namespace app\api\Model;

use think\Model;

//法律文章
class Articles extends Model
{
    //如果传id返回单个文章
    public function getElement($filter=[]){
        if(isset($filter['id'])){
            return $this->where('id',$filter['id'])->find();
        }else {
            if ($filter != []) {
                foreach ($filter as $key => $value) {
                    if($key == 'title'){
                        $this->where($key,'like', "%$value%");
                    }else {
                        $this->where($key, $value);
                    }
                }
            }
            $page_size = isset($_POST['page_size']) ? $_POST['page_size'] : 50;
            return $this->field(['id', 'title', 'type', 'is_show', 'create_time',
                'views','abstract','title_picture','tag','tag_color','push_times'])
                ->order('create_time desc')->paginate($page_size);
        }
    }

    public function getTitle($id)
    {
        $this->field('title');
        $this->where('id',$id);
        $res = $this->find();
        return $res;
    }

    public function addElement($data)
    {
        $res = $this->insertGetId($data);
        return $res;
    }

    public function setElement($id,$data)
    {
        return $this->save($data,['id'=>$id]);
    }

    public function delElement($id)
    {
        return $this->destroy($id);
    }

    //首页数据
    public function appGetData($type,$limit=3){
        $this->limit($limit);
        $this->order('create_time desc');
        $this->order('views desc');
        $this->where('type',$type);
        $this->where('is_show',1);
        return $this->select();
    }

    public function addReader($id){
        return $this->where('id',$id)->setInc('views');
    }

    public function addPush($id){
        return $this->where('id',$id)->setInc('push_times');
    }
}