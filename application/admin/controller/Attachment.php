<?php

namespace app\admin\controller;
use app\admin\controller\Admin;

class Attachment extends Admin
{
    /**
     * 上传图片
     *
     * @return \think\Response
     */
    public function upload()
    {
        if($this->request->isAjax() && $this->request->isPost()){
            if(!$this->request->param('type')){
                return ['status'=>'fail', 'msg'=>'请添加上传类型,例如：image-图片,video-视频,text-文本文件'];
            }

            $file = $_FILES['file'];

            //获取文件扩展名
            //$type = strtolower(substr($name,strrpos($file['name'],'.')+1));
            $type = fileext(safe_replace($file['name']));
            //重命名
            $filename = self::getname($type);

            //获取允许上传的文件类型
            // if(empty($alowexts) || $alowexts == '') {
            //     $site_setting = $this->_get_site_setting($this->siteid);
            //     $alowexts = $site_setting['upload_allowext'];
            // }
            //定义允许上传的类型
            $allow_type = array('jpg','jpeg','gif','png'); 

            //判断文件类型是否被允许上传
            if(!in_array($type, $allow_type)){
                //如果不被允许，则直接停止程序运行
                $result = ['status'=>'fail',"code"=>2004,"msg"=>"文件格式不正确"];
                return json_encode($result);
            }

            //判断上传文件大小  不能超过
            if($file['size']>1048576){
               $result = ['status'=>'fail',"code"=>2006,"msg"=> '文件大小不超过' . self::size($file['size'])];
                return json_encode($result);
            }

            //判断是否是通过HTTP POST上传的
            if(!self::isuploadedfile($file['tmp_name'])){
                //如果不是通过HTTP POST上传的
                return ['status'=>'fail', 'mesg'=>'请选择post方式上传！'];
            }

            $upload_path = ROOT_PATH . 'public' . DS . 'uploads' . DS . date("Y",time()) . DS . date("md",time());

            if(!is_dir($upload_path)){
                $res=mkdir($upload_path,0777,true);
            }

            //上传文件的存放路径
            $upload_path = $upload_path . DS . $filename; 
            
            //开始移动文件到相应的文件夹
            $info =move_uploaded_file($file['tmp_name'],$upload_path);

            if($info){

                $imgurl = str_replace('\\', '/', $upload_path);
                
                $imgurl= $this->request->domain() . explode("public",$imgurl)['1'];

                $result = ['status'=>'success',"code"=>2000,"msg"=>"上传成功","imgurl"=>$imgurl];
                return json_encode($result);
            }else{
                $result = ['status'=>'fail',"code"=>2009,"msg"=>"网络不好"];
                return json_encode($result);
            }

        }else{
          return  ['status'=>'fail', 'mesg'=>'请选择post方式上传！'];
        }
    }

    /**
     * 获取附件名称
     * @param $fileext 附件扩展名
     */
    private function getname($fileext){
        return date('Ymdhis').rand(100, 999).'.'.$fileext;
    }

    /**
     * 返回附件大小
     * @param $filesize 图片大小
     */
    
    private function size($filesize) {
        if($filesize >= 1073741824) {
            $filesize = round($filesize / 1073741824 * 100) / 100 . ' GB';
        } elseif($filesize >= 1048576) {
            $filesize = round($filesize / 1048576 * 100) / 100 . ' MB';
        } elseif($filesize >= 1024) {
            $filesize = round($filesize / 1024 * 100) / 100 . ' KB';
        } else {
            $filesize = $filesize . ' Bytes';
        }
        return $filesize;
    }
    /**
    * 判断文件是否是通过 HTTP POST 上传的
    *
    * @param    string  $file   文件地址
    * @return   bool    所给出的文件是通过 HTTP POST 上传的则返回 TRUE
    */
    private function isuploadedfile($file) {
        return is_uploaded_file($file) || is_uploaded_file(str_replace('\\\\', '\\', $file));
    }
    /**
     * 是否允许上传
     */
    private function is_allow_upload() {
        if($_groupid == 1) return true;
        $starttime = SYS_TIME-86400;
        $site_setting = $this->_get_site_setting($this->siteid);
        return ($uploads < $site_setting['upload_maxsize']);
    }
}
