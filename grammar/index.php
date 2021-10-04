<?php

$array = [];

$path = dirname(__FILE__).'/';///当前目录

$handle = opendir($path); //当前目录
while (false !== ($file = readdir($handle))) { //遍历该php文件所在目录

    list($filesname,$kzm)=explode(".",$file);//获取扩展名

    if($kzm=="mp3") { //文件过滤

        if (!is_dir('./'.$file)) { //文件夹过滤

            list($chapter1,$chapter2) = explode('-',$filesname);
            $array[$chapter1][$chapter2]=$file;//把符合条件的文件名存入数组

            ksort($array[$chapter1]);
        }

    }

}

ksort($array);

//print_r($array);

$initialTracks = [];

$i = 0;
foreach ($array as $k=>$v){
    foreach($v as $vv){
        $initialTracks[$i]['metaData']['artist'] = str_replace('.mp3','',$vv);
        $initialTracks[$i]['metaData']['title'] = str_replace('.mp3','',$vv);
        $initialTracks[$i]['url'] = "https://masonyang.github.io/chinglishdoc/grammar/".$vv;
        $initialTracks[$i]['duration'] = 0;
        $i++;
    }
}

//error_log(json_encode($initialTracks),3,dirname(__FILE__).'/grammar.json');