<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Libro;
use App\Models\UsuarioComun;

class LibroSeeder extends Seeder
{
    public function run()
    {
        $usuarios = UsuarioComun::all();

        $libros = [
    [
        'titulo_libro' => 'El nombre del viento',
        'autor_libro' => 'Patrick Rothfuss',
        'ISBN' => '9788401352831',
        'estado_libro' => 'seminuevo',
        'genero_libro' => 'Fantasía',
        'fecha_publicacion_libro' => '2007-03-27',
        'imagen_libro' => 'https://covers.openlibrary.org/b/isbn/9788401352831-L.jpg',
    ],
    [
        'titulo_libro' => '1984',
        'autor_libro' => 'George Orwell',
        'ISBN' => '9788499890942',
        'estado_libro' => 'usado',
        'genero_libro' => 'Distopía',
        'fecha_publicacion_libro' => '1949-06-08',
        'imagen_libro' => 'https://covers.openlibrary.org/b/isbn/9788499890942-L.jpg',
    ],
    [
        'titulo_libro' => 'La sombra del viento',
        'autor_libro' => 'Carlos Ruiz Zafón',
        'ISBN' => '9788408172173',
        'estado_libro' => 'nuevo',
        'genero_libro' => 'Misterio',
        'fecha_publicacion_libro' => '2001-04-12',
        'imagen_libro' => 'https://covers.openlibrary.org/b/isbn/9788408172173-L.jpg',
    ],
    [
        'titulo_libro' => 'El Hobbit',
        'autor_libro' => 'J.R.R. Tolkien',
        'ISBN' => '9788445071414',
        'estado_libro' => 'seminuevo',
        'genero_libro' => 'Fantasía',
        'fecha_publicacion_libro' => '1937-09-21',
        'imagen_libro' => 'https://covers.openlibrary.org/b/isbn/9788445071414-L.jpg',
    ],
    [
        'titulo_libro' => 'Cien años de soledad',
        'autor_libro' => 'Gabriel García Márquez',
        'ISBN' => '9780307474728',
        'estado_libro' => 'usado',
        'genero_libro' => 'Realismo mágico',
        'fecha_publicacion_libro' => '1967-05-30',
        'imagen_libro' => 'https://covers.openlibrary.org/b/isbn/9780307474728-L.jpg',
    ],
    [
        'titulo_libro' => 'El Principito',
        'autor_libro' => 'Antoine de Saint-Exupéry',
        'ISBN' => '9780156012195',
        'estado_libro' => 'nuevo',
        'genero_libro' => 'Fábula',
        'fecha_publicacion_libro' => '1943-04-06',
        'imagen_libro' => 'https://covers.openlibrary.org/b/isbn/9780156012195-L.jpg',
    ],
    [
        'titulo_libro' => 'Fahrenheit 451',
        'autor_libro' => 'Ray Bradbury',
        'ISBN' => '9781451673319',
        'estado_libro' => 'usado',
        'genero_libro' => 'Ciencia ficción',
        'fecha_publicacion_libro' => '1953-10-19',
        'imagen_libro' => 'https://covers.openlibrary.org/b/isbn/9781451673319-L.jpg',
    ],
    [
        'titulo_libro' => 'Orgullo y prejuicio',
        'autor_libro' => 'Jane Austen',
        'ISBN' => '9780141439518',
        'estado_libro' => 'seminuevo',
        'genero_libro' => 'Romance',
        'fecha_publicacion_libro' => '1813-01-28',
        'imagen_libro' => 'https://covers.openlibrary.org/b/isbn/9780141439518-L.jpg',
    ],
    [
        'titulo_libro' => 'Crimen y castigo',
        'autor_libro' => 'Fiódor Dostoyevski',
        'ISBN' => '9780140449136',
        'estado_libro' => 'usado',
        'genero_libro' => 'Drama',
        'fecha_publicacion_libro' => '1866-01-01',
        'imagen_libro' => 'https://covers.openlibrary.org/b/isbn/9780140449136-L.jpg',
    ],
    [
        'titulo_libro' => 'El retrato de Dorian Gray',
        'autor_libro' => 'Oscar Wilde',
        'ISBN' => '9780141439570',
        'estado_libro' => 'nuevo',
        'genero_libro' => 'Ficción',
        'fecha_publicacion_libro' => '1890-07-20',
        'imagen_libro' => 'https://covers.openlibrary.org/b/isbn/9780141439570-L.jpg',
    ],
    [
        'titulo_libro' => 'Los juegos del hambre',
        'autor_libro' => 'Suzanne Collins',
        'ISBN' => '9780439023528',
        'estado_libro' => 'seminuevo',
        'genero_libro' => 'Juvenil',
        'fecha_publicacion_libro' => '2008-09-14',
        'imagen_libro' => 'https://covers.openlibrary.org/b/isbn/9780439023528-L.jpg',
    ],
    [
        'titulo_libro' => 'El código Da Vinci',
        'autor_libro' => 'Dan Brown',
        'ISBN' => '9780307474278',
        'estado_libro' => 'usado',
        'genero_libro' => 'Thriller',
        'fecha_publicacion_libro' => '2003-03-18',
        'imagen_libro' => 'https://covers.openlibrary.org/b/isbn/9780307474278-L.jpg',
    ],
    [
        'titulo_libro' => 'Los pilares de la Tierra',
        'autor_libro' => 'Ken Follett',
        'ISBN' => '9780451225245',
        'estado_libro' => 'nuevo',
        'genero_libro' => 'Histórica',
        'fecha_publicacion_libro' => '1989-09-01',
        'imagen_libro' => 'https://covers.openlibrary.org/b/isbn/9780451225245-L.jpg',
    ],
    [
        'titulo_libro' => 'El alquimista',
        'autor_libro' => 'Paulo Coelho',
        'ISBN' => '9780061122415',
        'estado_libro' => 'seminuevo',
        'genero_libro' => 'Fábula',
        'fecha_publicacion_libro' => '1988-01-01',
        'imagen_libro' => 'https://covers.openlibrary.org/b/isbn/9780061122415-L.jpg',
    ],
    [
        'titulo_libro' => 'La chica del tren',
        'autor_libro' => 'Paula Hawkins',
        'ISBN' => '9781594634024',
        'estado_libro' => 'usado',
        'genero_libro' => 'Suspense',
        'fecha_publicacion_libro' => '2015-01-13',
        'imagen_libro' => 'https://covers.openlibrary.org/b/isbn/9781594634024-L.jpg',
    ],
];


        foreach ($libros as $libro) {
            Libro::create(array_merge($libro, [
                'id_usuario_comun' => $usuarios->random()->id_usuario_comun,
            ]));
        }
    }
}
