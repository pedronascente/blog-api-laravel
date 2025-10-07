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
