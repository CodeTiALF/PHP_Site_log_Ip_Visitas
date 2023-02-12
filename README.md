# PHP_Site_log_Ip_Visitas
Modulo de logs de Ip's visitantes no site em linguagem php como 

Creditos:
Agradecimentos ao OpenAI por auxiliar na resolução de problemas e no desenvolvimento deste projeto. https://chat.openai.com/

Objetivo do modulo:
- Registrar os IPs visitante do Website 
- Criar e atualizar arquivo txt de log
- Criar e atualizar uma tabela no mySQL (Falta Fazer)

Resumo:
Esse código é usado para manter um registro de visitantes em um arquivo de texto. Ele começa obtendo o endereço IP do visitante a partir da variável $_SERVER['REMOTE_ADDR']. Em seguida, verifica se o arquivo de log existe. Se não existir, ele cria o arquivo e escreve duas linhas de cabeçalho nele. Em seguida, inicializa uma variável de contagem de visitas. O código abre então o arquivo para leitura e verifica se o IP do visitante já está registrado no arquivo. Se estiver, ele incrementa a contagem de visitas. Finalmente, o código escreve a nova linha no arquivo, incluindo a data, o endereço IP e a contagem de visitas.


Descrição detalhada do código:
1. Obtenção do endereço IP do visitante: A variável $ip armazena o endereço IP do visitante, obtido através da superglobal $_SERVER['REMOTE_ADDR'].
2. Definição do nome do arquivo de log: A variável $file é definida com o nome "access_log.txt".
3. Verificação da existência do arquivo: É realizada uma verificação se o arquivo existe com a função file_exists($file).
4. Criação do arquivo de log: Se o arquivo não existir, é aberto com a função fopen($file, "w") para escrita. É feita uma verificação se o arquivo foi aberto com sucesso.
5. Escrita na primeira linha: A primeira linha é escrita no arquivo com a função fwrite($handle, "--- Log de Ip visitantes ---------------------------------------\n").
6. Escrita na segunda linha: A segunda linha é escrita no arquivo com a função fwrite($handle, "----------------------------------------------------------------\n").
7. Escrita na terceira linha: Uma linha vazia é escrita na terceira linha com a função fwrite($handle, "\n").
8. Fechamento do arquivo: O arquivo é fechado com a função fclose($handle).
9. Inicialização da contagem de visitas: A variável $count é inicializada com o valor 0.
10. Abertura do arquivo para leitura: O arquivo é aberto com a função fopen($file, "r") para leitura. É feita uma verificação se o arquivo foi aberto com sucesso.
11. Leitura do conteúdo do arquivo: O conteúdo do arquivo é lido com a função fread($handle, filesize($file)) e armazenado na variável $fileContent.
12. Fechamento do arquivo: O arquivo é fechado com a função fclose($handle).
13. Conversão do conteúdo do arquivo em array: O conteúdo do arquivo é convertido em um array, dividido por linhas, com a função explode("\n", $fileContent).
14. Percorrimento de cada linha do arquivo: Cada linha do arquivo é percorrida com o loop foreach ($fileLines as $line).
15. Verificação da presença do IP: É verificado se o IP do visitante já está registrado na linha atual com a função `strpos($line, $ip)`. Se estiver registrado, é incrementado a contagem de visitas.
16. Incremento da contagem de visitas: Antes de escrever a nova linha, a contagem de visitas é incrementada.
17. Concatenação da data e IP: A data e o IP são concatenados com a contagem de visitas na string $newLine.
18. Inserção da nova linha no arquivo: A nova linha é inserida na posição 3 (índice 2) do arquivo através da função array_splice($fileLines, 2, 0, $newLine).
19. Juntando as linhas em uma string: As linhas do arquivo são juntadas em uma única string, $fileContent, usando a função implode("\n", $fileLines).
20. Abertura do arquivo para escrita: O arquivo é aberto para escrita através da função fopen($file, "w").
21. Verificação da abertura do arquivo: Verifica-se se o arquivo foi aberto com sucesso.
22. Escrita da nova string no arquivo: A nova string é escrita no arquivo com a função fwrite($handle, $fileContent).
23. Fechamento do arquivo: O arquivo é fechado com a função fclose($handle).

Descrição do codigo:
Este código é um script em PHP que registra as visitas de um site em um arquivo de texto. O endereço IP do visitante é obtido a partir da variável $_SERVER['REMOTE_ADDR']. O nome do arquivo de log é definido como "access_log.txt".

O código verifica se o arquivo já existe. Se não existir, ele cria o arquivo, escreve a primeira linha "--- Log de Ip visitantes ---------------------------------------", a segunda linha "----------------------------------------------------------------" e deixa a terceira linha vazia.

Depois, o código inicializa uma contagem de visitas e abre o arquivo para leitura. Se o arquivo for aberto com sucesso, ele lê todo o conteúdo do arquivo e converte em um array, dividido por linhas. Em seguida, percorre cada linha do arquivo e verifica se o IP do visitante já está registrado no arquivo. Se estiver, incrementa a contagem de visitas.

Depois, o código incrementa a contagem de visitas novamente e monta uma string com a data, o endereço IP e o número de visitas. Em seguida, insere a nova linha na posição 3 (índice 2) do array de linhas do arquivo. Em seguida, junta as linhas do array novamente em uma string e abre o arquivo para escrita. Se o arquivo for aberto com sucesso, ele escreve a nova string no arquivo e fecha o arquivo.
