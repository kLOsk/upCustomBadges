<?php
function read_dir($dir)
{
    $list = array();
    if (is_dir($dir)) {
        if ($handle = opendir($dir)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {
                    $list[] = $file;
                }
            }
        }
        closedir($handle);
    }
    
    return $list;
}
$src  = "badges";
$target = "../userpro/addons/badges/badges";
$list = read_dir($src);
foreach ($list as $key => $val) {
    //delete files from folder 
    unlink("$target/$val");
}
echo "done";
?>