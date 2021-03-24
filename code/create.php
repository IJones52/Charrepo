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
    <!--Some JS for switching tabs between each of the games-->
    <div class="tab">
        <button class="tablinks" onclick="openCity(event, 'DS3')">Dark Souls III</button>
        <button class="tablinks" onclick="openCity(event, 'LOL')">League of Legends</button>
        <button class="tablinks" onclick="openCity(event, 'D&D')">Dungeons and Dragons</button>
        <button class="tablinks" onclick="openCity(event, 'Pokemon')">Pokemon</button>
    </div>

    <div id="DS3" class="tabcontent">
        <form class="form" method="POST" action="create.php?userID=<?php echo $_GET['userID']?>">
            <label for="name">Character Name</label><br>
            <input type="text" id="name" name="name"/><br>
            <label for="stat1">HP</label><br>
            <input type="number" id="stat1" name="stat1"/><br>
            <label for="stat2">FP</label><br>
            <input type="number" id="stat2" name="stat2"/><br>
            <label for="stat3">Stamina</label><br>
            <input type="number" id="stat3" name="stat3"/><br>
            <label for="stat4">Vigor</label><br>
            <input type="number" id="stat4" name="stat4"/><br>
            <label for="stat5">Attunement</label><br>
            <input type="number" id="stat5" name="stat5"/><br>
            <label for="stat6">Endurance</label><br>
            <input type="number" id="stat6" name="stat6"/><br>
            <label for="stat7">Vitality</label><br>
            <input type="number" id="stat7" name="stat7"/><br>
            <label for="stat8">Strength</label><br>
            <input type="number" id="stat8" name="stat8"/><br>
            <label for="stat9">Dexerity</label><br>
            <input type="number" id="stat9" name="stat9"/><br>
            <label for="stat10">Intelligence</label><br>
            <input type="number" id="stat10" name="stat10"/><br>
            <label for="stat11">Faith</label><br>
            <input type="number" id="stat11" name="stat11"/><br>
            <label for="stat12">Luck</label><br>
            <input type="number" id="stat12" name="stat12"/><br>

            <input type="submit" name='submit' ></input>

            <?php
            //On submit connect to the database
            if(isset($_POST['submit'])){
                $connection=mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);
                if(mysqli_connect_errno()){
                    die(mysqli_connect_error());
                    echo "Connection Failed";
                }
                //Grab the form data
                $creator = (int)$_GET['userID'];
                $name = $_POST['name'];
                $stat1 = $_POST['stat1'];
                $stat2 = $_POST['stat2'];
                $stat3 = $_POST['stat3'];
                $stat4 = $_POST['stat4'];
                $stat5 = $_POST['stat5'];
                $stat6 = $_POST['stat6'];
                $stat7 = $_POST['stat7'];
                $stat8 = $_POST['stat8'];
                $stat9 = $_POST['stat9'];
                $stat10 = $_POST['stat10'];
                $stat11 = $_POST['stat11'];
                $stat12 = $_POST['stat12'];

                //Select the last char id from the db and increment it
                $id = 1000000;
                $idQuery = "select id from dsouls3 order by id desc LIMIT 1";
                if($oldId = mysqli_query($connection,$idQuery)){
                    while($row = mysqli_fetch_assoc($oldId)){
                        $id = (int)$row['id'] + 1;
                       
                    }

                }

                //Insert the form data into the db
                $sql = "insert into dsouls3(id,creator,name,Vigor,Attunement,Endurance,Vitality,Strength,Dexterity,Intelligence,Faith,Luck) 
                values('$id','$creator','$name','$stat4','$stat5','$stat6','$stat7','$stat8','$stat9','$stat10','$stat11','$stat12')";              
                if (mysqli_query($connection, $sql)) {
                    //It should refresh and show this when it succeeds
                    echo "New record created successfully";
                }
                else {
                    //On fail it will print this
                    echo "Error: " . $sql . "" . mysqli_error($connection);
                }
                $connection->close();
            }

                
            
            ?>
        </form>

        
    </div>
    <div id="LOL" class="tabcontent">
        <form class="form" method="POST" action="create.php?userID=<?php echo $_GET['userID']?>">
        <label for="champ">Champion Name</label><br>
        <select name="champ">
                    <option selected>Select a Champion</option>
                    <?php
                    //Setup the connection
                    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                    if ( mysqli_connect_errno() )
                    {
                        die( mysqli_connect_error() );
                    }
                    //Query for the dropdown
                    $sql = "select champions.CNameID, CName from champion_names, champions where champions.CNameID = champion_names.CNameID";
                    if ($result = mysqli_query($connection, $sql))
                    {
                        // loop through the data assign id and name to each option
                        while($row = mysqli_fetch_assoc($result))
                        {
                            echo '<option value="' . $row['CNameID'] . '">';
                            echo $row['CName'];
                            echo "</option>";
                        }
                        // release the memory used by the result set
                        mysqli_free_result($result);
                    }
                    ?>
                </select><br>
            <label for="masteryP">Mastery Points</label><br>
            <input type="number" id="masteryP" name="masteryP"/><br>
            <label for="owned">Owned?</label><br>
            <input type="number" id="owned" name="owned"/><br>
            <label for="masteryL">Mastery Level</label><br>
            <input type="number" id="masteryL" name="masteryL"/><br>
            <input type="submit" name='submitleague' ></input>

            <?php
            //On submit begin the connection
            if(isset($_POST['submitleague'])){
                $connection=mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);
                if(mysqli_connect_errno()){
                    die(mysqli_connect_error());
                    echo "Connection Failed";
                }
                //Grab the form data
                $creator = (int)$_GET['userID'];
                $name = $_POST['champ'];
                $stat1 = $_POST['masteryP'];
                $stat2 = $_POST['owned'];
                $stat3 = $_POST['masteryL'];

                //Insert query for the char
                $sql = "insert into champions(UserID,CNameID,MasteryPoints,Owned,MasteryLevel) 
                values('$creator','$name','$stat1',1,'$stat3')";              
                if (mysqli_query($connection, $sql)) {
                    //on success print this
                    echo "New record created successfully";
                }
                else {
                    //On fail print this
                    echo "Error: " . $sql . "" . mysqli_error($connection);
                }
                $connection->close();
            }

                
            
            ?>
        </form>
    </div>
    <div id="D&D" class="tabcontent">
        <form class="form" method="POST" action="create.php?userID=<?php echo $_GET['userID']?>">
            <label for="name">Character </label><br>
            <input type="text" id="name" name="name"/><br>
            <label for="stat1">Lvl</label><br>
            <input type="number" id="stat1" name="stat1"/><br>
            <label for="stat2">Class</label><br>
            <input type="text" id="stat2" name="stat2"/><br>
            <label for="stat3">Race</label><br>
            <input type="text" id="stat3" name="stat3"/><br>
            <label for="stat4">Height</label><br>
            <input type="number" id="stat4" name="stat4"/><br>
            <label for="stat5">Weight</label><br>
            <input type="number" id="stat5" name="stat5"/><br>
            <label for="stat6">Skin Color</label><br>
            <input type="text" id="stat6" name="stat6"/><br>
            <label for="stat7">Eye Color</label><br>
            <input type="text" id="stat7" name="stat7"/><br>
            <label for="stat8">Allignment</label><br>
            <input type="text" id="stat8" name="stat8"/><br>
            <label for="stat9">Background</label><br>
            <input type="textarea" id="stat9" name="stat9"/><br>
            <label for="stat10">STRE</label><br>
            <input type="number" id="stat10" name="stat10"/><br>
            <label for="stat11">DEX</label><br>
            <input type="number" id="stat11" name="stat11"/><br>
            <label for="stat12">CON</label><br>
            <input type="number" id="stat12" name="stat12"/><br>
            <label for="stat13">INTE</label><br>
            <input type="number" id="stat13" name="stat13"/><br>
            <label for="stat14">WIS</label><br>
            <input type="number" id="stat14" name="stat14"/><br>
            <label for="stat15">CHA</label><br>
            <input type="number" id="stat15" name="stat15"/><br>
            <input type="submit" name='d5Submit' ></input>
            
            <?php
            //On submit connect to db
            if(isset($_POST['d5Submit'])){
                $connection=mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);
                if(mysqli_connect_errno()){
                    die(mysqli_connect_error());
                    echo "Connection Failed";
                }
                //Grab the form data
                $creator = (int)$_GET['userID'];
                $name = $_POST['name'];
                $stat1 = $_POST['stat1'];
                $stat2 = $_POST['stat2'];
                $stat3 = $_POST['stat3'];
                $stat4 = $_POST['stat4'];
                $stat5 = $_POST['stat5'];
                $stat6 = $_POST['stat6'];
                $stat7 = $_POST['stat7'];
                $stat8 = $_POST['stat8'];
                $stat9 = $_POST['stat9'];
                $stat10 = $_POST['stat10'];
                $stat11 = $_POST['stat11'];
                $stat12 = $_POST['stat12'];
                $stat13 = $_POST['stat13'];
                $stat14 = $_POST['stat14'];
                $stat15 = $_POST['stat15'];

                //Grab the last charId and increment it for the new char
                $id = 1000000;
                $idQuery = "select CharID from d5echars order by CharID desc LIMIT 1";
                if($oldId = mysqli_query($connection,$idQuery)){
                    while($row = mysqli_fetch_assoc($oldId)){
                        $id = (int)$row['CharID'] + 1;
                       
                    }

                }

                //insert query into the db
                $sql = "insert into d5echars(CharID,UserID,Name,Lvl,Class,Race,Height,Weight,SkinColor,EyeColor,Alignment,Background,STRE,DEX,CON,INTE,WIS,CHA) 
                values('$id','$creator','$name','$stat1','$stat2','$stat3','$stat4','$stat5','$stat6','$stat7','$stat8','$stat9','$stat10','$stat11','$stat12','$stat13','$stat14','$stat15')";              
                if (mysqli_query($connection, $sql)) {
                    echo "New record created successfully";
                }
                else {
                    echo "Error: " . $sql . "" . mysqli_error($connection);
                }
                $connection->close();
            }
            ?>
        </form>
    </div>
    <div id="Pokemon" class="tabcontent">
        <form class="form" method="POST" action="create.php?userID=<?php echo $_GET['userID']?>" >
        <label for="name">Pokemon Name</label><br>
        <select name="name">
                    <option selected>Select a Pokemon</option>
                    <?php
                    //Setup the connection
                    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                    if ( mysqli_connect_errno() )
                    {
                        die( mysqli_connect_error() );
                    }
                    //Query for the dropdown
                    $sql = "select PokeID, PokeName from poke_name ";
                    if ($result = mysqli_query($connection, $sql))
                    {
                        // loop through the data assign name its id value for later
                        while($row = mysqli_fetch_assoc($result))
                        {
                            echo '<option value="' . $row['PokeID'] . '">';
                            echo $row['PokeName'];
                            echo "</option>";
                        }
                        // release the memory used by the result set
                        mysqli_free_result($result);
                    }
                    ?>
                </select><br>

                <label for="ability">Ability</label><br>
                <select name="ability">
                    <option selected>Select an Ability</option>
                    <?php
                    //Setup the connection
                    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                    if ( mysqli_connect_errno() )
                    {
                        die( mysqli_connect_error() );
                    }
                    //Query for the dropdown
                    $sql = "select AbiID, AbiName from poke_abi ";
                    if ($result = mysqli_query($connection, $sql))
                    {
                        // loop through the data assign name its id value for later
                        while($row = mysqli_fetch_assoc($result))
                        {
                            echo '<option value="' . $row['AbiID'] . '">';
                            echo $row['AbiName'];
                            echo "</option>";
                        }
                        // release the memory used by the result set
                        mysqli_free_result($result);
                    }
                    ?>
                </select><br>
                <label for="nature">Nature</label><br>
                <select name="nature">
                    <option selected>Select an Nature</option>
                    <?php
                    //Setup the connection
                    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                    if ( mysqli_connect_errno() )
                    {
                        die( mysqli_connect_error() );
                    }
                    //Query for the dropdown
                    $sql = "select NatureID, NatureName from poke_nature ";
                    if ($result = mysqli_query($connection, $sql))
                    {
                        // loop through the data assign name its id value for later
                        while($row = mysqli_fetch_assoc($result))
                        {
                            echo '<option value="' . $row['NatureID'] . '">';
                            echo $row['NatureName'];
                            echo "</option>";
                        }
                        // release the memory used by the result set
                        mysqli_free_result($result);
                    }
                    ?>
                </select><br>
                <label for="item">Item</label><br>
                <select name="item">
                    <option selected>Select an Item</option>
                    <?php
                    //Setup the connection
                    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                    if ( mysqli_connect_errno() )
                    {
                        die( mysqli_connect_error() );
                    }
                    //Query for the dropdown
                    $sql = "select ItemID, ItemName from poke_item ";
                    if ($result = mysqli_query($connection, $sql))
                    {
                        // loop through the data assign name its id value for later
                        while($row = mysqli_fetch_assoc($result))
                        {
                            echo '<option value="' . $row['ItemID'] . '">';
                            echo $row['ItemName'];
                            echo "</option>";
                        }
                        // release the memory used by the result set
                        mysqli_free_result($result);
                    }
                    ?>
                </select><br>               
                <label for="move1">Move 1</label><br>
                <select name="move1">
                    <option selected>Select a Move</option>
                    <?php
                    //Setup the connection
                    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                    if ( mysqli_connect_errno() )
                    {
                        die( mysqli_connect_error() );
                    }
                    //Query for the dropdown
                    $sql = "select MoveID, MoveName from poke_move ";
                    if ($result = mysqli_query($connection, $sql))
                    {
                        // loop through the data assign name its id value for later
                        while($row = mysqli_fetch_assoc($result))
                        {
                            echo '<option value="' . $row['MoveID'] . '">';
                            echo $row['MoveName'];
                            echo "</option>";
                        }
                        // release the memory used by the result set
                        mysqli_free_result($result);
                    }
                    ?>
                </select><br>
                <label for="move2">Move 2</label><br>
                <select name="move2">
                    <option selected>Select a Move</option>
                    <?php
                    //Setup the connection
                    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                    if ( mysqli_connect_errno() )
                    {
                        die( mysqli_connect_error() );
                    }
                    //Query for the dropdown
                    $sql = "select MoveID, MoveName from poke_move ";
                    if ($result = mysqli_query($connection, $sql))
                    {
                        // loop through the data assign name its id value for later
                        while($row = mysqli_fetch_assoc($result))
                        {
                            echo '<option value="' . $row['MoveID'] . '">';
                            echo $row['MoveName'];
                            echo "</option>";
                        }
                        // release the memory used by the result set
                        mysqli_free_result($result);
                    }
                    ?>
                </select><br>
                <label for="move3">Move 3</label><br>
                <select name="move3">
                    <option selected>Select a Move</option>
                    <?php
                    //Setup the connection
                    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                    if ( mysqli_connect_errno() )
                    {
                        die( mysqli_connect_error() );
                    }
                    //Query for the dropdown
                    $sql = "select MoveID, MoveName from poke_move ";
                    if ($result = mysqli_query($connection, $sql))
                    {
                        // loop through the data assign name its id value for later
                        while($row = mysqli_fetch_assoc($result))
                        {
                            echo '<option value="' . $row['MoveID'] . '">';
                            echo $row['MoveName'];
                            echo "</option>";
                        }
                        // release the memory used by the result set
                        mysqli_free_result($result);
                    }
                    ?>
                </select><br>
                <label for="move4">Move 4</label><br>
                <select name="move4">
                    <option selected>Select a Move</option>
                    <?php
                    //Setup the connection
                    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                    if ( mysqli_connect_errno() )
                    {
                        die( mysqli_connect_error() );
                    }
                    //Query for the dropdown
                    $sql = "select MoveID, MoveName from poke_move ";
                    if ($result = mysqli_query($connection, $sql))
                    {
                        // loop through the data assign name its id value for later
                        while($row = mysqli_fetch_assoc($result))
                        {
                            echo '<option value="' . $row['MoveID'] . '">';
                            echo $row['MoveName'];
                            echo "</option>";
                        }
                        // release the memory used by the result set
                        mysqli_free_result($result);
                    }
                    ?>
                </select><br>
            <label for="stat0">HP EV </label><br>
            <input type="number" id="stat0" name="stat0"/><br>
            <label for="stat1">Attack EV</label><br>
            <input type="number" id="stat1" name="stat1"/><br>
            <label for="stat2">Defense EV</label><br>
            <input type="number" id="stat2" name="stat2"/><br>
            <label for="stat3">Sp. Attack EV</label><br>
            <input type="number" id="stat3" name="stat3"/><br>
            <label for="stat4">Sp. Defense EV</label><br>
            <input type="number" id="stat4" name="stat4"/><br>
            <label for="stat5">HP IV</label><br>
            <input type="number" id="stat5" name="stat5"/><br>
            <label for="stat6">Attack IV</label><br>
            <input type="number" id="stat6" name="stat6"/><br>
            <label for="stat7">Defense IV</label><br>
            <input type="number" id="stat7" name="stat7"/><br>
            <label for="stat8">Sp. Attack IV</label><br>
            <input type="number" id="stat8" name="stat8"/><br>
            <label for="stat9">Sp. Defense IV</label><br>
            <input type="number" id="stat9" name="stat9"/><br>
            <label for="stat10">Speed EV</label><br>
            <input type="number" id="stat10" name="stat10"/><br>
            <label for="stat11">Speed IV</label><br>
            <input type="number" id="stat11" name="stat11"/><br>
            <label for="stat12">Level</label><br>
            <input type="number" id="stat12" name="stat12"/><br>
            <input type="submit" name='pokeSubmit' ></input>
            
            <?php
            //On submit connect to the db
            if(isset($_POST['pokeSubmit'])){
                $connection=mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);
                if(mysqli_connect_errno()){
                    die(mysqli_connect_error());
                    echo "Connection Failed";
                }

                //Grab the rest of the form data
                $creator = (int)$_GET['userID'];
                $name = $_POST['name'];
                $abi = $_POST['ability'];
                $nature = $_POST['nature'];
                $item = $_POST['item'];
                $stat0 = $_POST['stat0'];
                $stat1 = $_POST['stat1'];
                $stat2 = $_POST['stat2'];
                $stat3 = $_POST['stat3'];
                $stat4 = $_POST['stat4'];
                $stat5 = $_POST['stat5'];
                $stat6 = $_POST['stat6'];
                $stat7 = $_POST['stat7'];
                $stat8 = $_POST['stat8'];
                $stat9 = $_POST['stat9'];
                $stat10 = $_POST['stat10'];
                $stat11 = $_POST['stat11'];
                $stat12 = $_POST['stat12'];


                //Grab the last setID and increment it for this new pokemon's moveset
                $id = 1000000;
                $idQuery = "select SetID from poke_set order by SetID desc LIMIT 1";
                if($oldId = mysqli_query($connection,$idQuery)){
                    while($row = mysqli_fetch_assoc($oldId)){
                        $id = (int)$row['SetID'] + 1;
                       
                    }

                }

                //Query to insert the basic pokemon info including all the form data and most of the dropdown ids
                $sql = "insert into poke_set(SetID,UserID,PokeID,HP_EV,A_EV,D_EV,SA_EV,SD_EV,SP_EV,HP_IV,A_IV,D_IV,SA_IV,SD_IV,SP_IV,ITEM_ID,POKE_LVL,NatureID,AbiID) 
                values('$id','$creator','$name','$stat0','$stat1','$stat2','$stat3','$stat4','$stat10','$stat5','$stat6','$stat7','$stat8','$stat9','$stat11','$item','$stat12','$nature','$abi')";              
                if (mysqli_query($connection, $sql)) {
                    //On success insert the four moves into the movelist table using the new setid
                    $move1 = $_POST['move1'];
                    $move2 = $_POST['move2'];
                    $move3 = $_POST['move3'];
                    $move4 = $_POST['move4'];
                    $moveSql= "insert into poke_move_list(SetID,MovePos,MoveID) value('$id',1,'$move1')";
                    mysqli_query($connection, $moveSql);
                    $moveSql= "insert into poke_move_list(SetID,MovePos,MoveID) value('$id',2,'$move2')";
                    mysqli_query($connection, $moveSql);
                    $moveSql= "insert into poke_move_list(SetID,MovePos,MoveID) value('$id',3,'$move3')";
                    mysqli_query($connection, $moveSql);
                    $moveSql= "insert into poke_move_list(SetID,MovePos,MoveID) value('$id',4,'$move4')";
                    mysqli_query($connection, $moveSql);
                    //Then print successs
                    echo "New record created successfully";
                }
                else {
                    //ON fail print error
                    echo "Error: " . $sql . "" . mysqli_error($connection);
                }
                $connection->close();
            }
            ?>


        </form>
    </div>

    
</body>
</html>