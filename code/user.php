<?php require_once('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Character</title>
    <link rel="stylesheet" href="index.css"/>
</head>
<body>
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
    <?php
    //Connect to the db and grab the users username to display
    $connection=mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);
    if(mysqli_connect_errno()){
        die(mysqli_connect_error());
        echo "Connection Failed";
    }
    $id = $_GET['userID'];
    //query for username
    $nameQuery = "select username from users where id = $id";
    if($result = mysqli_query($connection,$nameQuery)){
        while($row = mysqli_fetch_assoc($result)){
            $name = $row['username'];       
            ?>
        <h1 class="tableTitle"><?php echo $name?>'s Characters</h1>;
        <?php
        }
        mysqli_free_result($result);
    }
    ?>

    
    <h3 class="tableTitle">Dark Souls III</h3>
    <table class="table">
        <thead>
            <th>Character Name</th>
            <th>Vigor</th>
            <th>Attunement</th>
            <th>Endurance</th>
            <th>Vitality</th>
            <th>Strength</th>
            <th>Dexterity</th>
            <th>Intelligence</th>
            <th>Faith</th>
            <th>Luck</th>         

        </thead>
        <tbody>
        <?php
            //Connect to the db
            if(mysqli_connect_errno()){
                die(mysqli_connect_error());
                echo "Connection Failed";
            }
            //Grab all ds3 chars that were created by this user
            $sql = "select * from dsouls3 where creator={$_GET['userID']}";
            if ($result = mysqli_query($connection, $sql))
                {  
                 //populate the table             
                while($row = mysqli_fetch_assoc($result))
                    {
        
        ?>
            <tr>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['Vigor'] ?></td>
                <td><?php echo $row['Attunement'] ?></td>
                <td><?php echo $row['Endurance'] ?></td>
                <td><?php echo $row['Vitality'] ?></td>
                <td><?php echo $row['Strength'] ?></td>
                <td><?php echo $row['Dexterity'] ?></td>
                <td><?php echo $row['Intelligence'] ?></td>
                <td><?php echo $row['Faith'] ?></td>
                <td><?php echo $row['Luck'] ?></td>
    
            </tr>
        <?php
                }
                mysqli_free_result($result);
            }
        ?>                
        </tbody>
    </table>
    <h3 class="tableTitle">Dungeons & Dragons 5th Ed.</h3>
    <table class="table">
        <thead>
            <th>Character Name</th>
            <th>Lvl</th>
            <th>Class</th>
            <th>Race</th>
            <th>Height</th>
            <th>Weight</th>
            <th>Skin Color</th>
            <th>Eye Color</th>
            <th>Alignment</th>
            <th>Background</th>
            <th>STRE</th>
            <th>DEX</th>
            <th>CON</th>
            <th>INTE</th>
            <th>WIS</th>
            <th>CHA</th>               
        </thead>
        <tbody>
        <?php
            //Check for a disconnect
            if(mysqli_connect_errno()){
                die(mysqli_connect_error());
                echo "Connection Failed";
            }
            //Grab all the d5e chars created by the user
            $sql = "select * from d5echars where UserID={$_GET['userID']}";
            if ($result = mysqli_query($connection, $sql))
                {  
                //Populate the table based on the result          
                while($row = mysqli_fetch_assoc($result))
                    {
        
        ?>
            <tr>
                <td><?php echo $row['Name'] ?></td>
                <td><?php echo $row['Lvl'] ?></td>
                <td><?php echo $row['Class'] ?></td>
                <td><?php echo $row['Race'] ?></td>
                <td><?php echo $row['Height'] ?></td>
                <td><?php echo $row['Weight'] ?></td>
                <td><?php echo $row['SkinColor'] ?></td>
                <td><?php echo $row['EyeColor'] ?></td>
                <td><?php echo $row['Alignment'] ?></td>
                <td><?php echo $row['Background'] ?></td>
                <td><?php echo $row['STRE'] ?></td>
                <td><?php echo $row['DEX'] ?></td>
                <td><?php echo $row['CON'] ?></td>
                <td><?php echo $row['INTE'] ?></td>
                <td><?php echo $row['WIS'] ?></td>
                <td><?php echo $row['CHA'] ?></td>
    
            </tr>
        <?php
                }
                mysqli_free_result($result);
            }
        ?> 
        </tbody>
    </table>
    <h3 class="tableTitle">League of Legends</h3>
    <table class="table">
        <thead>
            <th>Champion Name</th>
            <th>Mastery Points</th>
            <th>Mastery Level</th> 

        </thead>
        <tbody>
        <?php
            //Connect for disconnect again
            if(mysqli_connect_errno()){
                die(mysqli_connect_error());
                echo "Connection Failed";
            }
            //Grab the champion name based of id and combine it with the champions table
            $sql = "select CName, MasteryPoints, MasteryLevel from champions, champion_names where UserId={$_GET['userID']} and champions.CNameID = champion_names.CNameID";
            if ($result = mysqli_query($connection, $sql))
                {
                //Populate the table            
                while($row = mysqli_fetch_assoc($result))
                    {
        
        ?>
            <tr>
                <td><?php echo $row['CName'] ?></td>
                <td><?php echo $row['MasteryPoints'] ?></td>
                <td><?php echo $row['MasteryLevel'] ?></td>
               
    
            </tr>
        <?php
                }
                mysqli_free_result($result);
            }
        ?> 
        </tbody>
    </table>
    <h3 class="tableTitle"> Pokemon</h3>
    <table class="table">
        <thead>
            <th>Pokemon Name</th>
      
            <th>Level</th>
            <th>Nature</th>
            <th>Ability</th>
            <th>Item</th>
            <th>Move 1</th>
            <th>Move 2</th>
            <th>Move 3</th>
            <th>Move 4</th>
            <th>HP EV</th> 
            <th>Attack EV</th>
            <th>Defense EV</th>
            <th>Sp. Attack EV</th>
            <th>Sp. Defense EV</th>
            <th>Speed EV</th>
            <th>HP IV</th> 
            <th>Attack IV</th>
            <th>Defense IV</th>
            <th>Sp. Attack IV</th>
            <th>Sp. Defense IV</th>
            <th>Sped EV</th>    

        </thead>
        <tbody>
        <?php
        //Check for disconnect
            if(mysqli_connect_errno()){
                die(mysqli_connect_error());
                echo "Connection Failed";
            }
            //Grab all of the pokemon information from the appropriate tables baseed on the poke_set table data except for moves
            $sql = "SELECT *, (SELECT poke_nature.NatureName FROM poke_nature where poke_nature.NatureID = poke_set.NatureID) NatureName, (SELECT poke_abi.AbiName FROM poke_abi where poke_abi.AbiID = poke_set.AbiID) AbiName,(SELECT poke_item.ItemName FROM poke_item where poke_item.ItemID = poke_set.ITEM_ID) ItemName, (SELECT poke_name.PokeName FROM poke_name where poke_name.PokeID = poke_set.PokeID) PokeName FROM poke_set WHERE UserID = {$_GET['userID']}" ;
            if ($result = mysqli_query($connection, $sql))
                {
                //Populate the pokemon without moves            
                while($row = mysqli_fetch_assoc($result))
                    {
                    
            ?>
            <tr>
                <td><?php echo $row['PokeName'] ?></td>
                <td><?php echo $row['POKE_LVL'] ?></td>
                <td><?php echo $row['NatureName'] ?></td>
                <td><?php echo $row['AbiName'] ?></td>
                <td><?php echo $row['ItemName'] ?></td>
                <?php
                    //Grab the moves based on the set id of the pokemon
                    $movesSql = "SELECT poke_move.MoveName from poke_move, poke_move_list,poke_set where UserID = {$_GET['userID']} AND  poke_set.SetID = poke_move_list.SetID AND poke_move_list.MoveID = poke_move.MoveID AND {$row['SetID']} = poke_move_list.SetID";
                    if ($moves = mysqli_query($connection, $movesSql))
                    { 
                        //Loop over the four moves and populate them           
                    while($moveRow = mysqli_fetch_assoc($moves))
                        {
                        ?>
                        <td><?php echo $moveRow['MoveName'] ?></td>
                    <?php
                        }
                        mysqli_free_result($moves);
                        //Return to filling the table
                    }
                ?>
                <td><?php echo $row['HP_EV'] ?></td>
                <td><?php echo $row['A_EV'] ?></td>
                <td><?php echo $row['D_EV'] ?></td>
                <td><?php echo $row['SA_EV'] ?></td>
                <td><?php echo $row['SD_EV'] ?></td>
                <td><?php echo $row['SP_EV'] ?></td>
                <td><?php echo $row['HP_IV'] ?></td>
                <td><?php echo $row['A_IV'] ?></td>
                <td><?php echo $row['D_IV'] ?></td>
                <td><?php echo $row['SA_IV'] ?></td>
                <td><?php echo $row['SD_IV'] ?></td>
                <td><?php echo $row['SP_IV'] ?></td>
    
            </tr>
        <?php
                }
                mysqli_free_result($result);
            }
        ?> 
        </tbody>
    </table>

</body>
