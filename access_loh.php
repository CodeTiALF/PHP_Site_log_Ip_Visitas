<?php
// Log de visitantes para arquivo TXT 
// Colocar no index.php include "access_log/";
// Conexão com o banco de dados MySQL
// Obtém o endereço IP do visitante
$ip = $_SERVER['REMOTE_ADDR'];
// Obtém a URL visitada
$url = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];
$agente = $_SERVER['HTTP_USER_AGENT'];
$cookie = $_SERVER['HTTP_COOKIE'];
// Define o nome do arquivo de log
$path = "access_log";
$file = $path."/"."access_log.txt";

// Conexão com o banco de dados MySQL
$conn = mysqli_connect("localhost", "xxxxx", "xxxxx", "xxxxx");
// Verifica se a conexão foi estabelecida com sucesso
if (!$conn) {
    die("Conexão com o banco de dados falhou: " . mysqli_connect_error());
}
// Verifica se a tabela `access_log` existe
$table_check = "SHOW TABLES LIKE 'access_log'";
$result = mysqli_query($conn, $table_check);
if (mysqli_num_rows($result) == 0) {
    // Cria a tabela `access_log`
    $table_create = "CREATE TABLE access_log (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        datetime DATETIME NOT NULL,
        ip VARCHAR(15) NOT NULL,
        url VARCHAR(255) NOT NULL
    )";
    mysqli_query($conn, $table_create);
}

// Prepara a consulta SQL para inserir os dados na tabela `access_log`
$sql = "INSERT INTO access_log (datetime, ip, url)
VALUES (NOW(), '$ip', '$url')";

// Executa a consulta SQL
if (mysqli_query($conn, $sql)) {
    // echo "Dados inseridos com sucesso na tabela `access_log`";
} else {
    // echo "Erro ao inserir dados na tabela `access_log`: " . mysqli_error($conn);
}

// Fecha a conexão com o banco de dados
mysqli_close($conn);




// Verifica se o arquivo existe
if (!file_exists($file)) {
    // Abre o arquivo para escrita
    $handle = fopen($file, "w");

    // Verifica se o arquivo foi aberto com sucesso
    if ($handle) {
        // Escreve a primeira linha no arquivo
        fwrite($handle, "--- Log de Ip visitantes ---------------------------------------\n");

        // Escreve a segunda linha no arquivo
        fwrite($handle, "----------------------------------------------------------------\n");

        // Deixa a terceira linha vazia
        fwrite($handle, "\n");

        // Fecha o arquivo
        fclose($handle);
    }
}

// Inicializa a variável de contagem de visitas
$count = 0;

// Abre o arquivo para leitura
$handle = fopen($file, "r");

// Verifica se o arquivo foi aberto com sucesso
if ($handle) {
    // Lê todo o conteúdo do arquivo em uma string
    $fileContent = fread($handle, filesize($file));

    // Fecha o arquivo
    fclose($handle);

    // Converte o conteúdo do arquivo em um array, dividido por linhas
    $fileLines = explode("\n", $fileContent);

    // Percorre cada linha do arquivo
    foreach ($fileLines as $line) {
        // Verifica se o IP do visitante já está registrado no arquivo
        if (strpos($line, $ip) !== false) {
            // Incrementa a contagem de visitas
            $count++;
        }
    }
}

// Incrementa a contagem de visitas
$count++;

// Monta a string com a data e o IP
$newLine = date("Y-m-d H:i:s") . " - " . $ip . " - " . $count . " visita(s)";

// Insere a nova linha na posição 3 (índice 2)
array_splice($fileLines, 2, 0, $newLine);

// Junta as linhas do array novamente em uma string
$fileContent = implode("\n", $fileLines);

// Abre o arquivo para escrita
$handle = fopen($file, "w");

// Verifica se o arquivo foi aberto com sucesso
if ($handle) {
    // Escreve a nova string no arquivo
    fwrite($handle, $fileContent);

    // Fecha o arquivo
    fclose($handle);
}

// Exibe a mensagem de saudação
// echo "Este é sua visita número " . $count . " hoje!";

?>
