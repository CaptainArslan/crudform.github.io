<?php
session_start();
ob_start();

//include("include/header.php");
//include("dbcon.php");
include("database.php");
$obj = new database();

// For Delete Single Record function
if (isset($_GET['type']) && $_GET['type'] == 'delete') 
{
    $id =  $_GET['delid'];
    
    if ($obj->delete($id)) {
        $_SESSION['message'] = "* Record Deleted Successfully ";
    } else {
        $_SESSION['message'] = "* Something Went Wrong While deleting Data From database ";
    }
}


//For Multiple Record Deletion Function
if (isset($_POST['delete_selected'])) 
{
    
    if(isset($_POST['myCheck']) && $_POST['myCheck'] != "" )
    {
        $delete_value = $_POST['myCheck'];
        foreach($_POST['myCheck'] as $ids)
        {
                $obj->delete($ids);
        }
        //$ids = implode(",", $delete_value);
        if ($obj->delete($ids)) 
        {
            $_SESSION['message'] = "* Record Deleted Successfully ";
        } 
        else 
        {
            $_SESSION['message'] = "* Error Occured While Record Deletion ";
        }
    }
    else
    {
        $_SESSION['message'] = "* Please Select a Record to Delete!";
    }
}


//To Following line of code is used to Show All Data
$result = $obj->select();
//This pre will tell us about the Index which we set under this in the table body
//echo '<pre>';
//print_r($result);

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>User Data</title>

    <script type="text/javascript">
        var selectall = document.getElementById("allcheckbox");

        function checkboxselect() 
        {
            var selectall = document.getElementById("allcheckbox");
            if (selectall.checked == true) {
                var ele = document.getElementsByName('myCheck[]');
                for (var i = 0; i < ele.length; i++) 
                {
                    if (ele[i].type == 'checkbox')
                        ele[i].checked = true;
                }
            } 
            else 
            {
                var ele = document.getElementsByName('myCheck[]');
                for (var i = 0; i < ele.length; i++) 
                {
                    if (ele[i].type == 'checkbox')
                        ele[i].checked = false;
                }
            }
        }
        
        function isChecked()
        {
            if($('input[type=checkbox]:checked').length > 0)
            {
                var result = confirm("Are you sure to delete selected users?");
                if(result)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                swal(" Please Select record to delete.");
                //alert('Select at least 1 record to delete.');
                return false;
            }
        }
        
        $(document).ready(function() 
            {
                $('#tbl_data').DataTable( 
                {
                    "order": [[ 3, "desc" ]]
                });
            });
    </script>
</head>

<body>
    <?php
    if (isset($_SESSION['message'])) {
    ?>
        <div class="container ">
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><?php echo $_SESSION['message'];
                                unset($_SESSION['message']); ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } ?>

    <div class="container mb-5">
        <div class="row">
            <div class="col-md-12 mt-3">
                <form action="index.php" method="POST">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                PHP CRUD OPERATIONS
                                <a href="addusers.php" class="btn btn-primary  float-end">Register/add</a>
                                <button type="submit" class="btn btn-danger float-end ms-1" id="delete_selected" name="delete_selected" onclick="return isChecked()">Delete Selected</button>
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table caption-top" id="tbl_data">
                                <caption>List of users</caption>
                                <thead class="table-dark">
                                    <tr>
                                        <th> <input type="checkbox" name="selectall"  id="allcheckbox" onclick="checkboxselect()" /> </th>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Password</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Cources</th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">Disable</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result) {
                                        $sr = 0;
                                        foreach ($result as $list) {
                                        ?>
                                            <tr>

                                                <td> <input type="checkbox" id="<?php echo $list['id']; ?>" class="chk" name="myCheck[]" value="<?php echo $list['id']; ?>" /></td>
                                                <th scope="row"><?php echo  $list['id'] ; ?></th>
                                                <td><?php echo $list['user_firstname']; ?></td>
                                                <td><?php echo $list['user_email']; ?></td>
                                                <td><?php echo $list['user_password']; ?></td>
                                                <td><?php echo $list['user_phone']; ?></td>
                                                <td><?php echo $list['user_address']; ?></td>
                                                <td><?php echo $list['user_status']; ?></td>
                                                <td><?php echo $list['user_gender']; ?></td>
                                                <td><?php echo $list['user_disable']; ?></td>
                                                <td>
                                                    <a href="addusers.php?id=<?php echo $list['id']; ?>" class="btn btn-primary">Edit</a>
                                                </td>
                                                <td>
                                                    <a href="index.php?type=delete&delid=<?php echo $list['id']; ?> " class="btn btn-danger" onclick="return confirm('Are you Sure To Delete This Record?')">Delete</a>
                                                    <!-- <button type="button" value="<?php echo $list['id']; ?> " class=" delet_confirm btn btn-danger">Delete</button> -->
                                                </td>
                                            </tr>

                                        <?php
                                            $sr++;
                                        } ?>
                                        <!-- <tr>
                                            <td colspan="12" align="center" class="">
                                                <input type="submit" class="btn btn-danger" name="" id="" value="Delete All">
                                            </td>
                                        </tr> -->
                                    <?php
                                    } else {
                                    ?>
                                        <tr>
                                            <td colspan="12" align="center" class=" text-white bg-secondary">No Record Found </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>