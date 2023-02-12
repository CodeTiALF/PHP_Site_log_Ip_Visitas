# PHP_Site_log_Ip_Visitas
Modulo de logs de Ip's visitantes no site em linguagem php como 

Creditos:
Agradecimentos ao OpenAI por auxiliar na resolução de problemas e no desenvolvimento deste projeto. https://chat.openai.com/

Objetivo do modulo:
- Registrar os IPs visitante do Website 
- Manter o registro em aquivo log txt
- 


Descrição do codigo:
Este código é um script em PHP que registra as visitas de um site em um arquivo de texto. O endereço IP do visitante é obtido a partir da variável $_SERVER['REMOTE_ADDR']. O nome do arquivo de log é definido como "access_log.txt".

O código verifica se o arquivo já existe. Se não existir, ele cria o arquivo, escreve a primeira linha "--- Log de Ip visitantes ---------------------------------------", a segunda linha "----------------------------------------------------------------" e deixa a terceira linha vazia.

Depois, o código inicializa uma contagem de visitas e abre o arquivo para leitura. Se o arquivo for aberto com sucesso, ele lê todo o conteúdo do arquivo e converte em um array, dividido por linhas. Em seguida, percorre cada linha do arquivo e verifica se o IP do visitante já está registrado no arquivo. Se estiver, incrementa a contagem de visitas.

Depois, o código incrementa a contagem de visitas novamente e monta uma string com a data, o endereço IP e o número de visitas. Em seguida, insere a nova linha na posição 3 (índice 2) do array de linhas do arquivo. Em seguida, junta as linhas do array novamente em uma string e abre o arquivo para escrita. Se o arquivo for aberto com sucesso, ele escreve a nova string no arquivo e fecha o arquivo.
