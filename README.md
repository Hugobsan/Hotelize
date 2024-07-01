# Hotelize
 O Hotelize é um projeto de sistema de gerenciamento de hotéis, possível realizar o cadastro de hotéis, bem como vincular quartos ao hotel. O sistema possui um sistema de autenticação, onde é possível realizar o cadastro de usuários e realizar o login.

O projeto possui duas formas de desenvolvimento distintas, uma utilizando Laravel Blade e outra utilizando Vue.js. O banco de dados utilizado é o MySQL com o ORM Eloquent e as seguintes tabelas:

- users (para cadastro de usuários)
- hotels (para cadastro de hotéis)
- rooms (para cadastro de quartos)

## Tecnologias
O Repositório possui duas formas de desenvolvimento distintas para o mesmo projeto. 

A pasta hotelize-app contém o projeto com Laravel 11, MySQL e front-end com o Laravel Blade utilizando os recursos Bootstrap e jQuery.

A pasta hotelize-vue-app contém o projeto com Laravel 11, MySQL e front-end com Vue.js interligados por Inertia, utilizando os recursos Tailwind e biblioteca de componentes Vuetify. 

Além disso, em ambas as pastas o projeto está pré-configurado com testes unitários, ambos utilizam a API ViaCEP para preenchimento automático do endereço e ambos estão configurados para utilização do Laravel Sail para facilitar a execução do projeto.

## Instalação
Para instalar o projeto, basta clonar o repositório e, selecionada a pasta com a versão do projeto que deseja utilizar, executar o projeto utilizando o Sail ou configurando ambiente local no .env. Após isso, utilize o comando `php artisan migrate` para criar as tabelas no banco de dados e `php artisan db:seed` para popular o banco de dados com dados de teste. Caso deseje, é possível utilizar o comando `php artisan test` para executar os testes unitários.

