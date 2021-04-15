<?php 
  $input = file_get_contents('php://input');
  $dbservername = "localhost";
  $dbname = "test";
  $dbusername = "admin";
  $dbpassword = "1234";
  $dbtable = "error_reports";  
  $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
  $response = '';
  $image_path = '';
  
  try{
    $dbconnection = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
    $dbconnection->exec("set names utf8");
  } catch(PDOEsception $e){
    echo $e->getMessage();
  }
  try{
    if(isset($_POST)){
      if($_FILES['file']['error'] == 0){    
          $file_name = $_FILES['file']['name'];
          $tmp_name = $_FILES['file']['tmp_name'];  
          $image_path = $uploaddir.basename($file_name);
          if(move_uploaded_file($tmp_name,  $image_path)){
            $response = 'Файл загружен. ';           
          } else {           
            $response = 'Файл не загружен. ';   
            throw new Exception($response);               
          }
        }
      } else {         
          throw new Exception('Запрос не отправлен');            
      }
      $id = uniqid(rand(0, 999), true); 
      $name = $_POST['name'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $message = $_POST['message'];     
      $status = false;  
      $data = array('id'=>$id, 'name'=> $name, 'email'=> $email,'phone'=>$phone,'message'=> $message,'image'=>$image_path,'status'=> false);
      $sql_query = $dbconnection->prepare('INSERT INTO '. $dbtable .'(id, name,email,phone, message, image, status) values (:id, :name, :email, :phone, :message, :image, :status)');
      try{
        if($sql_query->execute($data)){
          $response = $response . 'Запрос отправлен';
        }
         else  
           throw new Exception('meh') ;  
         echo json_encode(array('message' => $response));
      } catch(PDOException $e){
        http_response_code(500);
        echo json_encode(array('message' => $e->getMessage()));
      }    
  } 
  catch(Esception $e){
    http_response_code(500);
    echo json_encode(array('message' => $e->getMessage()));      
  }                                                          
?>