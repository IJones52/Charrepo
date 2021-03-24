<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Repositories</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/cerulean/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg  bg-light">
            <a class="navbar-brand" href="#"><img src="logo.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor03">
                <ul class="navbar-nav mr-auto">

                    <?php
                        if(isset($_GET['userID'])){
                    ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php?userID=<?php echo $_GET['userID']?>">Home
                            <span class="sr-only">(current)</span>
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
                            <span class="sr-only">(current)</span>
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
    <h1 class="tableTitle">Select A Repository</h1>
    <?php
        //A little php to decide to link based on login status
            if(isset($_GET['userID'])){

            
        ?>
            <ul class="repos">
                <a href="darksoul.php?userID=<?php echo $_GET['userID']?>"><li><h2>Dark Souls III</h2></li></a>
                <a href="lol.php?userID=<?php echo $_GET['userID']?>"><li><h2>League of Legends</h2></li></a>
                <a href="d5e.php?userID=<?php echo $_GET['userID']?>"><li><h2>Dungeons and Dragons 5th Ed.</h2></li></a>
                <a href="pokemon.php?userID=<?php echo $_GET['userID']?>"><li><h2>Pokemon</h2></li></a>
            </ul>
        <?php
            }
            else{

        ?>
            <ul class="repos">
                <a href="darksoul.php"><li><h2>Dark Souls III</h2></li></a>
                <a href="lol.php"><li><h2>League of Legends</h2></li></a>
                <a href="d5e.php"><li><h2>Dungeons and Dragons 5th Ed.</h2></li></a>
                <a href="pokemon.php"><li><h2>Pokemon</h2></li></a>
            </ul>
        <?php
            }
        ?>           


    
</body>
</html>