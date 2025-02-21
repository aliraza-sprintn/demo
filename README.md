# Laravel TALL Stack with Docker

This project is a Laravel application using the **TALL stack** (TailwindCSS, Alpine.js, Laravel, and Livewire) with **Docker** for easy deployment. It includes **authentication via Laravel Breeze** and a **Product List** page with pagination using ShadCN components.

## Features
- Laravel **10.x** with **TALL** stack
- **Docker** setup for development
- **Breeze Authentication** (Login, Registration, Logout)
- **ShadCN UI components** with demo data from `/test`
- **Product listing with pagination** (API-based)

---

## 🚀 Installation & Setup
### 1️⃣ **Clone the Repository**
```bash
git clone https://github.com/yourusername/your-repo.git
cd your-repo
```

### 2️⃣ **Copy `.env.example` & Set Environment Variables**
```bash
cp .env.example .env
```
Update `.env` with database and app configurations.

### 3️⃣ **Run the Application with Docker**
```bash
docker-compose up -d --build
```

### 4️⃣ **Run Laravel Setup**
```bash
docker-compose run --rm app composer install

docker-compose run --rm app php artisan key:generate

docker-compose run --rm app php artisan migrate --seed

docker-compose run --rm node npm install && npm run build
```

### 5️⃣ **Access the Application**
- 🌍 **Frontend:** [http://localhost:8000](http://localhost:8000)
- 📜 **API Endpoint (Products):** [http://localhost:8000/api/products](http://localhost:8000/api/products)

---

## 🏗 Project Structure
- **Laravel Backend** (`/app`)
- **Frontend (TALL Stack)** (`resources/views`)
- **Docker Setup** (`docker-compose.yml`, `Dockerfile`)
- **API Routes** (`routes/api.php`)
- **Web Routes (Dashboard & Auth)** (`routes/web.php`)

---

## 📌 API Endpoints
### `GET /api/products`
Returns a paginated list of products.
```json
{
  "data": [
    {"id": 1, "name": "Product 1", "price": 20},
    {"id": 2, "name": "Product 2", "price": 30}
  ],
  "current_page": 1,
  "total": 1000
}
```

---

## 🔒 Authentication (Breeze)
- **Login / Register** via Laravel Breeze
- **Logout** available on the **Dashboard (`/dashboard`)**
- **API Routes require authentication** (`auth:sanctum`)

---

## 📢 Notes
- Ensure **Docker & Docker Compose** are installed before running the setup.
- To stop the containers, run:
  ```bash
  docker-compose down
  ```
- To refresh database migrations, run:
  ```bash
  docker-compose run --rm app php artisan migrate:fresh --seed
  ```

Happy Coding! 🚀

