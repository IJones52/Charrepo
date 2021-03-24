<?php require_once('config.php'); ?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Charrepo | League of Legends</title>
        <!-- add a reference to the external stylesheet -->
        <link rel="stylesheet" href="https://bootswatch.com/4/cerulean/bootstrap.min.css">
    </head>
    <body>
        <!-- START -- Add HTML code for the top menu section (navigation bar) -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="#"><img src="./logo.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">

                    <?php
                        if(isset($_GET['userID'])){
                    ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php?userID=<?php echo $_GET['userID']?>">Home
                            
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user.php?userID=<?php echo $_GET['userID']?>">My Characters</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="create.php?userID=<?php echo $_GET['userID']?>">Create Charcter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="nav.php?userID=<?php echo $_GET['userID']?>">Character Search</a>
                    </li>
                    <?php
                        }
                        else{
                    ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home
                            <span class="sr-only"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Log In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="nav.php">Character Search</a>
                    </li>
                    <?php
                        }
                    ?>
                    </ul>
            </div>
        </nav>
        <!-- END -- Add HTML code for the top menu section (navigation bar) -->

        <!-- Style for cointainer -->
        <div class="jumbotron">
            <p class="lead">League of Legends</p>
            <p> 
            Display user's League of Legends champions with the specified paramaters.
            </p>
            <hr class="my-4">
                <p>&nbsp;</p>
                <form method="GET" action="lol.php?userID=<?php echo $_GET['userID']?>">
                    <div>
                        <td style="width: 269px;"><span style="color: #0000ff;">Champion Name:</span></td>
                        <td style="width: 514px;"><input type="text" name="name"></td>
                    </div>                              
                    <div>
                        <td style="width: 269px;"><span style="color: #0000ff;">Mastery Points:</span></td>
                        <select name="sec1">
                            <option value=">=">>=</option>
                            <option value="<="><=</option>
                            <option value="=">=</option>
                        </select>
                        <td style="width: 514px;"><input type="text" name="mp"></td>
                    </div> 
                    <div>
                        <td style="width: 269px;"><span style="color: #0000ff;">Mastery Levels:</span></td>
                        <select name="sec2">
                            <option value=">=">>=</option>
                            <option value="<="><=</option>
                            <option value="=">=</option>
                        </select>
                        <td style="width: 514px;"><input type="text" name="ml"></td>
                    </div>
                    <?php
                        if(isset($_GET['userID'])){
                    ?>
                    <div style="display:none;">
                    <select name="userID">
                            <option value="<?php echo $_GET['userID']?>"></option>

                        </select>
                    </div> 
                    <?php
                        }
                    ?>
                    <div>
                        <td style="width: 269px;">&nbsp;</td>
                        <td style="width: 514px; text-align: right;"><input type="submit" value="Submit"></td>
                    </div>
                </form>
                <p>&nbsp;</p>


                

                <!-- Respond to request method -->
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "GET" || $_SERVER["REQUEST_METHOD"] == "POST")
                {
                    // Attempt to connect to MySQL
                    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                    // Check MySQL connection status
                    if ( mysqli_connect_errno() )
                    {
                        die( mysqli_connect_error() );
                    }

                    // Post request method 
                    if ($_SERVER["REQUEST_METHOD"] == "POST")
                    {
                        // If connection is successful, execute the post querry below
                        // to get department's info.
                        $id = $_REQUEST['del'];
                        $sql = "DELETE FROM dsouls3 WHERE ID={$id}";
                        if ($connection->query($sql) === TRUE) {
                        ?>
                            <div class="alert"><?php echo "Record deleted successfully" ?></div>
                        <?php 
                          } else {
                        ?>
                            <div class="alert"><?php echo "Error deleting record: " . $connection->error ?></div>
                        <?php
                          }
                    }
                ?>
                    <table class="table table-hover">
                        <?php
                            $name = isset($_GET['name']) && strcmp($_GET['name'],"")!=0 ? $_GET['name'] : "";
                            $mp = isset($_GET['sec1'], $_GET['mp']) && strcmp($_GET['mp'],"")!=0 ? $_GET['sec1'].$_GET['mp'] : ">=0";
                            $ml = isset($_GET['sec2'], $_GET['ml']) && strcmp($_GET['ml'],"")!=0 ? $_GET['sec2'].$_GET['ml'] : ">=0";
                            
                        ?>
                        <thead>
                            <tr class="table-success">
                                <th scope="col">User Name</th>
                                <th scope="col">Champion Name</th>
                                <th scope="col">Mastery Points</th>
                                <th scope="col">Owned</th>
                                <th scope="col">Mastery Level</th>
                            </tr>
                        </thead>
                        <?php

                            // If connection is successful, execute the querry below
                            // to get department's info.
                    $sql = "SELECT N.CName, C.MasteryPoints, C.Owned, C.MasteryLevel, U.username
                                    FROM champions C JOIN champion_names N ON C.CNameID= N.CNameID
                                    JOIN users U ON U.id=C.UserID
                                    WHERE N.CName LIKE '%{$name}' AND C.MasteryPoints{$mp} AND C.MasteryLevel{$ml}";
                            if ($result = mysqli_query($connection, $sql))
                            {
                                while($row = mysqli_fetch_assoc($result))
                                {
                        ?>
                                    <tr>
                                        <td><?php echo $row['username'] ?></td>
                                        <td><?php echo $row['CName'] ?></td>
                                        <td><?php echo $row['MasteryPoints'] ?></td>
                                        <td><?php echo $row['Owned'] ?></td>
                                        <td><?php echo $row['MasteryLevel'] ?></td>
                        <?php
                                }
                                // release the memory used by the result set
                                mysqli_free_result($result);
                            }
                            // close the database connection
                            mysqli_close($connection);
                        ?>
                </table>
            <?php
                } // End GET method.
            ?>
        </div>
        <!-- END -- Style for cointainer -->

    </body>
</html>