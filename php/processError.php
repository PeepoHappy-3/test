<?php  
  require_once 'dbcontroller.php';

  $dbservername = "localhost";
  $dbname = "test";
  $dbusername = "admin";
  $dbpassword = "1234";
  $dbtable = "error_reports";  
  $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
  $response = '';
  $image_path = ''; 

  function exception_handler($exception){
    http_response_code(500);
    echo json_encode(array('message' => $exception->getMessage()));
  }
  set_exception_handler('exception_handler');
  //dbconnect($dbservername,  $dbname, $dbusername, $dbpassword);
  try{
    post_error(dbconnect($dbservername,  $dbname, $dbusername, $dbpassword), $dbtable, load_file($uploaddir));
  }
  catch(Exception $e){
   
  }                                                         
?>