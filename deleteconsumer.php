<html>
    <head>
        <title>Delete Consumer</title>
        <style>
            body 
            {
                max-width: 400px;
                margin: auto;
                background-color: teal;
                text-align: center;
            }
            form 
            {
                width: 350px;
                border: 15px solid palegreen;
                padding: 50px;
                margin: 60px;
            }
            input[type=button], input[type=submit], input[type=reset]
            {
                background-color: #4CAF50;
                border: none;
                color: white;
                padding: 16px 32px;
                text-decoration: none;
                margin: 4px 2px;
                cursor: pointer;
                width: 100%;
            }
        </style>
    </head>
    <body>
        <centre>
            <form method="post" action="deleteconsumerdata.php">
                <table>
                <tr><td><label>Select the Consumer name:</label></td>
                <td><select name="delconsumer">
                        <option disabled selected>-- Select Consumer --</option>
                        <?php
                        $db = mysqli_connect("localhost","root","","invoice");

                        if(!$db)
                        {
                            die("Connection failed: " . mysqli_connect_error());
                        }

                            $records = mysqli_query($db, "SELECT name From consumer");
                    
                            while($data = mysqli_fetch_array($records))
                            {
                                echo "<option value='". $data['name'] ."'>" .$data['name'] ."</option>";
                            }
                            mysqli_close($db);	
                        ?>  
                </select></td>
                </tr>
                <tr><td colspan="2"><input type="submit" name="submit" value="Delete Consumer"></td></tr>
                <tr><td colspan="2"><input type="reset" name="reset" value="Clear Selection"></td></tr>
                <tr><td colspan="2"><a href="start.html" target="_self"><input type="button" value="BACK TO HOME" /></a></tr></td>
                </table>
            </form>
        </centre>
    </body>
</html>