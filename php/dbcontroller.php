<?php   
  function dbconnect($dbservername, $dbname, $dbusername, $dbpassword){
    try{
      $dbconnection = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
      $dbconnection->exec("set names utf8");
    } catch(PDOEsception $e){
      echo $e->getMessage();
    }
    return $dbconnection;
  }

  function load_file($uploaddir){
    $image_path = '';
    if($_FILES['file']['error'] == 0){    
      $file_name = $_FILES['file']['name'];
      $tmp_name = $_FILES['file']['tmp_name'];  
      $image_path = $uploaddir.basename($file_name);
      if(!move_uploaded_file($tmp_name,  $image_path)){
        http_response_code(500);
        throw new Exception( 'Файл не загружен. ');        
      }
    }  
    return $image_path;
  }

  function post_error($dbconnection, $dbtable, $image_path){  
    $id = uniqid(rand(0, 999), true); 
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);     
    $status = false;  
    $data = array('id'=>$id, 'name'=> $name, 'email'=> $email,'phone'=>$phone,'message'=> $message,'image'=>$image_path,'status'=> false);
    $sql_query = $dbconnection->prepare('INSERT INTO '. $dbtable .'(id, name,email,phone, message, image, status) values (:id, :name, :email, :phone, :message, :image, :status)');
    try{
      if(!$sql_query->execute($data)){
        http_response_code(500);
        throw new Exception('Запрос не отправлен'); 
      }   
      echo json_encode(array('message' => 'Запрос отправлен'));
    } catch(PDOException $e){
      echo array('message' => $e.getMessage());
    }    
  }
?> 