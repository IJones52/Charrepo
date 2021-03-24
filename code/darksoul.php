<?php require_once('config.php'); ?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Charrepo | Dark Souls III</title>
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
            <p class="lead">Dark Souls III</p>
            <p> 
            Search for a Dark Souls 3 character with the specified paramaters. Paramaters can be
            changed to customize search. This query also returns the username of the user who created
            the character. 
            </p>
            <hr class="my-4">
                <p>&nbsp;</p>
                <form method="GET" action="darksoul.php?userID=<?php echo $_GET['userID']?>">
                    <div>
                        <td style="width: 269px;"><span style="color: #0000ff;">Vigor</span></td>
                        <select name="sec1">
                            <option value=">=">>=</option>
                            <option value="<="><=</option>
                            <option value="=">=</option>
                        </select>
                        <td style="width: 514px;"><input type="text" name="vig"></td>
                    </div>                              
                    <div>
                        <td style="width: 269px;"><span style="color: #0000ff;">Faith</span></td>
                        <select name="sec2">
                            <option value=">=">>=</option>
                            <option value="<="><=</option>
                            <option value="=">=</option>
                        </select>
                        <td style="width: 514px;"><input type="text" name="fai"></td>
                    </div>
                    <div>
                        <td style="width: 269px;"><span style="color: #0000ff;">Vitality</span></td>
                        <select name="sec3">
                            <option value=">=">>=</option>
                            <option value="<="><=</option>
                            <option value="=">=</option>
                        </select>
                        <td style="width: 514px;"><input type="text" name="vit"></td>
                    </div>
                    <div>
                        <td style="width: 269px;"><span style="color: #0000ff;">Endurance</span></td>
                        <select name="sec4">
                            <option value=">=">>=</option>
                            <option value="<="><=</option>
                            <option value="=">=</option>
                        </select>
                        <td style="width: 514px;"><input type="text" name="end"></td>
                    </div>
                    <div>
                        <td style="width: 269px;"><span style="color: #0000ff;">Attunement</span></td>
                        <select name="sec5">
                            <option value=">=">>=</option>
                            <option value="<="><=</option>
                            <option value="=">=</option>
                        </select>
                        <td style="width: 514px;"><input type="text" name="att"></td>
                    </div>
                    <div>
                        <td style="width: 269px;"><span style="color: #0000ff;">Strength</span></td>
                        <select name="sec6">
                            <option value=">=">>=</option>
                            <option value="<="><=</option>
                            <option value="=">=</option>
                        </select>
                        <td style="width: 514px;"><input type="text" name="str"></td>
                    </div>
                    <div>
                        <td style="width: 269px;"><span style="color: #0000ff;">Dexterity</span></td>
                        <select name="sec7">
                            <option value=">=">>=</option>
                            <option value="<="><=</option>
                            <option value="=">=</option>
                        </select>
                        <td style="width: 514px;"><input type="text" name="dex"></td>
                    </div>
                    <div>
                        <td style="width: 269px;"><span style="color: #0000ff;">Intelligence</span></td>
                        <select name="sec8">
                            <option value=">=">>=</option>
                            <option value="<="><=</option>
                            <option value="=">=</option>
                        </select>
                        <td style="width: 514px;"><input type="text" name="int"></td>
                    </div>
                    <div>
                        <td style="width: 269px;"><span style="color: #0000ff;">Luck</span></td>
                        <select name="sec9">
                            <option value=">=">>=</option>
                            <option value="<="><=</option>
                            <option value="=">=</option>
                        </select>
                        <td style="width: 514px;"><input type="text" name="luc"></td>
                    </div>
                    <div>
                        <td style="width: 269px;">&nbsp;</td>
                        <td style="width: 514px; text-align: right;"><input type="submit" value="Submit"></td>
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
                            $vig = isset($_GET['sec1'], $_GET['vig']) && strcmp($_GET['vig'],"")!=0 ? $_GET['sec1'].$_GET['vig'] : ">=0";
                            $fai = isset($_GET['sec2'], $_GET['fai']) && strcmp($_GET['fai'],"")!=0 ? $_GET['sec2'].$_GET['fai'] : ">=0";
                            $vit = isset($_GET['sec3'], $_GET['vit']) && strcmp($_GET['vit'],"")!=0 ? $_GET['sec3'].$_GET['vit'] : ">=0";
                            $end = isset($_GET['sec4'], $_GET['end']) && strcmp($_GET['end'],"")!=0 ? $_GET['sec4'].$_GET['end'] : ">=0";
                            $att = isset($_GET['sec5'], $_GET['att']) && strcmp($_GET['att'],"")!=0 ? $_GET['sec5'].$_GET['att'] : ">=0";
                            $str = isset($_GET['sec6'], $_GET['str']) && strcmp($_GET['str'],"")!=0 ? $_GET['sec6'].$_GET['str'] : ">=0";
                            $dex = isset($_GET['sec7'], $_GET['dex']) && strcmp($_GET['dex'],"")!=0 ? $_GET['sec7'].$_GET['dex'] : ">=0";
                            $int = isset($_GET['sec8'], $_GET['int']) && strcmp($_GET['int'],"")!=0 ? $_GET['sec8'].$_GET['int'] : ">=0";
                            $luc = isset($_GET['sec9'], $_GET['luc']) && strcmp($_GET['luc'],"")!=0 ? $_GET['sec9'].$_GET['luc'] : ">=0";
                           
                        ?>
                        <thead>
                            <tr class="table-success">
                                <th scope="col">User ID</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Character Name</th>
                                <th scope="col">Character ID</th>
                                <th scope="col">Vigor</th>
                                <th scope="col">Attunement</th>
                                <th scope="col">Endurance</th>
                                <th scope="col">Vitality</th>
                                <th scope="col">Strength</th>
                                <th scope="col">Dexterity</th>
                                <th scope="col">Intelligent</th>
                                <th scope="col">Faith</th>
                                <th scope="col">Luck</th>
                            </tr>
                        </thead>
                        <?php

                            // If connection is successful, execute the querry below
                            // to get department's info.
                            $sql = "SELECT U.Username, U.id AS 'User ID', S.name, S.id AS 'Character ID',
                            Vigor, Attunement, Endurance, Vitality, Strength, Dexterity, Intelligence, Faith, Luck
                            FROM users U JOIN dsouls3 S ON U.id = S.creator
                            WHERE S.Vigor {$vig} AND S.Faith {$fai} AND S.Vitality {$vit} AND S.Endurance {$end}
                            AND S.Attunement {$att} AND S.Dexterity {$dex} AND S.Strength {$str} 
                            AND S.Intelligence {$int} AND S.Luck {$luc}";
                            if ($result = mysqli_query($connection, $sql))
                            {
                                while($row = mysqli_fetch_assoc($result))
                                {
                        ?>
                                    <tr>
                                        <td><?php echo $row['User ID'] ?></td>
                                        <td><?php echo $row['Username'] ?></td>
                                        <td><?php echo $row['name'] ?></td>
                                        <td><?php echo $row['Character ID'] ?></td>
                                        <td><?php echo $row['Vigor'] ?></td>
                                        <td><?php echo $row['Faith'] ?></td>
                                        <td><?php echo $row['Vitality'] ?></td>
                                        <td><?php echo $row['Endurance'] ?></td>
                                        <td><?php echo $row['Attunement'] ?></td>
                                        <td><?php echo $row['Dexterity'] ?></td>
                                        <td><?php echo $row['Strength'] ?></td>
                                        <td><?php echo $row['Intelligence'] ?></td>
                                        <td><?php echo $row['Luck'] ?></td>
                                        <form method="POST" action="darksoul.php?userID=<?php echo $_GET['userID']?>">
                                            <td style="width: 514px; text-align: right;">
                                                <input type="hidden" name="del" value=<?php echo $row['Character ID'] ?>>
                                                <input type="submit" value="Delete">
                                            </td>
                                        </form>
                                    </tr>
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