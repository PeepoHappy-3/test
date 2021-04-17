<?php 
  function set_data($post, $file_path){
    $data = array();
    if(isset($post)){
      $id = uniqid(rand(0, 999), true);
      $data+=['id'=>$id];
      foreach($post as $key => $value){     
        $data+= [$key=>htmlspecialchars($value)];
      }
      if($_FILES['file']['error'] == 0){
        $data+= ['image' => $file_path];
      } else {
        $data+= ['image' => ''];
      }
      $data+=['status' => 'false'];
    } 
    return $data;
  }

  function set_mask($data){
    $mask = '(';
    foreach($data as $key => $value){
      $mask .= $key . ', ';
    }
    $mask = substr($mask, 0, -2);
    $mask .= ') values (';
    foreach($data as $key => $value){
      $mask .= ':' . $key . ', ';
    }
    $mask = substr($mask, 0, -2);
    $mask .= ')'; 
    return $mask;
  }
?>