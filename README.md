# 🚀 Task Manager API

API de gerenciamento de tarefas desenvolvida com foco em boas práticas de back-end, utilizando Laravel e Docker.

---

## 📌 Sobre o projeto

Este projeto foi desenvolvido com o objetivo de praticar:

* Estruturação de APIs REST
* Arquitetura com Service Layer
* Uso de Docker no desenvolvimento
* Integração com banco de dados MySQL

---

## 🛠️ Tecnologias utilizadas

* PHP (Laravel)
* MySQL
* Docker
* Nginx

---

## ⚙️ Como rodar o projeto

### 🔹 Pré-requisitos

* Docker
* Docker Compose

---

### 🔹 Clonar o repositório

```bash
git clone https://github.com/janinemo001/task-manager.git
cd task-manager-api
```

---

### 🔹 Subir os containers

```bash
docker-compose up -d --build
```

---

### 🔹 Instalar dependências

```bash
docker exec -it task-manager-app bash
composer install
```

---

### 🔹 Configurar ambiente

```bash
cp .env.example .env
```

Editar o `.env` com:

```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=task_manager
DB_USERNAME=laravel
DB_PASSWORD=laravel
```

---

### 🔹 Gerar chave

```bash
php artisan key:generate
```

---

### 🔹 Rodar migrations

```bash
php artisan migrate
```

---

## 🌐 Acessar aplicação

```
http://localhost:8000
```

---

## 📡 Endpoints principais

| Método | Rota                   | Descrição        |
| ------ | ---------------------- | ---------------- |
| GET    | /api/tasks             | Listar tarefas   |
| POST   | /api/tasks             | Criar tarefa     |
| PUT    | /api/tasks/{id}        | Atualizar tarefa |
| DELETE | /api/tasks/{id}        | Deletar tarefa   |
| PATCH  | /api/tasks/{id}/toggle | Alternar status  |

---

## 🧠 Arquitetura

O projeto utiliza uma separação de responsabilidades:

* Controllers → Entrada das requisições
* Services → Regras de negócio
* Models → Comunicação com banco

---

## 📈 Melhorias futuras

* Autenticação com JWT
* Paginação
* Filtros de busca
* Testes automatizados

---

## 👩‍💻 Autora

Desenvolvido por **Nine**
