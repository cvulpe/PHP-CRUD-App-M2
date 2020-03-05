<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Pattaya|Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>PHP - CRUD</title>
</head>

<body>
    <header class="main-head">
        <nav>
            <h3 id="logo">PHP CRUD Assignment</h3>
            <ul>
                <li><a href="index.php">Register</a></li>
                <li><a href="query.php">Query</a></li>
            </ul>
        </nav>
    </header>
    <?php require_once 'process.php';?>
    <?php if(isset($_SESSION['message'])): ?>
    <div class="alert-<?=$_SESSION['msg_type']?>">

        <?php 
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>

    </div>
    <?php endif; ?>
    <?php 
         $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli()));
         $result = $mysqli->query('SELECT * FROM data;') or die($mysqli->error());
        ?>
    <div class="container">

        <div class="form-wrapper">
            <form action="process.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="text" name="fname" value="<?php echo $fname;?>" placeholder="First Name:"><br>
                <input type="text" name="lname" value="<?php echo $lname;?>" placeholder="Last Name:"><br>
                <input type="text" name="location" value="<?php echo $location;?>" placeholder="Location:"><br>
                <input type="email" name="email" value="<?php echo $email;?>" placeholder="Email:"><br>
                <input type="text" name="course" value="<?php echo $course;?>" placeholder="Course:"><br>
                <div class="radio">
                    <label>
                        <input type="radio" name="gender" value="M">
                        Male
                    </label>
                    <label>
                        <input type="radio" name="gender" value="F">
                        Female
                    </label>
                </div>

                <?php if($update == true): ?>
                <button class="btn update" type="submit" name="update">Update</button>
                <?php else: ?>
                <button class="btn save" type="submit" name="save">Save</button>
                <?php endif; ?>
            </form>
        </div>

        <div class="tabble-wrapper">
            <table id="display">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Course</th>
                        <th>Location</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <?php
                    while($row = $result->fetch_assoc()):?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['fname']; ?></td>
                    <td><?php echo $row['lname']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['course']; ?></td>
                    <td><?php echo $row['location']; ?></td>
                    <td><a class="update" href="index.php?edit=<?php echo $row['id']; ?>">Edit</a></td>
                    <td><a class="delete" href="process.php?delete=<?php echo $row['id']; ?>">Delete</a></td>
                </tr>
                <?php endwhile;?>
            </table>
        </div>
        <?php
        //  function pre_r($array){
        //      echo'<pre>';
        //      print_r($array);
        //      echo'</pre>';
        // }
    ?>
    </div>

</body>

</html>