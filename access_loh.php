<?php
// Log de visitantes para arquivo TXT 
// Colocar no index.php:
// $log_path = "[caminho]";
// $log_tabela = "[tabela]";
// O nome da tabela é usado para o nome dor arquivo
// include $log_path."/access_log.php"; 

// Obtém o endereço IP do visitante
$log_ip = $_SERVER['REMOTE_ADDR'];
// Obtém a URL visitada
$log_url = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];
$log_agente = $_SERVER['HTTP_USER_AGENT'];
$log_cookie = $_SERVER['HTTP_COOKIE'];
// Define o nome da tabela e automaticamente do arquivo de log
if (!isset($log_path)  ) { $log_path = "access_log"; }
if (!isset($log_tabela)) { $log_tabela = "access_log_pagina_inicial"; }
$log_file = $log_path."/".$log_tabela.".txt";

// Conexão com o banco de dados MySQL
$log_conn = mysqli_connect("localhost", "xxxxx", "xxxxx", "xxxxx");
// Verifica se a conexão foi estabelecida com sucesso
if (!$log_conn) {
    die("Conexão com o banco de dados falhou: " . mysqli_connect_error());
}
// Verifica se a tabela `access_log` existe
$log_table_check = "SHOW TABLES LIKE '".$log_tabela."'";
$log_result = mysqli_query($log_conn, $log_table_check);
if (mysqli_num_rows($log_result) == 0) {
    // Cria a tabela `access_log`
    $log_table_create = "CREATE TABLE {$log_tabela} (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        datetime DATETIME NOT NULL,
        ip VARCHAR(15) NOT NULL,
        url VARCHAR(255) NOT NULL
    )";
    mysqli_query($log_conn, $log_table_create);
}

// Prepara a consulta SQL para inserir os dados na tabela `access_log`
$log_sql = "INSERT INTO {$log_tabela} (datetime, ip, url)
VALUES (NOW(), '$log_ip', '$log_url')";

// Executa a consulta SQL
if (mysqli_query($log_conn, $log_sql)) {
    // echo "Dados inseridos com sucesso na tabela `access_log`";
} else {
    // echo "Erro ao inserir dados na tabela `access_log`: " . mysqli_error($log_conn);
}

// Fecha a conexão com o banco de dados
mysqli_close($log_conn);




// Verifica se o arquivo existe
if (!file_exists($log_file)) {
    // Abre o arquivo para escrita
    $log_handle = fopen($log_file, "w");

    // Verifica se o arquivo foi aberto com sucesso
    if ($log_handle) {
        // Escreve a primeira linha no arquivo
        fwrite($log_handle, "--- Log de Ip visitantes ---------------------------------------\n");

        // Escreve a segunda linha no arquivo
        fwrite($log_handle, "----------------------------------------------------------------\n");

        // Deixa a terceira linha vazia
        fwrite($log_handle, "\n");

        // Fecha o arquivo
        fclose($log_handle);
    }
}

// Inicializa a variável de contagem de visitas
$log_count = 0;

// Abre o arquivo para leitura
$log_handle = fopen($log_file, "r");

// Verifica se o arquivo foi aberto com sucesso
if ($log_handle) {
    // Lê todo o conteúdo do arquivo em uma string
    $log_fileContent = fread($log_handle, filesize($log_file));

    // Fecha o arquivo
    fclose($log_handle);

    // Converte o conteúdo do arquivo em um array, dividido por linhas
    $log_fileLines = explode("\n", $log_fileContent);

    // Percorre cada linha do arquivo
    foreach ($log_fileLines as $log_line) {
        // Verifica se o IP do visitante já está registrado no arquivo
        if (strpos($log_line, $log_ip) !== false) {
            // Incrementa a contagem de visitas
            $log_count++;
        }
    }
}

// Incrementa a contagem de visitas
$log_count++;

// Monta a string com a data e o IP
$log_newLine = "| ".date("Y-m-d H:i:s") . " | " . $log_ip . " | " . $log_count . " visita(s) | ".$log_url;

// Insere a nova linha na posição 3 (índice 2)
array_splice($log_fileLines, 2, 0, $log_newLine);

// Junta as linhas do array novamente em uma string
$log_fileContent = implode("\n", $log_fileLines);

// Abre o arquivo para escrita
$log_handle = fopen($log_file, "w");

// Verifica se o arquivo foi aberto com sucesso
if ($log_handle) {
    // Escreve a nova string no arquivo
    fwrite($log_handle, $log_fileContent);

    // Fecha o arquivo
    fclose($log_handle);
}

// Exibe a mensagem de saudação
// echo "Este é sua visita número " . $log_count . " hoje!";

?>
