# DICCIONARIO DE DATOS

En el siguiente documento se trata de documentar los metadatos más ligados al almacenamiento de la base de datos de éste nuestro proyecto. Estos son:


### A) Tabla de Usuario_comun:

#### Campos

| Campo                         | Tipo                | Longitud | Nulo | Default        | Clave   | Descripción                                      |
|------------------------------|---------------------|----------|------|----------------|---------|--------------------------------------------------|
| id_usuario_comun            | BIGINT UNSIGNED     | —        | NO   | AUTO_INCREMENT | PK      | Identificador único del usuario.                 |
| nombre_usuario_comun        | VARCHAR             | 100      | NO   | —              | —       | Nombre del usuario.                              |
| apellidos_usuario_comun     | VARCHAR             | 100      | NO   | —              | —       | Apellidos del usuario.                           |
| email_usuario_comun         | VARCHAR             | 100      | NO   | —              | UNIQUE  | Correo electrónico del usuario.                  |
| password                    | VARCHAR             | 255      | NO   | —              | —       | Contraseña hasheada del usuario.                 |
| telefono_usuario_comun      | VARCHAR             | 100      | NO   | —              | —       | Teléfono de contacto.                            |
| ciudad_usuario_comun        | VARCHAR             | 100      | NO   | —              | —       | Ciudad de residencia.                            |
| ultima_revision_intercambios| TIMESTAMP           | —        | SÍ   | NULL           | —       | Fecha de la última revisión de intercambios.     |
| ultima_asignacion_creditos  | DATE                | —        | SÍ   | NULL           | —       | Fecha de la última asignación de créditos.       |
| created_at                  | TIMESTAMP           | —        | SÍ   | NULL           | —       | Fecha de creación del registro.                  |
| updated_at                  | TIMESTAMP           | —        | SÍ   | NULL           | —       | Fecha de última actualización del registro.      |


---


### B) Tabla de Cartera_Creditos:

#### Campos

| Campo             | Tipo                | Longitud | Nulo | Default        | Clave | Descripción                                              |
|-------------------|---------------------|----------|------|----------------|-------|----------------------------------------------------------|
| id_cartera        | BIGINT UNSIGNED     | —        | NO   | AUTO_INCREMENT | PK    | Identificador único de la cartera.                      |
| saldo_total       | BIGINT UNSIGNED     | —        | NO   | 0              | —     | Saldo total de créditos disponibles.                    |
| id_usuario_comun  | BIGINT UNSIGNED     | —        | SÍ   | NULL           | FK    | Usuario propietario de la cartera.                      |
| created_at        | TIMESTAMP           | —        | SÍ   | NULL           | —     | Fecha de creación del registro.                         |
| updated_at        | TIMESTAMP           | —        | SÍ   | NULL           | —     | Fecha de última actualización del registro.             |


---


### C) Tabla de Entidad_Cultural:

#### Campos

| Campo                       | Tipo            | Longitud | Nulo | Default        | Clave  | Descripción                                      |
|-----------------------------|-----------------|----------|------|----------------|--------|--------------------------------------------------|
| id_entidad_cultural        | BIGINT UNSIGNED | —        | NO   | AUTO_INCREMENT | PK     | Identificador único de la entidad cultural.      |
| nombre_entidad_cultural    | VARCHAR         | 100      | NO   | —              | —      | Nombre de la entidad cultural.                   |
| email_entidad_cultural     | VARCHAR         | 100      | NO   | —              | UNIQUE | Correo electrónico de la entidad.                |
| password                   | VARCHAR         | 255      | NO   | —              | —      | Contraseña hasheada de acceso.                   |
| telefono_entidad_cultural  | VARCHAR         | 100      | NO   | —              | —      | Teléfono de contacto.                            |
| ciudad_entidad_cultural    | VARCHAR         | 100      | NO   | —              | —      | Ciudad donde se ubica la entidad.                |
| direccion_entidad_cultural | VARCHAR         | 255      | NO   | —              | —      | Dirección física completa.                       |
| web_entidad_cultural       | VARCHAR         | 255      | SÍ   | NULL           | —      | Página web oficial de la entidad.                |
| created_at                 | TIMESTAMP       | —        | SÍ   | NULL           | —      | Fecha de creación del registro.                  |
| updated_at                 | TIMESTAMP       | —        | SÍ   | NULL           | —      | Fecha de última actualización del registro.      |


---


### D) Tabla de Evento_Cultural:

#### Campos

