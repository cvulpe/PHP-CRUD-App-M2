<?php
    session_start();
    
    $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));

    $id = 0;
    $update = false;
    $fname = $lname = $email = $course = $location="";

    if(isset($_POST['save'])){
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $email=$_POST['email'];
        $course=$_POST['course'];
        $gender=$_POST['gender'];
        $location=$_POST['location'];

        $mysqli->query("INSERT INTO data(fname, lname, email, gender, course, location) 
        VALUES('$fname','$lname','$email','$gender','$course','$location')") or die($mysqli->error());

        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";

        header("location:index.php");

    }

    if(isset($_GET['delete'])){
        $id=$_GET['delete'];
        $mysqli -> query("DELETE FROM data WHERE id=$id")or die($mysqli->error());

        $_SESSION['message'] = "Record has been deleted!";
        $_SESSION['msg_type'] = "danger";

        header("location:index.php");

    }

    if (isset($_GET['edit'])){
        $id = $_GET['edit'];
        $update = true;
        $result=$mysqli->query("SELECT * FROM data WHERE id=$id")or die($mysqli->error());

        if($result->num_rows ==1){
            $row=$result->fetch_array();
            $fname=$row['fname'];
            $lname=$row['lname'];
            $email=$row['email'];
            $gender=$row['gender'];
            $course=$row['course'];
            $location=$row['location'];
        }
    }

    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $course = $_POST['course'];
        $location = $_POST['location'];

        $mysqli -> query("UPDATE data SET fname='$fname', lname='$lname',email='$email', gender='$gender',
        course='$course', location='$location' WHERE id=$id") or die($mysqli->error());

        $_SESSION['message'] = "Record has been updated!";
        $_SESSION['msg_type'] = "update";

        header("location:index.php");
    }
?>