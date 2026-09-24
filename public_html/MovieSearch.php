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
        if (($_POST['sMovieName']) == '')
        {
            exit;
        }

        $movie = htmlspecialchars($_POST['sMovieName']); 

        $movie = trim($movie);
        $movie = stripslashes($movie);    /*doing validation checking*/
        $movie = htmlspecialchars($movie);

        $db_host = 'mysql.cs.nott.ac.uk';
        $db_name = 'psyds13_COMP1004';        /*connecting to the database*/ 
        $db_user = 'psyds13_COMP1004';
        $db_pass = 'databaseone';
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
        if ($conn->connect_errno) {
            die("Failed to connect\n</body>\n</html>");}      /*if unable to connect make an error*/


        $sql ="SELECT mvTitle,mvYear,mvGenre,mvPrice,actName FROM Movie,Actor WHERE mvTitle = '$movie' AND Movie.actID = Actor.actID";
        $result = $conn->query($sql);  /*get the result to the query*/


        if ($result->num_rows > 0)
        while($row = $result->fetch_assoc()) {
               
            echo "<table><tr><th>Title</th><th>Year</th><th>Genre</th><th>Price</th><th>Actor</th></tr><tr>"."<td>". $row['mvTitle']. "</td>" ."<td>" . $row['mvYear']. "</td>" ."<td>" . $row['mvGenre']. "</td>" ."<td>" . $row['mvPrice']. "</td>" ."<td>" . $row['actName']. "</td></table>";}
                         else {
            echo "<div>".$_POST['movie']." Not Found in Database</div>";           /*print out database result or explanation*/
                         }

        $result->close();
        $conn->close();


        ?>
    </body>
</html>