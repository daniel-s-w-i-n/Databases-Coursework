<html>
    <head>
        <link rel="stylesheet" type="text/css" href="websiteStyle.css">
        <title>"adding actor"</title>
    </head>
    <body>
    <nav>
            <ul>
                <li><a href="DatabaseWebsite.html">Home</a></li>
            </ul>
        </nav>
        <?php 
        $actor = $_POST['dActorName']; 
        $delMov = $_POST['delete'];
       

        $actor = trim($actor);
        $actor = stripslashes($actor);        
        $actor = htmlspecialchars($actor);

        
        $db_host = 'mysql.cs.nott.ac.uk';
        $db_name = 'psyds13_COMP1004';        
        $db_user = 'psyds13_COMP1004';
        $db_pass = 'databaseone';
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
        if ($conn->connect_errno) {
            die("Failed to connect\n</body>\n</html>");}      


        $sql ="SELECT actID FROM Actor WHERE actName = '$actor'"; /*Making sure it is in the database*/
        $result = $conn->query($sql);


        if ($result->num_rows > 0)
        {
            $ID = $result->fetch_assoc();
            $ID = $ID['actID'];

            $sql ="DELETE FROM Actor WHERE actname = '$actor'";
            if ($conn->query($sql) == TRUE)
                {
                    echo "<div>".$actor ." has been successfully Deleted from the actor database!</div>";
                }   
                if ($delMov == TRUE)  /*nested so that it cant do one but not the other*/
                {
                    $sql ="DELETE FROM Movie WHERE actID = '$ID'";
                    if ($conn->query($sql) == TRUE)
                    {
                        echo "<div>".$actor ." has been successfully Deleted from the movie database!</div>";
                    }   
                     else 
                     {
                       echo "<div>Error not deleted from movie database<BR></div>";
                    }
            }
            else 
                {
                    echo "<div>Error not deleted <BR></div>";
                }

        }
        else{
            echo "error not in database";
        }

        $result->close();
        $conn->close();

        ?>
    </body>
</html>