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
$dest = "../userpro/addons/badges/badges";
$list = read_dir($src);
foreach ($list as $key => $val) {
    //copy file to new folder 
    copy("$src/$val", "$dest/$val");
}
echo "Badges have been succesfully copied. Head over to the UserPro Badges Settings to use them!";
?>
