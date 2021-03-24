<?php require_once('config.php'); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Charrepo | Pokemon</title>
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

        <!-- Cards containing Pokemon set -->
        <div class="jumbotron">
            <h1 class="display-3">Hello</h1>
            <p class="lead">This page has your Pokemon sets.</p>
            <hr class="my-4">
            <form method="GET" action="pokemon.php">
                <select name="poke" onchange='this.form.submit()'>
                    <option selected>Select a name</option>
                    <?php

                    // Attempt to connect to MySQL
                    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                    if ( mysqli_connect_errno() )
                    {
                        die( mysqli_connect_error() );
                    }

                    //If connection is successful, execute the querry below
                    // to get department's names.
                    $sql = "select DISTINCT N.pokename, N.pokeid from poke_set as S JOIN poke_name as N
                            ON S.pokeid = N.pokeid";
                    if ($result = mysqli_query($connection, $sql))
                    {
                        // loop through the data
                        while($row = mysqli_fetch_assoc($result))
                        {
                            echo '<option value="' . $row['pokeid'] . '">';
                            echo $row['pokename'];
                            echo "</option>";
                        }
                        // release the memory used by the result set
                        mysqli_free_result($result);
                    }
                    ?>
                </select>
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

                <?php

                    $poke = isset($_GET['poke']) ? "=".$_GET['poke']:"<>-1";
                    
                ?>
                <p>&nbsp;</p?
                    <?php
                        // Post request method 
                        if ($_SERVER["REQUEST_METHOD"] == "POST")
                        {
                            // If connection is successful, execute the post querry below
                            // to get department's info.
                            $id = $_REQUEST['del'];
                            $sql = "DELETE FROM poke_set WHERE setid={$id}";
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
                    
                        // Check MySQL connection status
                        if ( mysqli_connect_errno() )
                        {
                            die( mysqli_connect_error() );
                        }

                        // If connection is successful, execute the querry below
                        // to get department's info.
                        $sql = " SELECT CONCAT(HP_EV,' HP / ') as hpev, CONCAT(A_EV,' Atk / ') as aev, CONCAT(SA_EV,' SpA / ') as saev, CONCAT(D_EV,' Def / ') as dev, 
				                CONCAT(SD_EV,' SpD / ') as sdev, CONCAT(SP_EV,' Spe / ') as spev, CONCAT(HP_IV,' HP / ') as hpiv,
 				                CONCAT(A_IV,' Atk / ') as aiv, CONCAT(D_IV,' Def / ') as divs, CONCAT(SA_IV,' SpA / ') as saiv,
 				                CONCAT(SD_IV,' SpD / ') as sdiv, CONCAT(SP_IV,' Spe / ') as spiv, POKE_LVL,
                                (SELECT PokeName FROM poke_name WHERE poke_set.pokeid=pokeid) as Name,
				                (SELECT MoveName FROM poke_move_list l JOIN poke_move m ON l.moveid = m.moveid WHERE poke_set.setid=l.setid AND l.movepos=1) as Move1,
				                (SELECT MoveName FROM poke_move_list l JOIN poke_move m ON l.moveid = m.moveid WHERE poke_set.setid=l.setid AND l.movepos=2) as Move2,
				                (SELECT MoveName FROM poke_move_list l JOIN poke_move m ON l.moveid = m.moveid WHERE poke_set.setid=l.setid AND l.movepos=3) as Move3,
				                (SELECT MoveName FROM poke_move_list l JOIN poke_move m ON l.moveid = m.moveid WHERE poke_set.setid=l.setid AND l.movepos=4) as Move4,
				                (SELECT NatureName FROM poke_nature WHERE poke_set.natureid=natureid) as Nature,
				                (SELECT abiName FROM poke_abi WHERE poke_set.abiid=abiid) as Ability,
				                (SELECT ItemName FROM poke_item WHERE poke_set.Item_ID=ItemID) as Item,
                                SetID
				                FROM poke_set 
				                WHERE pokeid{$poke}";
                        if ($result = mysqli_query($connection, $sql))
                        {   
                            ?>
                            <div class="container">
                            <div class="row justify-content-center row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
                            <?php
                            while($row = mysqli_fetch_assoc($result))
                            {
                            ?>
                            <div class="col mt-4">
                                <div class="card text-white bg-primary mb-3" style="max-width: 20rem;">
                                <div class="card-body">
                                    <p>
                                        <?php echo $row['Name'] ?> @ <?php echo $row['Item'] ?><br>
                                        Level: <?php echo $row['POKE_LVL'] ?><br>
                                        Ability: <?php echo $row['Ability'] ?><br>
                                        EV: <?php echo $row['hpev'] ?><?php echo $row['aev'] ?><?php echo $row['dev'] ?><?php echo $row['saev'] ?><?php echo $row['sdev'] ?><?php echo $row['spev'] ?><br>
                                        IVs: <?php echo $row['hpiv'] ?><?php echo $row['aiv'] ?><?php echo $row['divs'] ?><?php echo $row['saiv'] ?><?php echo $row['sdiv'] ?><?php echo $row['spiv'] ?><br>
                                        <?php echo $row['Nature'] ?> Nature<br>
                                        - <?php echo $row['Move1'] ?><br>
                                        - <?php echo $row['Move2'] ?><br>
                                        - <?php echo $row['Move3'] ?><br>
                                        - <?php echo $row['Move4'] ?><br>
                                    </p>
                                </div>
                                <form method="POST" action="pokemon.php">
                                    <td style="width: 514px; text-align: right;">
                                        <input type="hidden" name="del" value=<?php echo $row['SetID'] ?>>
                                        <input type="submit" value="Delete">
                                    </td>
                                </form>
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