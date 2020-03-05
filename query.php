<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>PHP - CRUD - Query</title>
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
    <div class="query-container">
        <form id="query-form" action="query.php" method="POST">
            <div class="category">
                <input type="hidden" name="submitted" value="true">
                <select name="category" id="">
                    <option value="id">ID</option>
                    <option value="firstName">First Name</option>
                    <option value="lastName">Last Name</option>
                    <option value="email">Email</option>
                    <option value="gender">Gender</option>
                    <option value="course">Course</option>
                    <option value="location">Location</option>
                </select>
            </div>
            <div class="criteria">
                <input type="text" name="criteria" placeholder="Search criteria:">
            </div>
            <input class="btn" type="submit" name="submit" value="Search">
        </form>
    </div>
    <?php
        // error_reporting(E_ALL ^ E_WARNING); 
        $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli()));

        $fname = $lname = $email = $gender = $course = $location= $result = $num_rows = '';
        
        if(isset($_POST['submitted'])){
            $id = '';
            $row="";
            $category = $_POST['category'];
            $criteria = $_POST['criteria'];
             $result = $mysqli->query("SELECT * FROM data WHERE $category LIKE '%".$criteria."%'");
            $num_rows = mysqli_num_rows($result);
            echo"<p class='alert'>Query returned: $num_rows results found.</p>";
        }
?>


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
             while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)):
                echo"<tr><td>";
                echo $row['id'];
                echo"</td><td>";
                echo $row['fname'];
                echo"</td><td>";
                echo $row['lname'];
                echo"</td><td>";
                echo $row['email'];
                echo"</td><td>";
                echo $row['gender'];
                echo"</td><td>";
                echo $row['course'];
                echo"</td><td>";
                echo $row['location'];
                echo"</td>";
            ?>
            <td><a class="update" href="index.php?edit=<?php echo $row['id']; ?>">Edit</a></td>
            <td><a class="delete" href="process.php?delete=<?php echo $row['id']; ?>">Delete</a></td>
            </tr>
            <?php endwhile;?>

        </table>
    </div>
</body>

</html>