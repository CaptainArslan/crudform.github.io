<?php 
    include("database.php");
    $obj = new database();
    
  //   $conditional_array = array('user_firstname'=>'Hassan Khalid', 'user_email'=>'mughalarsla996@gmail.com', 'user_password'=>'123456789',
  //   'user_confirm_pass'=>'321654987','user_phone'=>'03177638978', 'user_address'=>'Fattomand',
  //  'user_gender'=> 'Feamle', 'user_status'=>'Javascript','user_disable'=>'');
  //   $obj->insert($conditional_array);

    // echo "Insert Result is : ";
    // print_r($obj-> getResult());
    



  // $obj->update(['user_firstname'=>'haseeb','user_gender'=>'male','user_email'=>'haseeb@gmail.com','user_password'=>'123','user_phone'=>'03177638978','user_address'=>'Gujranwala', 'user_status'=>'Deactive' ], 54);
  // echo "Update Result is : ";
  // print_r($obj-> getResult());
    



    //echo "<br>Delete Result is : ";
   //print_r($obj-> getResult());
    
    //Get Data and ID of a record and than delete this
    //if(isset($_GET['type']) && $_GET['type'] == 'delete'){
    //  $id =  $_GET['delid'];
    //     $obj->delete($id);
    // }
    
  //$obj = new database();
  //$result=$obj->select('tbl_userdata');
  //echo '<pre>';
  //print_r($result);
  


  //Get Data of a record by this code
    //  if(isset($_GET['type']) && $_GET['type'] == 'edit'){
  //     $id =  $_GET['id'];
  //      $obj->select($id);
   // }
?>