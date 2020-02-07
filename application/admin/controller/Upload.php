<?php

namespace app\admin\controller;
use app\admin\controller\Admin;
use think\Request;

class Upload extends Admin
{
    /**
     * 上传图片
     *
     * @return \think\Response
     */
    public function image()
    {
        if($this->request->isAjax()){       
            // 获取表单上传文件 例如上传了001.jpg
            $file = $_FILES['image'];
            return $file;
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->validate(['ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                return ['status'=>'success', 'imageurl'=>'/public/uploads/'.$info->getSaveName()];
            }else{
                // 上传失败获取错误信息
                return ['status'=>'faile', 'info'=>$file->getError()];
            }
        }
    }
}
