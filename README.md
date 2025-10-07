# Blog API Laravel

## 📝 Descrição

Esta API foi desenvolvida em **Laravel 12.x** e fornece endpoints para gerenciar um blog, incluindo **CRUD de posts, usuários e autenticação via JWT**.

A API é **RESTful** e retorna dados no formato **JSON**.

---

## 🚀 Pré-requisitos

* PHP >= 8.4
* Composer
* MySQL ou outro banco compatível
* Extensões PHP: `openssl`, `pdo`, `mbstring`, `tokenizer`, `json`
* Laravel >= 12.x

---

## ⚙️ Instalação

```bash
git clone git@github.com:pedronascente/blog-api-laravel.git
cd blog-api-laravel
composer install
cp .env.example .env
php artisan key:generate
```

Configure o banco de dados no `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_api
DB_USERNAME=root
DB_PASSWORD=senha
```

Execute migrations:

```bash
php artisan migrate
```

Opcional: seeders para dados de teste:

```bash
php artisan db:seed
```

Inicie a aplicação localmente:

```bash
php artisan serve
```

A API estará disponível em:

```
http://127.0.0.1:8000
```

---

## 🔐 Autenticação

A API utiliza **JWT (JSON Web Token)**.

### Registrar usuário

```bash
curl -X POST http://127.0.0.1:8000/api/v1/register \
-H "Content-Type: application/json" \
-d '{"name": "Pedro Jardim", "email": "pedro@email.com", "password": "senha123", "password_confirmation": "senha123"}'
```

### Login

```bash
curl -X POST http://127.0.0.1:8000/api/v1/login \
-H "Content-Type: application/json" \
-d '{"email": "pedro@email.com", "password": "senha123"}'
```

> Use o token retornado no header `Authorization: Bearer <TOKEN>` para endpoints protegidos.

---

## 📚 Endpoints Principais (Tabelas)

### 🔐 Autenticação

| Método | URL                | Autenticação | Corpo (JSON)                                                                                                   | Resposta (JSON)                                                                     |
| ------ | ------------------ | ------------ | -------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------- |
| POST   | `/api/v1/register` | ❌            | `{ "name": "Pedro", "email": "pedro@email.com", "password": "senha123", "password_confirmation": "senha123" }` | `{ "user": { "id":1, "name":"Pedro", "email":"pedro@email.com" }, "token": "..." }` |
| POST   | `/api/v1/login`    | ❌            | `{ "email":"pedro@email.com", "password":"senha123" }`                                                         | `{ "token":"...", "token_type":"bearer", "expires_in":3600 }`                       |

---

### 📝 Posts

| Método | URL                  | Autenticação | Corpo (JSON)                                         | Resposta (JSON)                                                             |
| ------ | -------------------- | ------------ | ---------------------------------------------------- | --------------------------------------------------------------------------- |
| GET    | `/api/v1/posts`      | ✅            | –                                                    | `[ { "id":1, "title":"Post 1", "content":"Conteúdo" }, ... ]`               |
| POST   | `/api/v1/posts`      | ✅            | `{ "title":"Novo Post", "content":"Conteúdo" }`      | `{ "id":3, "title":"Novo Post", "content":"Conteúdo", "created_at":"..." }` |
| GET    | `/api/v1/posts/{id}` | ✅            | –                                                    | `{ "id":3, "title":"Novo Post", "content":"Conteúdo" }`                     |
| PUT    | `/api/v1/posts/{id}` | ✅            | `{ "title":"Atualizado","content":"Novo conteúdo" }` | `{ "id":3,"title":"Atualizado","content":"Novo conteúdo" }`                 |
| DELETE | `/api/v1/posts/{id}` | ✅            | –                                                    | `{ "message":"Post deletado com sucesso." }`                                |

---

### 👤 Usuários (Admin)

| Método | URL                  | Autenticação | Corpo (JSON)             | Resposta (JSON)                                                  |
| ------ | -------------------- | ------------ | ------------------------ | ---------------------------------------------------------------- |
| GET    | `/api/v1/users`      | ✅            | –                        | `[ { "id":1, "name":"Pedro", "email":"pedro@email.com" }, ... ]` |
| GET    | `/api/v1/users/{id}` | ✅            | –                        | `{ "id":1, "name":"Pedro", "email":"pedro@email.com" }`          |
| PUT    | `/api/v1/users/{id}` | ✅            | `{ "name":"Novo Nome" }` | `{ "id":1, "name":"Novo Nome","email":"pedro@email.com" }`       |
| DELETE | `/api/v1/users/{id}` | ✅            | –                        | `{ "message":"Usuário deletado com sucesso." }`                  |

---

## 🧪 Testando a API

* Use **Postman** ou **Insomnia** para testar os endpoints.
* Configure o **Authorization Bearer Token** após login ou registro.
* Status HTTP retornados:

  * `200 OK` → sucesso
  * `201 Created` → recurso criado
  * `401 Unauthorized` → token inválido ou ausente
  * `404 Not Found` → recurso não encontrado
* `422 Unprocessable Entity` → validação falhou

---

## 📦 Estrutura do Projeto

```
app/
  Docs/Swager/
    Auth/
    User/     
  Http/
    Controllers/
    Requests/
    Resources/
  Models/
routes/
  api.php
database/
  migrations/
  seeders/
```

---

## 🔧 Configurações Adicionais

* **JWT:** `tymon/jwt-auth`
* **Cache Blacklist de Tokens:** Redis
* **Documentação Swagger:** L5-Swagger (`/api/documentation`)

---

## 💡 Observações

* Todos os dados devem ser enviados em **JSON**.
* Endpoints de criação, atualização e deleção exigem **token JWT** no header `Authorization`.
* Em produção, configure HTTPS e proteja suas chaves JWT.
