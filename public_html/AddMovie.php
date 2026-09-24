<html>
    <head>
         <link rel="stylesheet" type="text/css" href="websiteStyle.css">
        <title>"adding movie"</title>
    </head>
    <body>
    <nav>
            <ul>
                <li><a href="DatabaseWebsite.html">Home</a></li> <!--so that they can return back to the main menu-->
            </ul>
        </nav>
        <?php 
        /*var_dump($_POST);*/
        $movie = $_POST['aMovieName']; 
        $actor = $_POST['aActorName'];
        $year = $_POST['aYear'];
        $price  = $_POST['aPrice'];
        $genre = $_POST['aGenre'];

        $movie = trim($movie);
        $movie = stripslashes($movie);        
        $movie = htmlspecialchars($movie);

        $actor = trim($actor);
        $actor = stripslashes($actor);        
        $actor = htmlspecialchars($actor);

        $year = trim($year);
        $year = stripslashes($year);        
        $year = htmlspecialchars($year);

        $price = trim($price);
        $price = stripslashes($price);        
        $price = htmlspecialchars($price);

        $genre = trim($genre);
        $genre = stripslashes($genre);        
        $genre = htmlspecialchars($genre);


        $db_host = 'mysql.cs.nott.ac.uk';
        $db_name = 'psyds13_COMP1004';        
        $db_user = 'psyds13_COMP1004';
        $db_pass = 'databaseone';
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
        if ($conn->connect_errno) {
            die("Failed to connect\n</body>\n</html>");}      

        $sql ="SELECT mvTitle FROM Movie WHERE mvTitle = '$movie'";     
        $result = $conn->query($sql);  /*check if movie already in database*/

        if ($result->num_rows > 0)
        {
            echo"<div>". $movie ." already in the database!</div>";
            exit();
        }

        $sql ="SELECT actID FROM Actor WHERE actName = '$actor'";
        $result = $conn->query($sql);  /*get actor ID to add alread ID if same name*/


        if ($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            $actid = $row['actID'];

            $sql ="SELECT MAX(mvID) FROM Movie";
            $result = $conn->query($sql);          /*Get the Max ID*/

            if ($result->num_rows > 0)
            {
                $ID = $result->fetch_assoc();
                $ID = $ID['MAX(mvID)'] + 1;  /*Adds one so it is a new mvID that is unique*/
                $sql ="INSERT INTO Movie (mvID,actID,mvTitle,mvPrice,mvGenre,mvYear) VALUES ('$ID','$actid','$movie','$price','$genre','$year')";
                if ($conn->query($sql) == TRUE)
                {
                    echo"<div>". $movie ." has been successfully added to the database!</div>";
                }   
                else 
                {
                    echo "<div>Error <br></div>";
                }

            }
        }
        else
        {
            echo "<div>There is no Actor for that movie in the database please add the Actor first</div>";  
        }

        $result->close();
        $conn->close();

        ?>
    </body>
</html>