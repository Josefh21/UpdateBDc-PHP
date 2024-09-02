<?php

//Para usar esse código você deve inserir o ID do usuário que você quer alterar na URL do site, por exemplo: http://localhost/aulas/aula4/edit.php?id=1

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        
        $sql = "SELECT * FROM user WHERE id = $id";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
        } else {
            echo "Usuário não existe";
            exit;
        }
    } else {
        echo "Insira o ID do usuário que você quer editar o registro";
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id']) && !empty($_POST['name']) && !empty($_POST['email'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        
        $sql = "UPDATE user SET name='$name', email='$email' WHERE id=$id";
        
        if ($conn->query($sql) === TRUE) {
            echo "Atualizado";
        } else {
            echo "Erro: " . $conn->error;
        }
    } else {
        echo "Dados incompletos.";
    }
    
    $conn->close();
    exit;
} else {
    echo "Ação inválida.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar o usuário</title>
</head>
<body>
    
    <form method="POST" action="update.php">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

        <label for="name">Nome:</label>
        <input type="text" name="name" value="<?php echo $user['name']; ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required>

        <input type="submit" value="Atualizar">

    </form>

</body>
</html>