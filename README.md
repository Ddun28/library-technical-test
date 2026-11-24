# Biblioteca API

Pequeña aplicación Laravel para gestionar una biblioteca de libros: CRUD de libros,
CRUD de categorías, filtrado por categoría y una interfaz web para operar todo desde el
navegador.

El proyecto está construido siguiendo el patrón MVC, con **Form Requests** para la
validación, **API Resources** para las respuestas JSON, **Eloquent** para el acceso a
datos, migraciones/seeders y pruebas de integración.

---

## Stack

| Componente | Versión |
| --- | --- |
| PHP | 8.3 |
| Laravel | 13 |
| Base de datos | SQLite (por defecto; compatible con MySQL/PostgreSQL) |
| Pruebas | PHPUnit 12 |

---

## Funcionalidades

- Listar todos los libros con su categoría.
- Filtrar libros por categoría (`GET /books?category={id}`).
- Crear un libro asociándolo a una categoría existente.
- Editar la información de un libro.
- Eliminar un libro (con `404` si no existe).
- Crear, listar, editar y eliminar categorías.
- Impedir la eliminación de una categoría con libros asociados (`409 Conflict`).
- Interfaz web en `/` que consume la misma API.
- Validación con mensajes en español y respuestas HTTP coherentes.

---

## Instalación

Requisitos: PHP >= 8.3 y Composer.

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan serve
```

La aplicación queda disponible en <http://localhost:8000>:

- `/` → interfaz de gestión.
- `/books`, `/categories` → endpoints JSON.

### Configurar MySQL (opcional)

Edita `.env`:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=biblioteca
DB_USERNAME=root
DB_PASSWORD=
```

Después ejecuta de nuevo `php artisan migrate --seed`.

---

## Modelo de datos

### `categories`

| Columna | Tipo | Restricciones |
| --- | --- | --- |
| `id` | BIGINT unsigned | PK, autoincremental |
| `name` | VARCHAR(255) | Requerido, único |
| `created_at`, `updated_at` | TIMESTAMP | |

### `books`

| Columna | Tipo | Restricciones |
| --- | --- | --- |
| `id` | BIGINT unsigned | PK, autoincremental |
| `title` | VARCHAR(255) | Requerido |
| `author` | VARCHAR(255) | Requerido |
| `description` | TEXT | Opcional |
| `published_year` | SMALLINT unsigned | Requerido |
| `category_id` | BIGINT unsigned | FK → `categories.id`, requerido |
| `created_at`, `updated_at` | TIMESTAMP | |

La FK usa `RESTRICT` al borrar, como red de seguridad adicional a la regla de negocio.

### Relaciones Eloquent

```php
Category::find(1)->books; // HasMany
Book::find(1)->category;  // BelongsTo
```

---

## Endpoints

Todas las rutas responden JSON y están expuestas **sin el prefijo `/api`** para
respetar el contrato solicitado. Las actualizaciones usan `PUT` con el payload
completo; no se expone `PATCH`.

### Libros

| Método | Ruta | Descripción |
| --- | --- | --- |
| `GET` | `/books` | Lista todos los libros. |
| `GET` | `/books?category={id}` | Lista los libros de una categoría. |
| `GET` | `/books/{id}` | Muestra un libro. |
| `POST` | `/books` | Crea un libro. |
| `PUT` | `/books/{id}` | Actualiza un libro. |
| `DELETE` | `/books/{id}` | Elimina un libro. |

### Categorías

| Método | Ruta | Descripción |
| --- | --- | --- |
| `GET` | `/categories` | Lista categorías con su número de libros. |
| `GET` | `/categories/{id}` | Muestra una categoría. |
| `POST` | `/categories` | Crea una categoría. |
| `PUT` | `/categories/{id}` | Actualiza una categoría. |
| `DELETE` | `/categories/{id}` | Elimina una categoría sin libros. |

### Ejemplos

Listar y filtrar:

```bash
curl -H "Accept: application/json" http://localhost:8000/books
curl -H "Accept: application/json" "http://localhost:8000/books?category=1"
```

Crear un libro:

```bash
curl -X POST http://localhost:8000/books \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Cien años de soledad",
    "author": "Gabriel García Márquez",
    "description": "La saga de la familia Buendía.",
    "published_year": 1967,
    "category_id": 1
  }'
```

Actualizar:

```bash
curl -X PUT http://localhost:8000/books/1 \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Cien años de soledad",
    "author": "Gabriel García Márquez",
    "published_year": 1967,
    "category_id": 1
  }'
```

Eliminar:

```bash
curl -X DELETE http://localhost:8000/books/1 -H "Accept: application/json"
```

Crear una categoría:

```bash
curl -X POST http://localhost:8000/categories \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{"name": "Ensayo"}'
```

La colección de libros se devuelve con el envoltorio estándar de Laravel:

```json
{
  "data": [
    {
      "id": 1,
      "title": "Dune",
      "author": "Frank Herbert",
      "description": "La lucha por el control de Arrakis.",
      "published_year": 1965,
      "category_id": 2,
      "category": { "id": 2, "name": "Ciencia ficción" },
      "created_at": "2026-11-23T20:30:00+00:00",
      "updated_at": "2026-11-23T20:30:00+00:00"
    }
  ]
}
```

