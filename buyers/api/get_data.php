<?php
session_start();
require 'database_connector.php';
if(isset($_GET['func'])){
    if($_GET['func'] == 'get_crop_variety' && isset($_GET['crop_type'])){
        $d_base = new Users();
        $str = "[";
        $d_base = $d_base->get_Database();
        $data = $d_base->getReference("crop_types/{$_GET['crop_type']}")->getSnapshot()->getValue();
        foreach($data as $key => $value){
            $str .= "\"".strtoupper($key)."\",";
        }
        $str = substr($str,0,(strlen($str))-1);
        $str .= "]";
        echo $str;
    }
}
?>