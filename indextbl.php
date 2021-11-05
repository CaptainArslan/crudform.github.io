<?php
session_start();
ob_start();
if(!isset($_SESSION['email'])){
    // echo "email session is not set";
    header("location: index.php");
}
include("database.php");
$obj = new database();

$css_class = $message = "";


// For Delete Single Record function
if (isset($_GET['type']) && $_GET['type'] == 'delete') {
    $id =  $_GET['delid'];
    if($obj->select($id))
    {
        if ($obj->delete($id)) 
        {
            $css_class = "alert-success";
            $message = "* Record Deleted Successfully!";
        } 
        else
        {
            $css_class = "alert-danger";
            $message = "* Error Occured While Deletion!";
        }
    }
    else
    {
        $message = "* Requested REquest Is not Correct";
        ?>
            <script>
                alert("* Invalid Request by User!");
                window.location.href = "indextbl.php";
            </script>
        <?php 
    }
}


//For Multiple Record Deletion Function
if (isset($_POST['delete_selected'])) 
{
    if(isset($_POST['myCheck']) && $_POST['myCheck'] != "" )
    {
        $id = $_POST['myCheck'];

        $resultmulticheck = $obj->deletemultiple($id);

        if ($resultmulticheck == true)
        {
            $css_class = "alert-success";
            $message = "* Record Deleted Successfully ";
        }
        else
        {
            $css_class = "alert-danger";
            $message = "* Error Occured While multiple Record Deletion!";
        }
    }
    else
    {
        $css_class = "alert-danger";
        $message = "* Please Select a Record to Delete!";
    }
}


//To Following line of code is used to Show All Data
$result = $obj->select();

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <title>User Data</title>    
    <link rel="shortcut icon" type="image" href="tbl.png"/>

    <script type="text/javascript">
    //FOR THE SELECTION AND DESELECTION OF ALL THE CHECBOXES
        var selectall = document.getElementById("allcheckbox");

        function checkboxselect() 
        {
            var selectall = document.getElementById("allcheckbox");
            if (selectall.checked == true) 
            {
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
        
        
        //USE FOR THE CHECKING OF SELECTION OF THE CHECKBOXES AND FOR TO SUBMIT FORM TO DELETE DATA
        function jqisChecked()
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
              swal("* Please Select record to delete!");
              //alert("* Please Select record to delete!");
              return false;
            }
        }


        function isChecked(){
            var checkbox = document.querySelectorAll("input[name = 'myCheck[]']:checked");
            // console.log(checkbox);
            if(checkbox.length>0){
                var result = confirm("Are you sure you want to delete selected users?");
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
                alert("* Please Select Record to delete!");
                return false;
            }
        }


    </script>
</head>

<body>
    <?php
    if ($message != "") 
    {
    ?>
        <div class="container ">
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="alert alert-success <?php echo $css_class; ?> alert-dismissible fade show"  role="alert">
                        <strong><?php echo $message; ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } 
    ?>

    <div class="container mb-5">
        <div class="row">
            <div class="col-md-12 mt-3">
                <form action="indextbl.php" method="POST">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                <a href="logout.php" class="btn btn-danger float-end ms-1" onclick="return confirm('* Are you sure to logout?')">Logout</a>
                                Welcome: <?php echo $_SESSION['name']; ?>  
                                <?php
                                    if($result){
                                        ?>
                                            <button type="submit" class="btn btn-danger float-end ms-1" id="delete_selected" name="delete_selected" onclick=" return jqisChecked(); ">Delete Selected</button>
                                        <?php
                                    }
                                ?>
                                <a href="addusers.php" class="btn btn-primary float-end ms-1">Register/add</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table caption-top" id="tbl_data">
                                <caption>List of users</caption>
                                <thead class="table-dark">
                                    <tr>
                                        <th> <input type="checkbox" name="selectall"  id="allcheckbox" onclick="checkboxselect()" /> </th>
                                        <th style="cursor: pointer;" scope="col">#</th>
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
                                    if ($result) 
                                    {
                                        $sr = 1;
                                        foreach ($result as $list) 
                                        {
                                        ?>
                                            <tr>

                                                <td> <input type="checkbox" id="<?php echo $list['id']; ?>" class="chk" name="myCheck[]" value="<?php echo $list['id']; ?>" /></td>
                                                <th scope="row"><?php echo  $list['id']  ; ?></th>
                                                <td><?php echo $list['user_firstname']; ?></td>
                                                <td><?php echo $list['user_email']; ?></td>
                                                <td><?php echo $list['user_password']; ?></td>
                                                <td><?php echo $list['user_phone']; ?></td>
                                                <td><?php echo $list['user_address']; ?></td>
                                                <td><?php echo $list['user_course']; ?></td>
                                                <td><?php echo $list['user_gender']; ?></td>
                                                <td><?php echo $list['user_disable']; ?></td>
                                                <td>
                                                    <a href="addusers.php?id=<?php echo $list['id']; ?>" class="btn btn-primary">Edit</a>
                                                </td>
                                                <td>
                                                    <a href="indextbl.php?type=delete&delid=<?php echo $list['id']; ?> " class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                                </td>
                                            </tr>
                                        <?php
                                            $sr++;
                                        }
                                        ?>
                                    <?php
                                    } 
                                    else
                                    {
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
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquerylib.js"></script>
    <script src="js/sweetalert.min.js"></script>
    
</body>

</html>