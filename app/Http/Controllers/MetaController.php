<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\Role;
use Illuminate\Http\JsonResponse;

class MetaController extends Controller
{
    /**
     * Получаем список уровня героя на любой роле.
     *
     * @param string $roleName Название роли, по которой следует фильтровать героев.
     * @return JsonResponse
     */
    public function getMeta(string $roleName): JsonResponse
    {
        // Получаем роли
        $role = Role::where('name', $roleName)->first();

        // Получаем героев для этой роли
        $heroes = Hero::whereHas('roles', function ($query) use ($role) {
            $query->where('role_id', $role->id);
        })->get();

        // Возвращаем данные о героях
        return response()->json($heroes);
    }
}

