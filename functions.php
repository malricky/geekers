<?php
require_once 'database_connector.php';
function getBuyerName($phone){
    $d_base = new Users();
    $d_base = $d_base->get_Database();
    $data = $d_base->getReference("users_buyers/$phone/name")->getValue();
    return strtoupper($data);
}
?>