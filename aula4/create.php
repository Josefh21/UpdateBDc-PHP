<?php

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "INSERT INTO user (name, email) VALUES ('$name', '$email')";

    if ($conn -> query($sql) === TRUE) {
        echo "Novo registro criado com sucesso";
    }
    else {
        echo "Erro $sql <br/> $conn -> error";
    }
}

$conn -> close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
</head>
<body>

    <form method="POST" action="create.php">

        <label for="name">Nome:</label>
        <input type="text" name="name" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <input type="submit" value="Adicionar">

    </form>
    
</body>
</html>