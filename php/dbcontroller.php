<?php   
  function dbconnect($dbservername, $dbname, $dbusername, $dbpassword){
    try{
      $dbconnection = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
      $dbconnection->exec("set names utf8");
      return $dbconnection;
    } catch(PDOEsception $e){
      echo json_encode(array('message' => $e->getMessage()));
    }   
  }

  function load_file($uploaddir){
    $image_path = '';
    if($_FILES['file']['error'] == 0){    
      $file_name = $_FILES['file']['name'];
      $tmp_name = $_FILES['file']['tmp_name'];  
      $image_path = $uploaddir.basename($file_name);
      if(!move_uploaded_file($tmp_name,  $image_path)){     
        throw new Exception( 'Файл не загружен. ');        
      }
    }  
    return $image_path;
  }

  function post_error($dbconnection, $data){     
    $sql_query = $dbconnection->prepare('INSERT INTO '. $data['dbtable'] .$data['mask']);
    try{
      $sql_query->execute($data['data']);
      echo json_encode(array('message' => 'Запрос отправлен'));
    } catch(PDOException $e){
      http_response_code(500);    
      echo json_encode(array('message' => $e.getMessage()));
    }    
  }
?> 