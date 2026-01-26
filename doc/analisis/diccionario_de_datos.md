# DICCIONARIO DE DATOS

En el siguiente documento se trata de documentar los metadatos más ligados al almacenamiento de la base de datos de éste nuestro proyecto. Estos son:


### A) Tabla de Usuario_comun:

#### Información general
- **Nombre de la tabla:** `usuario_comun`
- **Descripción:** Almacena los datos principales de los usuarios comunes del sistema.
- **Clave primaria:** `id_usuario_comun`

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

#### Relaciones
No se definen claves foráneas en esta tabla.

#### Índices
- **PRIMARY KEY:** `id_usuario_comun`
- **UNIQUE:** `email_usuario_comun`

#### Notas técnicas
- La contraseña se almacena en formato hash.
- Los campos de fecha permiten controlar procesos automáticos como asignación de créditos o revisión de intercambios.






### B) Tabla de Cartera_Creditos:

#### Información general
- **Nombre de la tabla:** `cartera_creditos`
- **Descripción:** Gestiona el saldo total de créditos asociado a cada usuario común.
- **Clave primaria:** `id_cartera`

#### Campos

| Campo             | Tipo                | Longitud | Nulo | Default        | Clave | Descripción                                              |
|-------------------|---------------------|----------|------|----------------|-------|----------------------------------------------------------|
| id_cartera        | BIGINT UNSIGNED     | —        | NO   | AUTO_INCREMENT | PK    | Identificador único de la cartera.                      |
| saldo_total       | BIGINT UNSIGNED     | —        | NO   | 0              | —     | Saldo total de créditos disponibles.                    |
| id_usuario_comun  | BIGINT UNSIGNED     | —        | SÍ   | NULL           | FK    | Usuario propietario de la cartera.                      |
| created_at        | TIMESTAMP           | —        | SÍ   | NULL           | —     | Fecha de creación del registro.                         |
| updated_at        | TIMESTAMP           | —        | SÍ   | NULL           | —     | Fecha de última actualización del registro.             |

#### Relaciones

| Tipo | Campo origen       | Tabla destino   | Campo destino       | Acción ON DELETE |
|------|--------------------|------------------|----------------------|------------------|
| FK   | id_usuario_comun   | usuario_comun    | id_usuario_comun     | CASCADE          |

#### Índices
- **PRIMARY KEY:** `id_cartera`
- **FOREIGN KEY:** `id_usuario_comun` → `usuario_comun(id_usuario_comun)`

#### Notas técnicas
- La relación con `usuario_comun` es opcional (`nullable`), permitiendo carteras no asignadas inicialmente.
- La eliminación en cascada garantiza que al borrar un usuario se elimine automáticamente su cartera.



### D) Tabla de Libro:

| Atributo                 | Tipo     | Tamaño | Clave | Descripción                                                        |
|--------------------------|----------|--------|-------|--------------------------------------------------------------------|
| id_libro                 | INT      | -      | PK    | Identificador único del libro                                      |
| titulo_libro             | VARCHAR  | 100    | -     | Título del libro                                                   |
| autor_libro              | VARCHAR  | 100    | -     | Autor del libro                                                    |
| ISBN                     | VARCHAR  | 255    | -     | ISBN del libro                                                     |
| estado_libro             | VARCHAR  | 100    | -     | Estado en el que se encuentra el libro                             |
| genero_libro             | VARCHAR  | 100    | -     | Género literario para clasificar al libro                          |
| fecha_publicacion_libro  | DATE     | -      | -     | Fecha en la que se publicó el libro                                |
| id_user_comun            | INT      | -      | FK    | Identificador único del usuario común que lo registró              |


### E) Tabla de Evento_cultural:

| Atributo            | Tipo     | Tamaño | Clave | Descripción                                                                         |
|---------------------|----------|--------|-------|-------------------------------------------------------------------------------------|
| id_evento           | INT      | -      | PK    | Identificador único del evento                                                      |
| nombre_evento       | VARCHAR  | 150    | -     | Nombre del evento                                                                   |
| fecha_evento        | DATE     | -      | -     | Fecha de realización del evento                                                     |
| descripcion_evento  | TEXT     | -      | -     | Descripción del evento                                                              |
| ubicacion_evento    | VARCHAR  | 150    | -     | Lugar donde se va a realizar el evento                                              |
| tipo_evento         | ENUM     | -      | -     | Tipo de evento  ('encuentro con el autor', 'club de lectura', 'feria del libro')    |
| estado_evento       | VARCHAR  | 50     | -     | Estado actual del evento (pendiente, aceptado, rechazado)                           |
| id_entidad_cultural | INT      | -      | FK    | Identificador único de la entidad que lo organiza                                   |
| id_administrador    | INT      | -      | FK    | Identificador único del administrador que lo modera                                 |


### F) Tabla de Cartera_creditos:

| Atributo       | Tipo     | Tamaño | Clave | Descripción                                                        |
|----------------|----------|--------|-------|--------------------------------------------------------------------|
| id_cartera     | INT      | -      | PK    | Identificador único de la cartera                                  |
| saldo_total    | DECIMAL  | 10.2   | -     | Saldo total disponible                                             |
| id_user_comun  | INT      | -      | FK    | Identificador único del usuario común dueño de la cartera          |


### G) Tabla de Movimiento_creditos:

| Atributo          | Tipo     | Tamaño | Clave | Descripción                                                  |
|-------------------|----------|--------|-------|--------------------------------------------------------------|
| id_movimiento     | INT      | -      | PK    | Identificador único del movimiento de crédito                |
| cantidad          | DECIMAL  | 10.2   | -     | Cantidad de créditos                                         |
| tipo_movimiento   | ENUM     | -      | -     | Tipo de movimiento (ganado, gastado, otorgado)               |
| fecha_movimiento  | DATE     | -      | -     | Fecha del ingreso o retirada de los créditos                 |
| id_cartera        | INT      | -      | FK    | Identificador único de la cartera asociada                   |
