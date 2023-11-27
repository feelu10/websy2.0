<?php
require '../includes/dbconnect.php'; // Include your database connection file

?>
<!-- add-room.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Room</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
            display: block;
            margin: auto;
        }

        h2 {
            color: #343a40;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #495057;
            font-size: 14px;
            font-weight: bold;
        }

        input,
        select {
            width: calc(100% - 24px);
            padding: 12px;
            margin-bottom: 20px;
            box-sizing: border-box;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 14px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<form action="process-room.php" method="post" enctype="multipart/form-data">
    <h2>Add Room</h2>

    <label for="roomName">Room Name:</label>
    <input type="text" name="roomName" required>

    <label for="roomDescription">Room Description:</label>
    <textarea name="roomDescription" rows="4" required></textarea>

    <label for="roomImage">Room Image:</label>
    <input type="file" name="roomImage" accept="image/*" required>

    <button type="submit">Add Room</button>
</form>

</body>
</html>
