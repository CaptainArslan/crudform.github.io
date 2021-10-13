<?php
class database
{

    private $db_host = "localhost";
    private $db_user = "root";
    private $db_pass = "";
    private $db_name = "user_detail";

    private $con = false;
    private $mysqli = "";
    private $result  = array();

    //for connection
    public function __construct()
    {
        if (!$this->con) {
            $this->mysqli = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
            $this->con = true;
            if ($this->mysqli->connect_error) {
                array_push($this->result, $this->mysqli->connect_error);
                return false;
            }
        } else {
            return true;
        }
    }

    //for insertion in database
    public function insert($params = array())
    {
        // print_r($params);
        //here it gives us the error of array to strung error so we have to solve that first so for that we make "$table_column to implode" 
        $table_column = implode(',', array_keys($params));
        $table_value = implode("','", $params);
        // echo $sql = "INSERT INTO $table($table_column) VALUES ('$table_value')";
        //echo 
        $sql = "INSERT INTO tbl_userdata ($table_column) VALUES ('$table_value')";
        if ($this->mysqli->query($sql)) {
            array_push($this->result, $this->mysqli->insert_id);
            return true;
        } else {
            array_push($this->result, $this->mysqli->error);
            return false;
        }
    }




    //for updation in database
    public function update($params = array(), $id)
    {
        //print_r($params);
        $args = array();
        foreach ($params as $key => $value) {
            $args[] = " $key = '$value' ";
        }
        //print_r($args);
        //echo
        $sql  = " UPDATE tbl_userdata SET" . implode(',', $args);
        if ($id != null) {
            $sql .= " WHERE `id` = $id ";
        }
        //echo $sql;
        if ($this->mysqli->query($sql)) {
            array_push($this->result, $this->mysqli->affected_rows);
            return true;
        } 
        else {
            array_push($this->result, $this->mysqli->error);
            return false;
        }
    }





    //for deletion from database
    public function delete($id)
    {
        $sql = " DELETE FROM `tbl_userdata` WHERE `id`=$id";
        if ($this->mysqli->query($sql)) {
            array_push($this->result, $this->mysqli->affected_rows);
            return true;
        } else {
            array_push($this->result, $this->mysqli->error);
            return false;
        }
    }
    
    //for Multiple deletion from database
        public function deletemultiple($ids)
        {
            $sql = " DELETE FROM `tbl_userdata` WHERE `id` IN($ids)";
            if ($this->mysqli->query($sql)) {
                array_push($this->result, $this->mysqli->affected_rows);
                return true;
            } else {
                array_push($this->result, $this->mysqli->error);
                return false;
            }
        }



    //for Selection total  from database 
    public function select($id = null)
    {
        $sql = "SELECT * FROM tbl_userdata";
        if ($id != null) {
            $sql .= " WHERE `id`=$id ";
        }
        //echo $sql;
        $data = $this->mysqli->query($sql);
        //print_r($data);
        if ($data->num_rows > 0) {
            $alldata = array();
            while ($row = $data->fetch_assoc()) {
                $alldata[] = $row;
            }
            return $alldata;
        } else {
            //echo "No Reocrd Founds";
            return false;
        }
    }

        //for Selection or Fetch email from database 
        public function selectemail($email = null)
        {
            $sql = "SELECT * FROM tbl_userdata WHERE user_email = '$email'";
            //echo $sql;
            $data = $this->mysqli->query($sql);
            //print_r($data);
                //$alldata[] = $row;
                if ($data->num_rows > 0) {
                    echo "* Email Already Taken!";
                    echo "<script> $('#submit').attr('disabled', true); </script>";
                }else{
                    //echo "";
                    echo "<script> $('#submit').attr('disabled', false); </script>";
                }
        }

            //for Selection or Fetch email from database 
        public function duplication($email)
        {
            $sql = "SELECT * FROM tbl_userdata WHERE user_email = '$email'";
            //echo $sql;
            $data = $this->mysqli->query($sql);
            //print_r($data);
                //$alldata[] = $row;
                if ($data->num_rows > 0) {
                    $alldata = array();
                        while ($row = $data->fetch_assoc()) {
                            $alldata[] = $row;
                        }
                        return $alldata;
                }else{
                    //echo "";
                    echo "<script> $('#submit').attr('disabled', false); </script>";
                }
        }

        //for Selection or Fetch phone from database 
        public function selectphone($phone = null)
        {
            $sql = "SELECT * FROM tbl_userdata WHERE user_phone = '$phone'";
            //echo $sql;
            $data = $this->mysqli->query($sql);
            //print_r($data);
                //$alldata[] = $row;
                if ($data->num_rows > 0 ) {
                    //echo " * Phone Already Taken!";
                    //echo "<script> $('#submit').attr('disabled', true); </script>";
                }else{
                    //echo "<span>* Phone Available </span>";
                    //echo "<script> $('#submit').attr('disabled', false); </script>";
                }
        }


    public function getResult()
    {
        $val = $this->result;
        //empty result
        $this->result = array();
        return $val;
    }


    //for Close or Dissconnect Connection from database
    public function __destruct()
    {

        if (!$this->con) {
            if ($this->mysqli->close()) {
                $this->con = false;
                return true;
            }
        } else {
            return false;
        }
    }
}
