## About Sales Management System

Sales Management é uma aplicação web com propósito de gerenciar vendas, produtos e vendedores.

## Primeiros Passos

Após fazer o clone do projeto em seu computador, utilize o terminal para criar o banco de dados, da seguinte forma:

`echo create database commcepta | mysql -u root -p`

Com o banco criado, vá até o arquivo **.env** e altere os dados de conexão para o seu banco de dados.

DB_CONNECTION=mysql <br/>
DB_HOST=127.0.0.1 <br/>
DB_PORT=3306 <br/>
DB_DATABASE=commcepta <br/>
DB_USERNAME=root <br/>
DB_PASSWORD=root

Agora rode no terminal o comando para fazer o download das dependências do projeto:

`composer install`


## Inicializando o sistema

Tudo pronto para iniciarmos, agora que já configuramos nosso projeto, vamos rodar as migrations para criar as tabelas e as seeds.

`php artisan migrate --seed`

Agora é só subir o projeto:

`php -S localhost:8000 -t public/`

## Login

Por padrão, já inserimos um usuário para que você posso entrar no sistema com os dados **email: admin@email.com** e **password: admin**. Mas se preferir, fique à vontade para registrar o seu próprio usuário.

## Have Fun :D
