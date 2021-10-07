<?php
include("include/header.php");
//include("dbcon.php");
      include("database.php");
      $obj = new database();
      $result=$obj->select();
        //This pre will tell us about the Index which we set under this in the table body
        //echo '<pre>';
        //print_r($result);
?>
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4>
                        PHP CRUD OPERATIONS
                        <a href="addusers.php" class="btn btn-primary  float-end">Register/add</a>
                    </h4>
                   

                </div>
                <div class="card-body">
                    <table class="table caption-top">
                        <caption>List of users</caption>
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Password</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Address</th>
                                <th scope="col">Status</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Disable</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if(isset($result['0'])){
                                $sr = 1;
                                foreach($result as $list){
                           ?>
                            <tr>
                                <th scope="row"><?php echo $sr ;?></th>
                                <td><?php echo $list['user_firstname'] ;?></td>
                                <td><?php echo $list['user_email'] ;?></td>
                                <td><?php echo $list['user_password'] ;?></td>
                                <td><?php echo $list['user_phone'] ;?></td>
                                <td><?php echo $list['user_address'] ;?></td>
                                <td><?php echo $list['user_status'];?></td>
                                <td><?php echo $list['user_gender'] ;?></td>
                                <td><?php echo $list['user_disable'] ;?></td>
                                <td>
                                    <a href="addusers.php?edit=<?php echo $list['user_id']; ?>" class="btn btn-primary">Edit</a>
                                </td>
                                <td>
                                    <a href="deleteuser.php?delid=<?php echo $list['user_id']; ?> " class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            
                            <?php
                            $sr++;
                         }
                         }else{
                            ?>
                                    <tr>
                                        <td colspan="11" align="center" class=" text-white bg-secondary" >No Record Found </td>
                                    </tr>
                            <?php 
                         }
                         ?>
                         
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include("include/footer.php");
?>