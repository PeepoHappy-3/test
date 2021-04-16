<?php  
  require_once 'dbcontroller.php';

  $dbservername = "localhost";
  $dbname = "test";
  $dbusername = "admin";
  $dbpassword = "1234";
  $dbtable = "error_reports";  
  $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';    
  
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $phone = htmlspecialchars($_POST['phone']);
  $message = htmlspecialchars($_POST['message']);  
  $id = uniqid(rand(0, 999), true);
  $image_path = load_file($uploaddir);
  
  $data = array('id'=>$id, 'name'=> $name, 'email'=> $email,'phone'=>$phone,'message'=> $message,'image'=>$image_path,'status'=> false);
  $mask = '(id, name,email,phone, message, image, status) values (:id, :name, :email, :phone, :message, :image, :status)';

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