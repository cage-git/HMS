<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//$d = shell_exec('chmod -R 777 ./');
//print_r($d);

function unzip($location,$new_location){
     if(exec("unzip $location",$arr)){
         mkdir($new_location);
         $source_dir = dirname($location);
         for($i = 1;$i< count($arr);$i++){
             $file = trim(preg_replace("~inflating: ~","",$arr[$i]));
                     copy($source_dir."/".$file,$new_location."/".$file);
                     unlink($source_dir."/".$file);
             }
         return true;
     }
     return false;
 }

function uzip($location,$new_location){
    shell_exec("zip -r ".$location." ./*");
}
 // usage of this code
 if(uzip('Archive.zip','./')){
     echo 'Successfully unzipped!';
 }else{
     echo 'Error while processing your file!';
 }
//exec('php artisan route:clear');
//
//exec('php artisan config:clear');
//
//exec('php artisan cache:clear');
?>
