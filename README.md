# Blog API Laravel

## 📝 Descrição

Esta API foi desenvolvida em **Laravel 12.x** e fornece endpoints para gerenciar um blog, incluindo **CRUD de posts, usuários e autenticação via JWT**.  

A API é **RESTful** e retorna dados no formato **JSON**.

---

## 🚀 Pré-requisitos

- PHP >= 8.4  
- Composer  
- MySQL ou outro banco compatível  
- Extensões PHP: `openssl`, `pdo`, `mbstring`, `tokenizer`, `json`  
- Laravel >= 12.x  

---

## ⚙️ Instalação

```bash
git clone git@github.com:pedronascente/blog-api-laravel.git
cd blog-api-laravel
composer install
cp .env.example .env
php artisan key:generate


## Configure o banco de dados no .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_api
DB_USERNAME=root
DB_PASSWORD=senha



## Execute migrations:

php artisan migrate


## Opcional: seeders para dados de teste:

php artisan db:seed


##  Inicie a aplicação localmente:

php artisan serve


##  A API estará disponível em:

http://127.0.0.1:8000

🔐 Autenticação

A API utiliza JWT (JSON Web Token).

Registrar usuário
curl -X POST http://127.0.0.1:8000/api/v1/register \
-H "Content-Type: application/json" \
-d '{"name": "Pedro Jardim", "email": "pedro@email.com", "password": "senha123", "password_confirmation": "senha123"}'


##  Resposta de exemplo:

{
  "user": {
    "id": 1,
    "name": "Pedro Jardim",
    "email": "pedro@email.com",
    "created_at": "2025-10-07T10:00:00.000000Z"
  },
  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."
}

Login
curl -X POST http://127.0.0.1:8000/api/v1/login \
-H "Content-Type: application/json" \
-d '{"email": "pedro@email.com", "password": "senha123"}'


##  Resposta de exemplo:

{
  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
  "token_type": "bearer",
  "expires_in": 3600
}


##  Use o token no header Authorization: Bearer <TOKEN> para endpoints protegidos.

📚 Endpoints Principais
Posts

##  Listar todos os posts

curl -X GET http://127.0.0.1:8000/api/v1/posts


##  Resposta:

[
  {"id":1,"title":"Post 1","content":"Conteúdo do post 1"},
  {"id":2,"title":"Post 2","content":"Conteúdo do post 2"}
]


## Criar um post

curl -X POST http://127.0.0.1:8000/api/v1/posts \
-H "Authorization: Bearer <TOKEN>" \
-H "Content-Type: application/json" \
-d '{"title": "Novo Post", "content": "Conteúdo do novo post"}'


Resposta:

{
  "id": 3,
  "title": "Novo Post",
  "content": "Conteúdo do novo post",
  "created_at": "2025-10-07T10:10:00.000000Z"
}


## Visualizar um post

curl -X GET http://127.0.0.1:8000/api/v1/posts/3


Resposta:

{"id":3,"title":"Novo Post","content":"Conteúdo do novo post"}


## Atualizar um post

curl -X PUT http://127.0.0.1:8000/api/v1/posts/3 \
-H "Authorization: Bearer <TOKEN>" \
-H "Content-Type: application/json" \
-d '{"title":"Post Atualizado","content":"Conteúdo atualizado"}'


Resposta:

{"id":3,"title":"Post Atualizado","content":"Conteúdo atualizado"}


## Deletar um post

curl -X DELETE http://127.0.0.1:8000/api/v1/posts/3 \
-H "Authorization: Bearer <TOKEN>"


Resposta:

{"message":"Post deletado com sucesso."}

Usuários (Admin)

Listar usuários

curl -X GET http://127.0.0.1:8000/api/v1/users \
-H "Authorization: Bearer <TOKEN>"


## Visualizar usuário

curl -X GET http://127.0.0.1:8000/api/v1/users/1 \
-H "Authorization: Bearer <TOKEN>"


## Atualizar usuário

curl -X PUT http://127.0.0.1:8000/api/v1/users/1 \
-H "Authorization: Bearer <TOKEN>" \
-H "Content-Type: application/json" \
-d '{"name":"Novo Nome"}'


## Deletar usuário

curl -X DELETE http://127.0.0.1:8000/api/v1/users/1 \
-H "Authorization: Bearer <TOKEN>"

🧪 Testando a API

## Use Postman ou Insomnia para testar os endpoints.

## Configure o Authorization Bearer Token após login ou registro.

Status HTTP retornados:

200 OK → sucesso

201 Created → recurso criado

401 Unauthorized → token inválido ou ausente

404 Not Found → recurso não encontrado

422 Unprocessable Entity → validação falhou

📦 Estrutura do Projeto
app/
  Http/
    Controllers/
    Requests/
  Models/
routes/
  api.php
database/
  migrations/
  seeders/


  🔧 Configurações Adicionais

JWT: tymon/jwt-auth

Cache Blacklist de Tokens: Redis

Documentação Swagger: L5-Swagger (/api/documentation) 