# Manual de Instalación — BookSwap

## 1. Requisitos del Sistema

### PHP
El proyecto requiere:

- PHP **8.4.0** o superior  
- Extensiones recomendadas por Laravel:
  - openssl  
  - pdo  
  - mbstring  
  - tokenizer  
  - xml  
  - ctype  
  - json  
  - fileinfo  
  - curl  

### Laravel
- Framework: **Laravel 12.47.0**

### Composer
- Composer **2.8.12**

### Node.js
Aunque el proyecto incluye dependencias de Vite y TailwindCSS, **no es necesario compilar assets** para ejecutar la aplicación.

- Node.js **22.20.0**

### Base de datos
- Motor: **MySQL**
- Requiere migraciones y seeders

---

## 2. Obtención del Proyecto

El código fuente está disponible en un repositorio público de GitHub.

Para clonar el proyecto:

```
git clone https://github.com/BorjaBN/book_swap.git
cd book_swap
cd fuente/www
```

---

## 3. Instalación de Dependencias

### Dependencias PHP

```
composer install
```

### Dependencias Node.js

```
npm install
```

---

## 4. Configuración del Entorno

Crear el archivo .env a partir del archivo de ejemplo:

```
cp .env.example .env
```

Configurar las variables mínimas necesarias:

```
APP_NAME=BookSwap
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=book_swap
DB_USERNAME=usuario
DB_PASSWORD=contraseña

```

Generar la clave de aplicación:

```
php artisan key:generate
```

---

## 5. Configuración de la Base de Datos

### Migraciones

```
php artisan migrate
```

### Seeders 

```
php artisan db:seed
```

---

## 6. Subida de Imágenes

El proyecto permite subir imágenes, por lo que es necesario crear el enlace simbólico hacia el almacenamiento público:

```
php artisan storage:link
```

Esto habilita el acceso a archivos ubicados en:

- storage/app/public

- public/libros

---

## 7. Livewire

El proyecto utiliza Livewire para el buscador dinámico.

No requiere pasos adicionales de instalación, ya que Livewire se instala automáticamente con:

```
composer install
```

No requiere:

- npm run dev

- npm run build

- Configuración adicional


---

## 8. Ejecución del Proyecto

Para iniciar el servidor local:

```
php artisan serve
```
La aplicación estará disponible en:

```
http://127.0.0.1:8000
```

---

## 9. Estructura Básica del Proyecto

```
bookswap/
├── app/
├── bootstrap/
├── config/
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
│   ├── css/
│   ├── js/
│   └── storage/
├── resources/
├── routes/
├── storage/
└── .env

```