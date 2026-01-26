# Manual de Despliegue — BookSwap

## 1. Introducción

Este documento describe de forma general el proceso de despliegue de la aplicación **BookSwap** en un entorno de producción utilizando Amazon Web Services (AWS), contenedores Docker, un reverse proxy basado en Caddy, dominios dinámicos y un repositorio Git bare para la entrega del código.  

---

## 2. Arquitectura General

El despliegue se basa en una arquitectura modular:

- **AWS EC2** como servidor principal.
- **Docker** para contenerizar los servicios.
- **Docker Compose** para orquestación.
- **Caddy** como reverse proxy y gestor automático de certificados TLS.
- **Contenedor Laravel (PHP-FPM)** para la aplicación.
- **Contenedor MySQL** para la base de datos.
- **Repositorio Git bare** para recibir actualizaciones del código.
- **Dominios dinámicos**

Esta arquitectura permite un despliegue reproducible, portable y fácilmente escalable.

---

## 3. Preparación del Servidor AWS

1. Crear una instancia **EC2** (Ubuntu LTS o Amazon Linux 2).
2. Configurar el **Security Group** permitiendo:
   - Puerto 22 (SSH)
   - Puerto 80 (HTTP)
   - Puerto 443 (HTTPS)
3. Instalar en el servidor:
   - Docker  
   - Docker Compose  
   - Git  

El servidor queda preparado para ejecutar contenedores y recibir código mediante Git.

---

## 4. Repositorio Git Bare

Para permitir despliegues mediante `git push`:

1. Configurar un hook `post-receive` que:
   - Actualice el código en el directorio del proyecto.
   - Instale dependencias.
   - Ejecute migraciones.
   - Reinicie o reconstruya contenedores si es necesario.

El flujo de despliegue queda así:

```bash
git push production main
```

---

## 5. Contenerización con Docker

El proyecto se ejecuta mediante un archivo `compose.yml` que define servicios como:

- **app**: contenedor Laravel con PHP-FPM.
- **mysql**: base de datos MySQL.
- **caddy**: reverse proxy.

Cada servicio define su imagen, volúmenes y variables de entorno.  
Los detalles concretos se ajustan en el despliegue real.

---

## 6. Reverse Proxy con Caddy

Caddy actúa como reverse proxy y gestor de certificados TLS.

Configuración general:

- Escucha en puertos 80 y 443.
- Redirige tráfico hacia el contenedor Laravel.
- Gestiona certificados para los dominios dinámicos.

---

## 7. Configuración de Dominios

El despliegue utiliza dos dominios dinámicos.

Pasos generales:

1. Registrar ambos dominios en sus servicios.
2. Configurar el cliente dinámico en el servidor.
3. Apuntar los dominios a la IP pública de la instancia EC2.
4. Verificar que Caddy puede emitir certificados para ambos.

---

## 8. Variables de Entorno

El archivo `.env` se gestiona fuera del repositorio y se monta como volumen en el contenedor Laravel.

Incluye:

- Configuración de base de datos.
- Clave de aplicación.
- Configuración de almacenamiento.
- Opciones de caché y sesión.

---

## 9. Base de Datos MySQL

El contenedor MySQL se inicializa con:

- Usuario.
- Contraseña.
- Base de datos para BookSwap.

Migraciones y seeders se ejecutan desde el contenedor Laravel:

```bash
php artisan migrate --force
php artisan db:seed --force
```

---

## 10. Flujo de Despliegue

1. El desarrollador realiza cambios en local.
2. Se ejecuta:
   ```bash
   git push production main
   ```
3. El repositorio bare recibe el código.
4. El hook `post-receive` actualiza el proyecto.
5. Docker Compose reinicia o reconstruye contenedores.
6. Caddy mantiene el servicio accesible mediante HTTPS.

---

## 11. Logs y Supervisión

Los logs de cada contenedor pueden consultarse con:

```bash
docker logs nombre_del_contenedor
```

Caddy mantiene registros de acceso y errores.

