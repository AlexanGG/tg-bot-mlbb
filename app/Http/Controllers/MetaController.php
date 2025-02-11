<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MetaController extends Controller
{
    /**
     * Получить мету для заданной роли.
     *
     * @param string $roleName Имя роли (например, "Roamer" или "Mid")
     * @return JsonResponse JSON с данными героев
     */
    public function getMeta(string $roleName): JsonResponse
    {
        // Получаем роль по имени
        $role = Role::where('name', $roleName)->first();
        if (!$role) {
            return response()->json(['error' => "Роль $roleName не найдена."], 404);
        }

        // Получаем героев, у которых есть данная роль (связь many-to-many через таблицу pivot, например, tier_list_hero)
        $heroes = Hero::whereHas('roles', function ($query) use ($role) {
            $query->where('role_id', $role->id);
        })->get();

        return response()->json($heroes);
    }
}

