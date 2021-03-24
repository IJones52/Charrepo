<?php require_once('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charrepo</title>
    <link rel="stylesheet" href="index.css"/>
</head>
<body> 
<script type="text/javascript" src="index.js"></script>     
    <nav class="homeNav">
    <?php
        //A little php to decide to show nav based on login status
            if(isset($_GET['userID'])){

            
        ?>
        <a href="index.php?userID=<?php echo $_GET['userID']?>"><img class="title" src="logo.png" /></a>
        <a href="index.php?userID=<?php echo $_GET['userID']?>"><h5 class="navButton">Home</h5></a>
        <a href="user.php?userID=<?php echo $_GET['userID']?>"><h5 class="navButton2">My Characters</h5></a>
        <a href="create.php?userID=<?php echo $_GET['userID']?>"><h5 class="navButton3">Create Character</h5></a>
        <a href="nav.php?userID=<?php echo $_GET['userID']?>"><h5 class="navButton4">Character Search</h5></a>
        <?php
            }
            else{

        ?>
        <a href="index.php"><img class="title" src="logo.png" /></a>
        <a href="index.php"><h5 class="navButton">Home</h5></a>
        <a href="login.php"><h5 class="navButton2">Log In</h5></a>
        <a href="nav.php"><h5 class="navButton3">Character Search</h5></a>
        <?php
            }
        ?>     
    </nav>
    <!--Some JS for switching tabs between login and singup-->
    <div class="tab">
        <button class="tablinks" onclick="openCity(event, 'Login')">Log In</button>
        <button class="tablinks" onclick="openCity(event, 'Signup')">Sign Up</button>
       
    </div>
    <div id="Login" class="tabcontent">
        <form class="form" id="login" method="POST" action="login.php">
                <h1>Log In</h1>
                <label for="name">Username</label><br>
                <input type="text" id="name" name="name"/><br>
                <label for="password">Password</label><br>
                <input type="password" id="password" name="password"/><br>
                <input type="submit" name='submit' ></input>
                <?php
                    //On submit connect to the db
                    if(isset($_POST['submit'])){
                        $connection=mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);
                        if(mysqli_connect_errno()){
                            die(mysqli_connect_error());
                            echo "Connection Failed";
                        }
                        //Grab form data
                        $username = $_POST['name'];
                        $password = $_POST['password'];
                        //Check username and password
                        $sql = "select id from users where username = '$username' and password ='$password' ";

                        if ($result = mysqli_query($connection, $sql)) {
                            //On sucess, grab the id and rout the user to their char page
                            while($row = mysqli_fetch_assoc($result)){
                                echo "Login Sucessful.";
                                $id = (int)$row['id'];
                                $_GET['userID'] = $id;
                                header("Location:user.php?userID=$id");
                                // Adder: Phong Hoang Le
                                // Add in creating session with user id
                                
                            }
                        }
                        else {
                            //On fail print the error
                            echo "Login Failed: " . $sql . "" . mysqli_error($connection);
                        }
                        $connection->close();
                    }
                
                
                ?>
        
        </form>
    </div>
    <div id="Signup" class="tabcontent">
        <form class="form" id="login" method="POST" action="login.php">
                <h1>Sign Up</h1>
                <label for="name">Username</label><br>
                <input type="text" id="name" name="name"/><br>
                <label for="password">Password</label><br>
                <input type="password" id="password" name="password"/><br>
                <input type="submit" name='signupSubmit' ></input>
                <?php
                    //on submit connect to the db
                    if(isset($_POST['signupSubmit'])){
                        $connection=mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);
                        if(mysqli_connect_errno()){
                            die(mysqli_connect_error());
                            echo "Connection Failed";
                        }
                        //Set defaults and grab form data
                        $id = 1000000;
                        $username = $_POST['name'];
                        $password = $_POST['password'];
                        //Grab the last id from the db and increment it
                        $idQuery= "select id from users order by id desc LIMIT 1";
                        if($oldId = mysqli_query($connection,$idQuery)){
                            while($row = mysqli_fetch_assoc($oldId)){
                                $id = (int)$row['id'] + 1;
                               
                            }
        
                        }
                        //The query to insert the new user
                        $sql = "insert into users(id,username,salt,password) values('$id','$username',Salt, '$password')";
                        if ($result = mysqli_query($connection, $sql)){
                            //On success direct them to the create page since they have no chars    
                            echo "Signup Sucessful.";
                                $_GET['userID'] = $id;
                                header("Location:create.php?userID=$id");
                        
                        }
                        else {
                            //On fail print the error message
                            echo "Signup Failed: " . $sql . "" . mysqli_error($connection);
                        }
                        $connection->close();
                    }
                
                
                ?>
        
        </form>
    </div>

</body>
</html>