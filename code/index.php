<!-- TCSS445 -->
<!-- Student: Phong Hoang Le -->
<!-- ID: 1940249 -->
<!-- Assignment 4 -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Charrepo</title>
        <!-- add a reference to the external stylesheet -->
        <link rel="stylesheet" href="https://bootswatch.com/4/cerulean/bootstrap.min.css">
    </head>
    <body>
        <!-- START -- Add HTML code for the top menu section (navigation bar) -->
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
        <!-- END -- Add HTML code for the top menu section (navigation bar) -->

        <!-- Style for cointainer -->
        <div class="jumbotron">
            <h1 class="display-3">Welcome to Charrepo</h1>
            <p class="lead">A character repository for various tabletop and/or MMORPGs.</p>
            <hr class="my-4">
            <h2>Objective</h2>
            <p>A place for you go when you are looking for premade characters, to share your own creations, or test out different ideas on paper before making your character. There are multiple existing websites with this idea in mind but they all support only one game. Ideally, by having all of this information in one place we can transcend the need for all of the scattered sites. This would achieve our ultimate goal of making the search for characters much easier.</p>
            <h2>Target Audience</h2>
            <p>Simply put, gamers. More specifically at this time we only support four games so the players of those games. The potential to grow the audience is limitless because this site can be expanded</p>
            <h2>Features </h2>
            <p>Charrepo has an account system that allows a user to log in or sign up in order to add to the database. Once signed in a user can create a character for any of the existing games and it will be visible to all other users of the site. People can also view and query the database without being signed in, though signing in is encouraged for full usage of the site as only registered users can add to the database.</p>
            <h2>Contact Information</h2>
            
    
            <table class="table-primary table-hover">
                <thead>
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>

                    </tr>
                </thead>
                <tbody>
                    <tr class="table-active">
                        <td >Ismael Jones</th>
                        <td>ijones52@uw.edu</td>
                    </tr>
                    <tr class="table-active">
                        <td >Kero Adib</th>
                        <td>adibk@uw.edu </td>
                    </tr>
                    <tr class="table-active">
                        <td >Phong Hoang Le</th>
                        <td>phongfly@uw.edu</td>
                    </tr>
                    <tr class="table-active">
                        <td >Walter Kagel</th>
                        <td>wrkagel@uw.edu</td>
                    </tr>
                </tbody>
            </table>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">Thank you for visiting!</a>
            </p>
        </div>
        <!-- END -- Style for cointainer -->

    </body>
</html>