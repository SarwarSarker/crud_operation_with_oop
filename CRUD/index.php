<?php
   spl_autoload_register(function($class){
     include "classes/".$class.".php";
   });
       ?>
<?php
$user = new Student();
 if (isset($_POST['submit'])) {
   $username = $_POST['username'];
   $email = $_POST['email'];
   $password = $_POST['password'];
 
  $user->setUsername($username);
  $user->setEmail($email);
  $user->setPassword($password);

  if ($user->insert()) {
    echo "insert successfully";
  }
 }
 if (isset($_POST['edit'])) {
   $id = $_POST['id'];
   $username = $_POST['username'];
   $email = $_POST['email'];
   $password = $_POST['password'];
 
  $user->setUsername($username);
  $user->setEmail($email);
  $user->setPassword($password);

  if ($user->update($id)) {
    echo "Update successfully";
  }
 }
 

 ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/style.css" >
   </script>

    <title>CRUD with PDO</title>

  </head>
  <body><Br><Br>
   <center> <h1>CRUD with PDO</h1></center>
<Br>
<div class="container">
  <div class="row">

    <div class="col-sm-3 alert alert-primary">
     <h1>Input Data</h1>
  <?php 
     if (isset($_GET['action']) && $_GET['action'] == 'delete') {
   $id = (int)$_GET['id'];
   $result = $user->deleteById($id);
   if ($user->delete($id)) {
    echo "Delete successfully";
  }
   }
    ?>
  <?php 
     if (isset($_GET['action']) && $_GET['action'] == 'edit') {
   $id = (int)$_GET['id'];
   $result = $user->readById($id);
   
    ?>
     <form action="" method="POST">
  <input type="hidden" class="form-control"  name="id" value="<?php echo $result['id'];?>">
      <div class="form-group">
    <label >Username</label>
    <input type="text" class="form-control"  name="username" value="<?php echo $result['username'];?>">
  </div>
  <div class="form-group">
    <label >Email address</label>
    <input type="email" class="form-control"  value="<?php echo $result['email'];?>" name="email">
  </div>
  <div class="form-group">
    <label >Password</label>
    <input type="password" class="form-control"  value="<?php echo $result['password'];?>" name="password">
  </div>
  <button type="submit" class="btn btn-primary" name="edit">Update</button>
</form>
 <?php } else{?>
     <form action="" method="POST">
      <div class="form-group">
    <label >Username</label>
    <input type="text" class="form-control"  name="username" placeholder="Enter Username">
  </div>
  <div class="form-group">
    <label >Email address</label>
    <input type="email" class="form-control"  placeholder="Enter email" name="email">
  </div>
  <div class="form-group">
    <label >Password</label>
    <input type="password" class="form-control"  placeholder="Password" name="password">
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>
<?php } ?>
    </div>
 
    <div class="col-sm-1"></div>
  
    <div class="col-sm-8 alert alert-secondary">
      <h1> Data from Database</h1>
       <Br>
       
         <table class="table text-center table-striped table-hover table-bordered" >
              <tr class="bg-primary">
               <th> ID</th> 
               <th> Name</th>
               <th>Email</th>
               <th>Password</th>
               <th>Edit Action</th>
               <th>Action</th>
            </tr>
        <?php
        $i=0;
       foreach ($user->readAll() as $key => $value) {
         $i++;
       ?>
            <tr>
                 <td><?php echo $i;?></td>
                 <td><?php echo $value['username'];?></td>
                 <td><?php echo $value['email'];?></td>
                 <td><?php echo $value['password'];?></td>
                 <td><button class="btn-info btn"><?php echo "<a  href='index.php?action=edit&id=".$value['id']."'>Edit</a>";?></button></td>
                 <td><button class="btn-danger btn"><?php echo "<a  href='index.php?action=delete&id=".$value['id']."' onClick='return confirm(\"Are you sure to delete\")'>Delete</a>";?></button>
                 </td>
                  
            </tr>

            <?php  } ?>

       </table>
      
   </div>
    </div>

  </div>
</div>
  </body>
</html>
