![Logo AI Solutions](http://aisolutions.tec.br/wp-content/uploads/sites/2/2019/04/logo.png)

# AI Solutions

## Teste para novos candidatos (PHP/Laravel)

### Introdução

Este teste utiliza PHP 8.1, Laravel 10 e um banco de dados SQLite simples.

1. Faça o clone desse repositório;
1. Execute o `composer install`;
1. Crie e ajuste o `.env` conforme necessário
1. Execute as migrations e os seeders;

### Primeira Tarefa:

Crítica das Migrations e Seeders: Aponte problemas, se houver, e solucione; Implemente melhorias;

### Segunda Tarefa:

Crie a estrutura completa de uma tela que permita adicionar a importação do arquivo `storage/data/2023-03-28.json`, para a tabela `documents`. onde cada registro representado neste arquivo seja adicionado a uma fila para importação.

Feito isso crie uma tela com um botão simples que dispara o processamento desta fila.

Utilize os padrões que preferir para as tarefas.

### Terceira Tarefa:
Crie um test unitário que valide o tamanho máximo do campo conteúdo.

Crie um test unitário que valide a seguinte regra:

Se a categoria for "Remessa" o título do registro deve conter a palavra "semestre", caso contrário deve emitir um erro de registro inválido. Se a caterogia for "Remessa Parcial", o titulo deve conter o nome de um mês(Janeiro, Fevereiro, etc), caso contrário deve emitir um erro de registro inválido.

Boa sorte!

### Configuração
- composer install
- docker-compose up -d
-  docker-compose exec web php artisan key:generate
-  docker-compose exec web php artisan migrate
-  docker-compose exec web php artisan queue:work redis

### .env
- DB_CONNECTION=pgsql
- DB_HOST=db
- DB_DATABASE=test
- DB_USERNAME=postgres
- DB_PASSWORD=postgres
- DB_PORT=5432
####
- QUEUE_CONNECTION=redis
####
- REDIS_HOST=redis
- REDIS_PASSWORD=null
- REDIS_PORT=6379
- REDIS_CLIENT=predis

### Acesso
- http://localhost:9000/documents

### Testes
- docker-compose exec web php artisan test

### Sonarqube
- http://localhost:9001
- admin : admin

![Sonarqube](documents_images/sonarqube_scan.png)

### Diagrama do Banco de Dados
![Diagrama do Banco de Dados](documents_images/database_diagram.png)
