<html>
    <head>
        <link rel="stylesheet" type="text/css" href="websiteStyle.css">
        <title>"adding movie"</title>
    </head>
    <body>
    <nav>
            <ul>
                <li><a href="DatabaseWebsite.html">Home</a></li>
            </ul>
        </nav>
        <?php 
        $movie = $_POST['dMovieName']; 
       

        $movie = trim($movie);
        $movie = stripslashes($movie);        
        $movie = htmlspecialchars($movie);

        
        $db_host = 'mysql.cs.nott.ac.uk';
        $db_name = 'psyds13_COMP1004';        
        $db_user = 'psyds13_COMP1004';
        $db_pass = 'databaseone';
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
        if ($conn->connect_errno) {
            die("Failed to connect\n</body>\n</html>");}      


        $sql ="SELECT mvTitle FROM Movie WHERE mvTitle = '$movie'"; /*Making sure it is in the database*/
        $result = $conn->query($sql);


        if ($result->num_rows > 0)
        {
            $sql ="DELETE FROM Movie WHERE mvTitle = '$movie'";  /*Deleting whole row*/
            if ($conn->query($sql) == TRUE)
                {
                    echo "<div>" .$movie ." has been successfully Deleted from the movie database!</div>";
                }   
                
            else 
                {
                    echo "Error not deleted <BR>";
                }

        }
        else
        {
            echo "error not in database";
        }

        $result->close();
        $conn->close();

        ?>
    </body>
</html>