---

## Validaciones

| Campo | Reglas |
| --- | --- |
| `title` | `required`, `string`, `min:3`, `max:255` |
| `author` | `required`, `string`, `max:255` |
| `description` | `nullable`, `string`, `max:5000` |
| `published_year` | `required`, `integer`, `between:1000,año actual` |
| `category_id` | `required`, `integer`, `exists:categories,id` |
| `category.name` | `required`, `string`, `max:255`, `unique:categories,name` (ignora la propia categoría al editar) |
| `?category` | `nullable`, `integer`, `exists:categories,id` |

Los errores de validación devuelven `422` con el formato estándar:

```json
{
  "message": "Los datos proporcionados no son válidos.",
  "errors": {
    "title": ["El campo título es obligatorio."]
  }
}
```

---

## Códigos HTTP

| Código | Cuándo |
| --- | --- |
| `200 OK` | Listados, consultas y actualizaciones correctas. |
| `201 Created` | Libro o categoría creados. |
| `204 No Content` | Eliminación correcta. |
| `404 Not Found` | El libro o la categoría no existe. |
| `409 Conflict` | Se intenta eliminar una categoría con libros asociados. |
| `422 Unprocessable Content` | Errores de validación. |
| `429 Too Many Requests` | Límite de 60 peticiones por minuto por IP. |

Ejemplo de conflicto al borrar una categoría con libros:

```json
{
  "message": "No se puede eliminar la categoría porque tiene libros asociados.",
  "code": "CATEGORY_HAS_BOOKS",
  "books_count": 3
}
```

---

## Arquitectura

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Api/BookController.php
│   │   ├── Api/CategoryController.php
│   │   └── DashboardController.php
│   ├── Requests/
│   │   ├── Book/{BookRequest,StoreBookRequest,UpdateBookRequest,IndexBookRequest}.php
│   │   └── Category/{StoreCategoryRequest,UpdateCategoryRequest}.php
│   └── Resources/{BookResource,CategoryResource}.php
├── Models/{Book,Category}.php
database/
├── factories/{BookFactory,CategoryFactory}.php
├── migrations/2026_11_23_00000{1,2}_*.php
└── seeders/{CategorySeeder,BookSeeder,DatabaseSeeder}.php
routes/{api.php,web.php}
tests/Feature/{BookApiTest,CategoryApiTest}.php
```

Decisiones destacadas:

- **Form Requests** desacoplan la validación de los controladores; `StoreBookRequest`
  y `UpdateBookRequest` comparten la misma base `BookRequest`.
- **API Resources** centralizan la representación JSON y evitan exponer campos
  internos. La categoría se incluye solo cuando está cargada (`whenLoaded`).
- **Scope `filterByCategory`** encapsula el filtro opcional en el modelo.
- **Eager loading** (`with('category')`, `withCount('books')`) para evitar consultas N+1.
- **Regla de negocio + FK `RESTRICT`**: la categoría se valida en el controlador y la
  base de datos actúa como última barrera.
- **Rutas de API sin prefijo** (`bootstrap/app.php` → `apiPrefix: ''`) para cumplir
  exactamente el contrato solicitado.
- **Rate limiting** de 60 req/min por IP en el grupo `api`.
- **Mensajes en español** mediante `lang/es/validation.php`.

---

## Pruebas

```bash
php artisan test
```

Cobertura funcional:

- Listado y filtrado de libros (incluida categoría sin libros).
- Filtro con categoría inexistente.
- Creación, actualización y eliminación de libros.
- Validaciones de campos obligatorios, longitud mínima del título, año inválido y
  categoría inexistente.
- `404` al operar sobre libros inexistentes.
- CRUD de categorías, nombre único (también al editar) y `409` al borrar una
  categoría con libros.

Las pruebas usan SQLite en memoria (`phpunit.xml`), por lo que no afectan a la base
de datos local.

---

## Seeders

`php artisan migrate --seed` crea 6 categorías y 14 libros de ejemplo. Los seeders son
idempotentes (`firstOrCreate` / `updateOrCreate`), por lo que pueden ejecutarse varias
veces sin duplicar registros.

```bash
php artisan db:seed
```

---

## Interfaz web

`GET /` sirve una SPA ligera (Blade + JavaScript vanilla, sin build step) que permite:

- Ver y filtrar libros.
- Crear/editar libros en un diálogo modal.
- Eliminar libros.
- Añadir y eliminar categorías, mostrando cuántos libros tiene cada una y bloqueando
  la eliminación cuando corresponde.

La interfaz consume la API con `fetch`, por lo que cualquier cambio en los endpoints
se refleja automáticamente en la UI. Usa diálogos de confirmación propios (sin el
`confirm()` nativo del navegador), avisos no bloqueantes y estados de carga. El
formulario tiene `novalidate`, de modo que los mensajes de validación provienen de la
API y se muestran junto a cada campo.

---

## Posibles siguientes pasos

- Autenticación (Sanctum) y políticas de autorización.
- Paginación y búsqueda por título/autor.
- Versionado de la API (`/v1`).
- Observabilidad con Telescope/Pulse.
# library-technical-test
