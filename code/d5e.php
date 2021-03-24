<?php require_once('config.php'); ?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Charrepo | Dungeons & Dragons 5E</title>
        <!-- add a reference to the external stylesheet -->
        <link rel="stylesheet" href="https://bootswatch.com/4/cerulean/bootstrap.min.css">
    </head>
    <body>
        <!-- START -- Add HTML code for the top menu section (navigation bar) -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#"><img src="./logo.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
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
            <p class="lead">Dungeons & Dragons 5E</p>
            <p> 
            Search for a D&D 5th edition character with the specified parameters. 
            </p>
            <hr class="my-4">
                <p>&nbsp;</p>
                <form method="GET" action="d5e.php">
                    <div>
                        <td style="width: 269px;"><span style="color: #0000ff;">Strength</span></td>
                        <select name="sec1">
                            <option value=">=">>=</option>
                            <option value="<="><=</option>
                            <option value="=">=</option>
                        </select>
                        <td style="width: 514px;"><input type="text" name="str"></td>
                    </div>                              
                    <div>
                        <td style="width: 269px;"><span style="color: #0000ff;">Dexterity</span></td>
                        <select name="sec2">
                            <option value=">=">>=</option>
                            <option value="<="><=</option>
                            <option value="=">=</option>
                        </select>
                        <td style="width: 514px;"><input type="text" name="dex"></td>
                    </div>
                    <div>
                        <td style="width: 269px;"><span style="color: #0000ff;">Constitution</span></td>
                        <select name="sec3">
                            <option value=">=">>=</option>
                            <option value="<="><=</option>
                            <option value="=">=</option>
                        </select>
                        <td style="width: 514px;"><input type="text" name="con"></td>
                    </div>
                    <div>
                        <td style="width: 269px;"><span style="color: #0000ff;">Intelligence</span></td>
                        <select name="sec4">
                            <option value=">=">>=</option>
                            <option value="<="><=</option>
                            <option value="=">=</option>
                        </select>
                        <td style="width: 514px;"><input type="text" name="int"></td>
                    </div>
                    <div>
                        <td style="width: 269px;"><span style="color: #0000ff;">Wisdom</span></td>
                        <select name="sec5">
                            <option value=">=">>=</option>
                            <option value="<="><=</option>
                            <option value="=">=</option>
                        </select>
                        <td style="width: 514px;"><input type="text" name="wis"></td>
                    </div>
                    <div>
                        <td style="width: 269px;"><span style="color: #0000ff;">Charisma</span></td>
                        <select name="sec6">
                            <option value=">=">>=</option>
                            <option value="<="><=</option>
                            <option value="=">=</option>
                        </select>
                        <td style="width: 514px;"><input type="text" name="cha"></td>
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

                <?php
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
                        $sql = "DELETE FROM d5echars WHERE charID={$id}";
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
                  
                    <?php
                        $str = isset($_GET['sec1'], $_GET['str']) && strcmp($_GET['str'],"")!=0 ? $_GET['sec1'].$_GET['str'] : ">=0";
                        $dex = isset($_GET['sec2'], $_GET['dex']) && strcmp($_GET['dex'],"")!=0 ? $_GET['sec2'].$_GET['dex'] : ">=0";
                        $con = isset($_GET['sec3'], $_GET['con']) && strcmp($_GET['con'],"")!=0 ? $_GET['sec3'].$_GET['con'] : ">=0";
                        $int = isset($_GET['sec4'], $_GET['int']) && strcmp($_GET['int'],"")!=0 ? $_GET['sec4'].$_GET['int'] : ">=0";
                        $wis = isset($_GET['sec5'], $_GET['wis']) && strcmp($_GET['wis'],"")!=0 ? $_GET['sec5'].$_GET['wis'] : ">=0";
                        $cha = isset($_GET['sec6'], $_GET['cha']) && strcmp($_GET['cha'],"")!=0 ? $_GET['sec6'].$_GET['cha'] : ">=0";
                    ?>
  
                    <?php
                        

                        // If connection is successful, execute the querry below
                        // to get department's info.
                        $sql = "SELECT U.id AS 'UserID', D.CharID AS 'Character ID', D.Name AS 'Character Name', D.Race, S.Name AS 'Skill Name', S.Rank,
                        D.STRE, D.DEX, D.CON, D.INTE, D.WIS, D.CHA
                        FROM users U JOIN d5echars D ON U.id = D.UserID JOIN d5eskills S ON D.CharID = S.CharID
                        WHERE STRE {$str} AND DEX {$dex} AND CON {$con} AND INTE {$int} AND WIS {$wis} AND CHA {$cha}
                        ORDER BY D.CharID ASC";
                        if ($result = mysqli_query($connection, $sql))
                        {
                            $check = -1;
                            $row = mysqli_fetch_assoc($result);
                        ?>
                        <div class="container">
                        <div class="row justify-content-center row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
                        <?php
                            while($row)
                            {
                                if ($check != $row['Character ID']) {
                                    $check = $row['Character ID'];
                                }
                    ?>
                        <div class="col mt-4">
                            <div class="card text-white bg-primary mb-3" style="max-width: 20rem;">
                                    <div class="card-header"><?php echo $row['Character Name'] ?>
                                    </div>
                                    <form method="POST" action="d5e.php">
                                            <td style="width: 514px; text-align: right;">
                                                <input type="hidden" name="del" value=<?php echo $row['Character ID'] ?>>
                                                <input type="submit" value="Delete">
                                            </td>
                                    </form>
                                    <div class="card-body">
                                        <p>
                                            Race: <?php echo $row['Race'] ?>
                                            <br>
                                            Strength: <?php echo $row['STRE'] ?>
                                            Dexterity: <?php echo $row['DEX'] ?>
                                            Constitution: <?php echo $row['CON'] ?>
                                            Intelligence: <?php echo $row['INTE'] ?>
                                            Wisdom: <?php echo $row['WIS'] ?>
                                            Charisma: <?php echo $row['CHA'] ?>
                                        </p>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        while ($check == $row['Character ID']) {
                                        ?>
                                            <p>Skill <?php echo $row['Skill Name'] ?> (Rank <?php echo $row['Rank'] ?>)</p>
                                            <?php
                                            $row = mysqli_fetch_assoc($result);
                                            if (!$row) break;
                                        }
                                            ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                                }
                        ?>
                        </div>
                        </div>
                        <?php    
                                // release the memory used by the result set
                                mysqli_free_result($result);
                            }
                            // close the database connection
                            mysqli_close($connection);
                        ?>
                
        </div>
        <!-- END -- Style for cointainer -->

    </body>
</html>