<html>
    <head>
        <link rel="stylesheet" type="text/css" href="websiteStyle.css">
        <title>"result for search"</title>

    </head>
    <body>
    <nav>
            <ul>
                <li><a href="DatabaseWebsite.html">Home</a></li>
            </ul>
        </nav>
        <?php 
        if (($_POST['actor']) == '')
        {
            exit;
        }

        $actor = htmlspecialchars($_POST['actor']); 

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


        $sql ="SELECT mvTitle,mvYear,mvGenre,mvPrice FROM Movie WHERE actID = (SELECT actID FROM Actor WHERE actName = '$actor')";
        $result = $conn->query($sql);
        /*$result->execute();
        $result->bind_result($title);
        
        echo htmlentities($title);*/

        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc()) {

            echo "<table><tr><th>Title</th><th>Year</th><th>Genre</th><th>Price</th><th>Actor</th></tr><tr>"."<td>". $row['mvTitle']. "</td>" ."<td>" . $row['mvYear']. "</td>" ."<td>" . $row['mvGenre']. "</td>" ."<td>" . $row['mvPrice']. "</td>" ."<td>" . $_POST['actor']. "</td></table>";   
            }
        }
        else {
            echo "<div>".$_POST['actor']." Not Found in Database</div>";
            }

        $result->close();
        $conn->close();


        ?>

        
        
        
    </body>
</html>

