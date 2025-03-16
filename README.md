# Proyecto de Autenticación con Laravel Breeze y Sanctum

Este proyecto implementa autenticación con **Laravel Breeze** y **Laravel Sanctum**, permitiendo la gestión de usuarios con roles (`admin` y `guest`) y la generación de tokens para autenticación API. Se han agregado dos nuevos campos al modelo `User`: `phone` y `address`.


- **Autenticación con Laravel Breeze** (manejo de sesiones, registro y login básico).
- **Modelo `User` actualizado con los campos `phone`, `address` y `role`** (sin necesidad de una nueva tabla).
- **El campo `role` se asigna automáticamente como `guest` a nuevos usuarios**, y existe un usuario `admin`.
- **Ruta protegida `/users` que solo permite acceso a administradores**.
- **Autenticación mediante Laravel Sanctum**: permite generar tokens y autenticarse vía API.
- **Registro mediante Laravel Breeze**, permitiendo registrar usuarios con los nuevos campos.
- **Ruta `/login` que devuelve un token JWT usando Sanctum**.
- **Ruta `/user` protegida con Sanctum para validar autenticación con tokens**.



## **Requisitos Previos**
Antes de comenzar, Instala:
- **PHP 8.3 o superior**
- **Composer**
- **MySQL** (Se utilizó **XAMPP** con MySQL, pero puedes usar otro sistema compatible)
- **Node.js y NPM** (para manejar Breeze y Vite si es necesario)
- **Postman o `curl`** (para probar la API)

---

## **Instalación y Configuración**
### 1️⃣ **Clonar el repositorio**
```sh
git clone <URL_DEL_REPOSITORIO>
cd <NOMBRE_DEL_PROYECTO>
2️⃣ Instalar dependencias
sh
Copiar
Editar
composer install
npm install
3️⃣ Configurar la Base de Datos
En los archivos del proyecto se encuentra un script SQL que se debe ejecutar en MySQL antes de iniciar la aplicación. Puedes importarlo en phpMyAdmin o ejecutarlo manualmente en la terminal de MySQL.

Si prefieres configurarlo manualmente, sigue estos pasos:

Copia el archivo .env.example y renómbralo a .env:
sh
Copiar
Editar
cp .env.example .env
Edita el .env y configura la base de datos:
env
Copiar
Editar
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=root
DB_PASSWORD=
4️⃣ Generar la clave de la aplicación
sh
Copiar
Editar
php artisan key:generate
5️⃣ Ejecutar migraciones y seeders
sh
Copiar
Editar
php artisan migrate --seed
Esto creará las tablas necesarias y un usuario de prueba.

6️⃣ Iniciar el servidor
sh
Copiar
Editar
php artisan serve
La aplicación estará disponible en http://127.0.0.1:8000

Uso de la API
1️⃣ Hacer Login y Obtener un Token
POST http://127.0.0.1:8000/login

json
Copiar
Editar
{
    "email": "admin@example.com",
    "password": "admin123"
}
Respuesta esperada:

json
Copiar
Editar
{
    "token": "1|abcde12345...",
    "user": {
        "id": 1,
        "name": "Admin User",
        "email": "admin@example.com",
        "role": "admin"
    }
}
Nota: Guarda el token porque lo usaremos en el siguiente paso.

2️⃣ Acceder a una Ruta Protegida con Token
GET http://127.0.0.1:8000/user Headers:

json
Copiar
Editar
{
    "Authorization": "Bearer TU_TOKEN_AQUI"
}
Si el token es válido, recibirás una respuesta con los datos del usuario autenticado.

3️⃣ Acceder a la Lista de Usuarios (Solo Administradores)
GET http://127.0.0.1:8000/users Headers:

json
Copiar
Editar
{
    "Authorization": "Bearer TU_TOKEN_AQUI"
}
Si el usuario tiene el rol admin, verá la lista de usuarios. Si no, recibirá un error 403 Forbidden
