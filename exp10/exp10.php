<!DOCTYPE html>
<html>
<head>
    <title>PHP MySQL Database Handling</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
        }
        form {
            margin-bottom: 20px;
        }
        form input[type="text"], form input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        form input[type="submit"]:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>PHP MySQL Database Handling</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" required><br>
            <label for="age">Age:</label><br>
            <input type="number" id="age" name="age" required><br><br>
            <input type="submit" value="Insert Data">
        </form>

        <h2>Database Contents</h2>
        <?php
        // Step 1: Establish Connection
        $servername = "localhost";
        $username = "your_username";
        $password = "";
        $database = "your_database";

        $conn = new mysqli($servername, $username, "", $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Step 2: Insert Data
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $age = $_POST['age'];

            $sql = "INSERT INTO your_table (name, age) VALUES ('$name', $age)";

            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // Step 3: Display Data
        $sql = "SELECT * FROM your_table";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table><tr><th>Name</th><th>Age</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["name"]."</td><td>".$row["age"]."</td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        // Step 4: Close Connection
        $conn->close();
        ?>
    </div>
</body>
</html>
