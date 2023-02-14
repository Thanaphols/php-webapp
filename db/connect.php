<?php
session_start();

function connect(){
    $GLOBALS['conn'] = mysqli_connect('localhost','root','','db_library');
    if(!$GLOBALS['conn']){
        echo 'Database  connect fail'; 
    }else{
        mysqli_set_charset($GLOBALS['conn'], 'utf8');
    }
}

function CountRow($table,$pkName,$pkValue){
    $SQL = 'SELECT * FROM '.$table.' WHERE '.$pkName.' = "'.$pkValue.'" ';
    $result = mysqli_query($GLOBALS['conn'], $SQL);
    return $result->num_rows;
}

function getData($SQL){
    $result = mysqli_query($GLOBALS['conn'], $SQL);
    $data = mysqli_fetch_assoc($result);
    return $data;
}

function runSQL($SQL){
    if(mysqli_query($GLOBALS['conn'], $SQL)) return '1';
    else return '-1';
}

function chklogin($loginURL){
    if(!isset($_SESSION['userName'])){
        echo '<meta http-equiv="refresh" content="0;url='.$loginURL.'"/>';
    }
}
?>