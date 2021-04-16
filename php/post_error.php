<?php  
  require_once 'dbcontroller.php';
  require_once 'post_request_process.php';

  $dbservername = "localhost";
  $dbname = "test";
  $dbusername = "admin";
  $dbpassword = "1234";
  $dbtable = "error_reports";  
  $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';  


  $image_path = load_file($uploaddir);
  
  $data = set_data($_POST, $image_path);
  $mask = set_mask($data);

  $sql_expression = array('data' => $data, 'mask' => $mask, 'dbtable' => $dbtable );

  function exception_handler($exception){
    http_response_code(500);
    echo json_encode(array('message' => $exception->getMessage()));
  }
  set_exception_handler('exception_handler');  
  try{
    post_error(dbconnect($dbservername,  $dbname, $dbusername, $dbpassword), $sql_expression);
  }
  catch(Exception $e){
   
  }                                                         
?>