<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/1/9
 * Time: 15:08
 */

namespace App\Repositories\Presenter;


class CatePresenter
{
    public function getCate($cate){
        $str='';
        foreach ($cate as $key=>$v){
            $str .= "<tr>
                    <td class='tc'>
                        <input type='text' onchange='changeOrder(this,{$v['cate_id']})' value='{$v['cate_order']}'>
                    </td>
                    <td class='tc'>{$v['cate_id']}</td>
                    <td>
                        <a href='#'>{$v['cate_name']}</a>
                    </td>
                    <td>{$v['cate_title']}</td>
                    <td>{$v['cate_keywords']}</td>
                    <td>{$v['cate_description']}</td>
                    <td>{$v[' cate_view']}</td>
                    <td>
                        <a href='".url('admin/category/'.$v['cate_id'].'/edit')."'>修改</a>
                        <a href='javascript:;' onclick='delCate({$v['cate_id']})'>删除</a>
                    </td>
                </tr>";
            if(!empty($v['son'])){
                $str.=self::getCate($v['son']);
            }
        }
        return $str;
    }
}