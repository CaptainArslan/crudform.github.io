<?php
class database
{
    private $db_host = "localhost";
    private $db_user = "root";
    private $db_pass = "";
    private $db_name = "user_detail";

    private $con = false;
    private $mysqli = "";
    //private $result  = array();
    

    //for connection
    public function __construct()
    {
        if (!$this->con) 
        {
            $this->mysqli = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
            $this->con = true;
            if ($this->mysqli->connect_error) 
            {
                //array_push($this->result, $this->mysqli->connect_error);
                return false;
            }
        }
        else 
        {
            return true;
        }
    }


    //for insertion in database
    public function insert($params = array())
    {
        //print_r($params);
        //here it gives us the error of array to strung error so we have to solve that first so for that we make "$table_column to implode" 
        $table_column = implode(',', array_keys($params));
        $table_value = implode("','", $params);
        $sql = "INSERT INTO tbl_userdata ($table_column) VALUES ('$table_value')";
        if ($this->mysqli->query($sql)) 
        {
            //array_push($this->result, $this->mysqli->affected_rows);
            return true;
        } 
        else 
        {
            //array_push($this->result, $this->mysqli->error);
            return false;
        }
    }




    //for updation in database
    public function update($params = array(), $id)
    {
        $args = array();
        foreach ($params as $key => $value) 
        {
            $args[] = " $key = '$value' ";
        }
        
        $sql  = " UPDATE tbl_userdata SET" . implode(',', $args). " WHERE `id` = $id";
        //echo $sql;
        if ($this->mysqli->query($sql)) 
        {
            //array_push($this->result, $this->mysqli->affected_rows);
            return true;
        } 
        else 
        {
            return false;
        }
    }





    //for deletion from database
    public function delete($id)
    {
        $sql = " DELETE FROM `tbl_userdata` WHERE `id`=$id";
        if ($this->mysqli->query($sql)) 
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }

    //for Multiple deletion from database
       public function deletemultiple($ids)
       {
           $this->mysqli->begin_transaction();
           $checkid = true;
            foreach($ids as $value)
            {
                $sql = " DELETE FROM `tbl_userdata1` WHERE `id` = '$value' ";

                if (!$this->mysqli->query($sql))
                {
                     $checkid = false;
                     break;
                }
            }
            //echo $value;
            //check if query is working than commit it else rollback it
            if($checkid == true)
            {
                $this->mysqli->commit();
                //echo "* Data Committed!";               
                return true;
            }
            else
            {
                $this->mysqli->rollBack();
                //echo "* Data Rolled back!";
                return false;
            }
       }



    //for Selection total  from database 
    public function select($id = null)
    {
        $sql = "SELECT * FROM tbl_userdata";
        if ($id != null) 
        {
            $sql .= " WHERE `id`=$id ";
        }
        //echo $sql;
        $data = $this->mysqli->query($sql);
        //print_r($data);
        if ($data->num_rows > 0) 
        {
            $alldata = array();
            while ($row = $data->fetch_assoc()) 
            {
                $alldata[] = $row;
            }
            return $alldata;
            return true;
        } 
        else 
        {
            //echo "No Reocrd Founds";
            return false;
        }
    }


    public function login($email, $password )
    {
        $sql = "SELECT * FROM tbl_userdata WHERE user_email = '$email' ";
        //echo $sql;
        $data = $this->mysqli->query($sql);
            if ($data->num_rows > 0)
            {
                $row = mysqli_fetch_assoc($data);
                $db_pass = $row['user_password'];
                if($db_pass === $password)
                {
                    $_SESSION['email'] = $row['user_email'];
                    $_SESSION['name'] = $row['user_firstname'];
                    return true;
                }
            }
            else
            {
                return false;
            }
    }

                                 //CHECK DUPLICATE DATA IN ADD USERS FILE FOR SERVER SIDE VALIDATION

        //for Selection or Fetch email from database for update user in PHP
        public function duplication($email, $userid = null)
        {
            $sql = "SELECT * FROM tbl_userdata WHERE user_email = '$email'";
            if($userid != null )
            {
                $sql .= "and id != '$userid'";
            }
            //echo $sql;
            $data = $this->mysqli->query($sql);
                if ($data->num_rows > 0)
                {
                    return true;
                }
                else
                {
                    return false;
                }
        }


    //for Close or Dissconnect Connection from database
    public function __destruct()
    {
        if($this->con)
        {
            if ($this->mysqli->close()) 
            {
                $this->con = false;
            }
        }
    }
}
