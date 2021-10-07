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
        public function insert($table, $params=array() ){
            //check does table Exist or not
            if($this->tableExists($table)){
               // print_r($params);
                
                //here it gives us the error of array to strung error so we have to solve that first so for that we make "$table_column to implode" 
                $table_column = implode(',' , array_keys($params));
                $table_value = implode("','" ,$params);
               // echo $sql = "INSERT INTO $table($table_column) VALUES ('$table_value')";
               $sql = "INSERT INTO $table($table_column) VALUES ('$table_value')";
               if($this->mysqli->query($sql)){
                    array_push($this->result, $this->mysqli->insert_id);
                    return true;
               }else{
                    array_push($this->result, $this->mysqli->error);
                    return false;
               }
            }else{
                return false;
            }
            
        }
        
        
        
        
         //for updation in database
        public function update($table, $params=array(),$where = null ){
            if($this->tableExists($table)){
                //print_r($params);
                $args = array();
                foreach($params as $key => $value ){
                    $args[] = " $key = ' $value ' "; 
                }
                //print_r($args);
                $sql  = " UPDATE $table SET ".implode(' , ', $args);
                if($where != null){
                    $sql .=" WHERE $where "; 
                }
                //echo $sql;
                if($this->mysqli->query($sql)){
                     array_push($this->result, $this->mysqli->affected_rows);
                     return true;
                }else{
                     array_push($this->result, $this->mysqli->error);
                    return false;
                }
            }else{
                return false;
            }
        }
        
        
        
        
        
         //for deletion from database
        public function delete($table, $where = null ){
             if($this->tableExists($table)){
                $sql = " DELETE FROM $table ";
                if($where != null){
                    $sql.= " WHERE $where ";
                }//echo $sql;
                if($this->mysqli->query($sql)){
                     array_push($this->result, $this->mysqli->affected_rows);
                     return true;
                }else{
                     array_push($this->result, $this->mysqli->error);
                    return false;
                }
             }else{
                return false;
             }
        }
        
        
        
         //for Selection or Fetch from database 
         
        public function select($table){
            if($this->tableExists($table)){
             echo $sql = "SELECT * FROM $table ";
            $alldata = $this->mysqli->query($sql);
                print_r($alldata);
                
            
            }else{
                 array_push($this->result, $this->mysqli->error);
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
?>