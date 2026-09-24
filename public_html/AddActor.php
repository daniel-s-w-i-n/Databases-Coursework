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
        $actor = $_POST['aActorName']; 
       

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


        $sql ="SELECT MAX(actID) FROM Actor";
        $result = $conn->query($sql);  /*get actor ID to add alread ID if same name*/


        if ($result->num_rows > 0)
        {
            $ID = $result->fetch_assoc();
            $ID = $ID['MAX(actID)'] + 1;
            
                $sql ="INSERT INTO Actor (actID,actName) VALUES ('$ID','$actor')";
                if ($conn->query($sql) == TRUE)
                {
                    echo "<div>". $actor ." has been successfully added to the database!</div>";
                }   
                else 
                {
                    echo "Error not added";
                }

        }
        else{
            echo "error not added";
        }

        $result->close();
        $conn->close();

        ?>
    </body>
</html>