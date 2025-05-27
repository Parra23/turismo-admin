<?php

namespace App\Support;

class Columns
{
    public static function get($resource)
    {
        $all = [
            'users' => [
                ['label' => 'ID', 'key' => 'id'],
                ['label' => 'Names', 'key' => 'name'],
                ['label' => 'Email', 'key' => 'email'],
                ['label' => 'Password', 'key' => 'password'],
                ['label' => 'Rol', 'key' => 'role'],
                ['label' => 'Status', 'key' => 'status'],
                ['label' => 'Creation Date', 'key' => 'created_at'],
            ],
            'departments' => [
                ['label' => 'ID', 'key' => 'id'],
                ['label' => 'Namej', 'key' => 'name'],
            ],
            'cities' => [
                ['label' => 'ID', 'key' => 'id'],
                ['label' => 'Name City', 'key' => 'name_city'],
                ['label' => 'Department', 'key' => 'name_department'],
                ['label' => 'Name Department', 'key' => 'department_id'],
            ],
            'places' => [
                ['label' => 'ID', 'key' => 'place_id'],
                ['label' => 'Place name', 'key' => 'name'],
                ['label' => 'name type', 'key' => 'type_id'],
                ['label' => 'Name tYPe', 'key' => 'name_type'],
                ['label' => 'Description', 'key' => 'description'],
                ['label' => 'Address', 'key' => 'address'],
                ['label' => 'name city', 'key' => 'city_id'],
                ['label' => 'Name cYTy', 'key' => 'name_city'],
                ['label' => 'Opening Hours', 'key' => 'opening_hours'],
                ['label' => 'Fees', 'key' => 'fees'],
                ['label' => 'Coordinates', 'key' => 'coordinates'],
                ['label' => 'Contact Phone', 'key' => 'contact_phone'],
                ['label' => 'Contact Email', 'key' => 'contact_email'],
                ['label' => 'Contact Website', 'key' => 'social_media'],
                ['label' => 'Status', 'key' => 'status'],
                ['label' => 'Creation date', 'key' => 'creation_date'],
                ],'placetypes' => [
                ['label' => 'ID', 'key' => 'id'],
                ['label' => 'Name Type', 'key' => 'name'],
                ['label' => 'Description', 'key' => 'description'],
            ],
            'photos' => [
                ['label' => 'ID', 'key' => 'photo_id'],
                ['label' => 'Place ID', 'key' => 'place_id'],
                ['label' => 'Url', 'key' => 'url'],
                ['label' => 'Description', 'key' => 'description'],
            ],'comments' => [
                ['label' => 'ID', 'key' => 'comment_id'],
                ['label' => 'Place name', 'key' => 'place_id'],
                ['label' => 'plACe Name', 'key' => 'name_place'],
                ['label' => 'User name', 'key' => 'id'],
                ['label' => 'USER NAME', 'key' => 'name'],
                ['label' => 'Comment', 'key' => 'comment'],
                ['label' => 'Parent comment', 'key' => 'parent_comment_id'],
                ['label' => 'Comment Date', 'key' => 'comment_date'], 

            ],

            // Agrega más recursos aquí
        ];

        return $all[$resource] ?? [];
    }
}
