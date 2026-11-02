<?php

/*

* 删除文件夹下$n分钟前创建的文件

* @param $dir 要处理的目录，物理路径，结尾不加\

* @param $n 过期时间，单位为分钟

* @return void

*/

function del_file_by_ctime($dir,$n){
        if(is_dir($dir)){
            if($dh=opendir($dir)){
                while (false !== ($file = readdir($dh))){
                if($file!="." && $file!=".."){
                    $fullpath=$dir."/".$file;
                    if(!is_dir($fullpath)){
                        $filedate=filemtime($fullpath);
                        $minutes=round((time()-$filedate)/60);
                        if($minutes>$n) {
                            unlink($fullpath); //删除文件
                            echo("删除成功");
                        }else{
                            echo("无可删除文件");
                        }
                    }
                }
            }
        }
        closedir($dh);
    }
}

//下面是调用的代码

//删除1天前的文件

$dir = realpath('./mp3');

del_file_by_ctime($dir, 30);

?>