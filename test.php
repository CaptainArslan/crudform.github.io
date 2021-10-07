<?php 
    include("database.php");
    $obj = new database();
    //$obj->insert('tbl_userdata',['user_firstname'=>'M Arslan','user_gender'=>'male','user_email'=>'mughalarslan996@gmail.com','user_password'=>'12345678','user_phone'=>'03177638978','user_address'=>'Fazal Town', 'user_status'=>'Active' ]);
    //echo "Insert Result is : ";
    //print_r($obj-> getResult());
    
   // $obj->update('tbl_userdata',['user_firstname'=>'haseeb','user_gender'=>'male','user_email'=>'haseeb@gmail.com','user_password'=>'123','user_phone'=>'03177638978','user_address'=>'Gujranwala', 'user_status'=>'Deactive' ], 'id = "82" ');
   // echo "Update Result is : ";
   // print_r($obj-> getResult());
    
    //$obj->delete('tbl_userdata');
    //echo "<br>Delete Result is : ";
    //print_r($obj-> getResult());
    
  $obj = new database();
  $result=$obj->select('tbl_userdata');
  echo '<pre>';
  print_r($result);
?>