| Campo              | Tipo            | Longitud | Nulo | Default        | Clave | Descripción                                                |
|--------------------|-----------------|----------|------|----------------|-------|------------------------------------------------------------|
| id_evento          | BIGINT UNSIGNED | —        | NO   | AUTO_INCREMENT | PK    | Identificador único del evento.                           |
| nombre_evento      | VARCHAR         | 150      | NO   | —              | —     | Nombre del evento cultural.                               |
| fecha_evento       | DATETIME        | —        | NO   | —              | —     | Fecha y hora de realización del evento.                   |
| descripcion_evento | TEXT            | —        | NO   | —              | —     | Descripción detallada del evento.                         |
| ubicacion_evento   | VARCHAR         | 150      | NO   | —              | —     | Lugar donde se llevará a cabo el evento.                  |
| tipo_evento        | ENUM            | —        | NO   | —              | —     | Tipo de evento: *encuentro con autor/a*, *club de lectura*, *feria del libro*. |
| id_entidad_cultural| BIGINT UNSIGNED | —        | SÍ   | NULL           | FK    | Entidad cultural organizadora del evento.                 |
| created_at         | TIMESTAMP       | —        | SÍ   | NULL           | —     | Fecha de creación del registro.                           |
| updated_at         | TIMESTAMP       | —        | SÍ   | NULL           | —     | Fecha de última actualización del registro.               |


---


### C) Tabla de Libro:

#### Campos

| Campo                     | Tipo            | Longitud | Nulo | Default        | Clave | Descripción                                                         |
|---------------------------|-----------------|----------|------|----------------|-------|---------------------------------------------------------------------|
| id_libro                  | BIGINT UNSIGNED | —        | NO   | AUTO_INCREMENT | PK    | Identificador único del libro.                                     |
| titulo_libro              | VARCHAR         | 150      | NO   | —              | —     | Título del libro.                                                   |
| autor_libro               | VARCHAR         | 150      | NO   | —              | —     | Autor o autora del libro.                                           |
| ISBN                      | VARCHAR         | 20       | NO   | —              | UNIQUE| Código ISBN del libro.                                              |
| estado_libro              | ENUM            | —        | NO   | —              | —     | Estado físico del libro: *nuevo*, *seminuevo*, *usado*.             |
| genero_libro              | VARCHAR         | 150      | SÍ   | NULL           | —     | Género literario del libro.                                         |
| fecha_publicacion_libro   | DATE            | —        | NO   | —              | —     | Fecha de publicación del libro.                                     |
| estado_intercambio        | VARCHAR         | —        | NO   | 'libre'        | —     | Estado del libro dentro del sistema de intercambio.                 |
| imagen_libro              | VARCHAR         | —        | NO   | —              | —     | Ruta del archivo de la imagen del libro.                   |
| id_usuario_comun          | BIGINT UNSIGNED | —        | NO   | —              | FK    | Usuario propietario del libro.                                      |
| created_at                | TIMESTAMP       | —        | SÍ   | NULL           | —     | Fecha de creación del registro.                                     |
| updated_at                | TIMESTAMP       | —        | SÍ   | NULL           | —     | Fecha de última actualización del registro.                         |


---


### C) Tabla de Intercambios:

#### Campos

| Campo              | Tipo            | Longitud | Nulo | Default        | Clave | Descripción                                                                 |
|--------------------|-----------------|----------|------|----------------|-------|-----------------------------------------------------------------------------|
| id                 | BIGINT UNSIGNED | —        | NO   | AUTO_INCREMENT | PK    | Identificador único del intercambio.                                       |
| libro_id           | BIGINT UNSIGNED | —        | NO   | —              | FK    | Libro solicitado por el usuario solicitante.                               |
| solicitante_id     | BIGINT UNSIGNED | —        | NO   | —              | FK    | Usuario que solicita el intercambio.                                       |
| propietario_id     | BIGINT UNSIGNED | —        | NO   | —              | FK    | Usuario propietario del libro solicitado.                                  |
| estado             | ENUM            | —        | NO   | 'pendiente'    | —     | Estado del intercambio: *pendiente*, *aceptado*, *rechazado*.              |
| libro_ofrecido_id  | BIGINT UNSIGNED | —        | SÍ   | NULL           | FK    | Libro ofrecido por el solicitante como parte del intercambio (opcional).   |
| created_at         | TIMESTAMP       | —        | SÍ   | NULL           | —     | Fecha de creación del registro.                                            |
| updated_at         | TIMESTAMP       | —        | SÍ   | NULL           | —     | Fecha de última actualización del registro.                                |

