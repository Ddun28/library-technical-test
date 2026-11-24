<?php

return [
    'required' => 'El campo :attribute es obligatorio.',
    'string' => 'El campo :attribute debe ser una cadena de texto.',
    'integer' => 'El campo :attribute debe ser un número entero.',
    'numeric' => 'El campo :attribute debe ser un número.',
    'array' => 'El campo :attribute debe ser una lista.',
    'unique' => 'El valor del campo :attribute ya está registrado.',
    'exists' => 'El valor seleccionado para :attribute no es válido.',
    'between' => [
        'numeric' => 'El campo :attribute debe estar entre :min y :max.',
        'string' => 'El campo :attribute debe tener entre :min y :max caracteres.',
    ],
    'min' => [
        'numeric' => 'El campo :attribute debe ser al menos :min.',
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
    ],
    'max' => [
        'numeric' => 'El campo :attribute no debe ser mayor que :max.',
        'string' => 'El campo :attribute no debe tener más de :max caracteres.',
    ],

    'attributes' => [
        'title' => 'título',
        'author' => 'autor',
        'description' => 'descripción',
        'published_year' => 'año de publicación',
        'category_id' => 'categoría',
        'category' => 'categoría',
        'name' => 'nombre',
    ],
];
