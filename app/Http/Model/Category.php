<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'cate_id';
    public $timestamps = false;
    protected $guarded=[];

    /* public static function tree()
     {
         $category=Category::all();
         return (new Category)->getTree($category,'cate_name','cate_id','cate_pid');
     }*/
    public function tree()
    {
        $category = $this->orderBy('cate_order','asc')->get();
        return $this->getTree($category, 'cate_name', 'cate_id', 'cate_pid');
    }

    public function getTree($data, $field_name, $field_id = 'id', $field_pid = 'pid', $pid = 0)
    {
        $arr = array();
        foreach ($data as $key => $value) {
            //cate_pid为0
            if ($value->$field_pid == $pid) {
                //echo $value->cate_name;
                $data[$key]["_" . $field_name] = '' . $data[$key][$field_name];
                $arr[] = $data[$key];
                foreach ($data as $m => $n) {
                    if ($n->$field_pid == $value->$field_id) {
                        $data[$m]["_" . $field_name] = '╞═ ' . $data[$m][$field_name];
                        $arr[] = $data[$m];
                    }
                }
            }
        }
        //dd($arr);
        return $arr;
    }
}
