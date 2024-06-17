<?php
if(sizeof($argv) < 2){
	die("Please provide a version");
}
$version = trim($argv[1]);
$locales = [
    'en-US',
    'fa-IR',
    'el-GR',
    'ar-AE',
    'tr-TR',
];
$link = 'https://gpack.travian.com/'.$version.'/mainPage/lang/%s/%s';
$fileNames = ['compact.css', 'compact1.css', 'compact2.css', 'compact-lowres.css', 'lang.css'];
foreach ($locales as $l) {
    foreach ($fileNames as $filename) {
        $dl = sprintf($link, $l, $filename);
        $save = __DIR__ . DIRECTORY_SEPARATOR . $l . DIRECTORY_SEPARATOR . $filename;
        if(!is_dir(__DIR__ . DIRECTORY_SEPARATOR . $l)){
            mkdir(__DIR__ . DIRECTORY_SEPARATOR . $l);
        }
		if(is_file($save)) unlink($save);
        file_put_contents($save, file_get_contents($dl));
    }
}