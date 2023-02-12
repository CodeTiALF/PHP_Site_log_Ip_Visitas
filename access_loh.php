// Log de visitantes para arquivo TXT
// Obtém o endereço IP do visitante
$ip = $_SERVER['REMOTE_ADDR'];

// Define o nome do arquivo de log
$file = "access_log.txt";

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
