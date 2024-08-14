<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['reg_username'];
    $password = $_POST['reg_password'];
    $email = $_POST['reg_email'];

    // Hash da senha
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Conexão com o banco de dados
    $servername = "localhost";
    $db_username = "teste";
    $db_password = "";
    $dbname = "teste";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Verifica conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Consulta SQL para inserir novo usuário
    $sql = "INSERT INTO users1 (username, password, email) VALUES ('$username', '$hashed_password', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "Cadastro realizado com sucesso.";
    } else {
        if ($conn->errno == 1062) { // Erro de chave duplicada (username ou email)
            echo "Nome de usuário ou e-mail já em uso.";
        } else {
            echo "Erro ao cadastrar usuário: " . $conn->error;
        }
    }

    $conn->close();
}
?>
