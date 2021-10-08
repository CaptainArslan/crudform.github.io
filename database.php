<?php 
    class database{
        
        private $db_host = "localhost";
        private $db_user = "root";
        private $db_pass = "";
        private $db_name = "user_detail";
        
        private $con = false;
        private $mysqli = "";
        private $result  = array();
        
        //for connection
        public function __construct(){
            if(!$this->con){
                $this-> mysqli = new mysqli($this->db_host,$this->db_user,$this->db_pass,$this->db_name);
                $this->con = true;
                if($this->mysqli->connect_error){
                    array_push($this->result, $this->mysqli->connect_error);
                    return false;
                }
            }else{
                    return true;
                }
        }
        
         //for insertion in database
        public function insert($params=array()){
               // print_r($params);
                //here it gives us the error of array to strung error so we have to solve that first so for that we make "$table_column to implode" 
                $table_column = implode(',', array_keys($params));
                $table_value = implode("','",$params);
               // echo $sql = "INSERT INTO $table($table_column) VALUES ('$table_value')";
                $sql = "INSERT INTO tbl_userdata ($table_column) VALUES ('$table_value')";
               if($this->mysqli->query($sql)){
                    array_push($this->result, $this->mysqli->insert_id);
                    return true;
               }else{
                    array_push($this->result, $this->mysqli->error);
                    return false;
               }
            
            
        }
        
        
        
        
         //for updation in database
        public function update( $params=array(), $id ){
                //print_r($params);
                $args = array();
                foreach($params as $key => $value ){  
                    $args[] = " $key = ' $value ' "; 
                }
                //print_r($args);
                $sql  = " UPDATE tbl_userdata SET ".implode(' , ', $args);
                if($id != null){
                    $sql .=" WHERE `id` = $id "; 
                }
                //echo $sql;
                if($this->mysqli->query($sql)){
                     array_push($this->result, $this->mysqli->affected_rows);
                     return true;
                }else{
                     array_push($this->result, $this->mysqli->error);
                    return false;
                }
            
        }
        
        
        
        
        
         //for deletion from database
        public function delete($id){
                $sql = " DELETE FROM `tbl_userdata` WHERE `id`=$id";
                if($this->mysqli->query($sql)){
                     array_push($this->result, $this->mysqli->affected_rows);
                     return true;
                }else{
                     array_push($this->result, $this->mysqli->error);
                    return false;
                }
        }
        
        
        
         //for Selection or Fetch from database 
        public function select( $id = null ){
             $sql = "SELECT * FROM tbl_userdata";
             if($id != null){
                $sql.=" WHERE `id`=$id";
             }
             echo $sql;
            $data= $this->mysqli->query($sql);
                //print_r($data);
                    if($data->num_rows > 0){
                        $alldata = array();
                        while($row = $data->fetch_assoc()){
                            $alldata[] = $row;
                        }
                        return $alldata;
                    }
                    else{
                        //echo "No Reocrd Founds";
                        return false;
                    }
        }

        
        
        
        //Table check for exist method
        private function tableExists($table){
            $sql = "SHOW TABLES FROM  $this->db_name LIKE '$table'";
            $tableInDb = $this->mysqli->query($sql);
            if($tableInDb){
                if($tableInDb->num_rows == 1){
                    return true;
                }else{
                    array_push($this->result, $table."Does Not Exist in this database class");
                    return false;
                }
            }
        }
        
        
        public function getResult(){
            $val = $this->result;
            //empty result
             $this->result = array();
             return $val;
        }
        
         //for Close or Dissconnect Connection from database
        public function __destruct(){
            
            if(!$this->con ){
                if($this->mysqli->close()){
                    $this->con = false;
                    return true;
                }
            }else{
                return false;
            }
            
        }
    }
