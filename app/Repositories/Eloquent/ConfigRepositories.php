<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/1/12
 * Time: 17:53
 */

namespace App\Repositories\Eloquent;


use App\Models\Config;

class ConfigRepositories extends BaseRepositories
{
    public function __construct(Config $config)
    {
        $this->model=$config;
    }

    public function all()
    {
        $data = $this->model->orderBy('conf_order','asc')->get()->toArray();

        return $data;
    }

    public function find($id){
        $info=$this->model->find($id);
        return $info;
    }

    public function putConfig(){
        $str=base_path().'\config\web.php';
        $config=$this->model->pluck('conf_content','conf_name')->all();
        $data=var_export($config,true);
        $re="<?php \n return \n".$data.";";
        file_put_contents($str,$re);
    }
}