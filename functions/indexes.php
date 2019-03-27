<?php
include_once( '../config.php' );

/**********************
一个简单的目录递归函数
第一种实现办法：用dir返回对象
***********************/
function tree($directory,$ignore) { 
    if(is_dir($directory)) {
        //返回一个 Directory 类实例
        $mydir = dir($directory);
        echo "<ul>\n";
        //从目录句柄中读取条目
        while($file = $mydir->read()) {
	        if(array_search($file,$ignore)) {
			    continue;
		    }
            if(is_dir("$directory/$file") && $file != "." && $file != "..") {
                echo "<li><i class='fa fa-folder-open'></i> <font color=\"#FF5722\"><b>$file</b></font></li>\n";
                //递归读取目录 
                tree("$directory/$file",$ignore);
            } elseif ($file != "." && $file != "..") {
	            $uri =  $_SERVER["REQUEST_URI"];
				$uri = dirname($uri);
				$uri = str_replace("/functions","",$uri);
				//echo $uri;
				//exit;
	            $filepath = "$directory/$file";
	            $url = $uri.'/'.$directory.'/'.$file;
	            $url = str_replace("../","",$url);
                echo "<li><i class='fa fa-file-text-o'></i> <a href = '$url' target = '_blank'>$url</a></li>\n";
            }

        }
        echo "</ul>\n";
        // 释放目录句柄
        $mydir->close();
    } else {
        echo $directory . '<br>';
    }

} 
//开始运行
tree("..",$ignore); 