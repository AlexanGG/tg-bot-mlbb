<?php

namespace App\Http\Controllers;

use App\Models\Build;
use App\Models\Hero;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BuildController extends Controller
{
    /**
     * Получить сборки для заданного героя по имени.
     *
     * @param string $heroName Имя героя
     * @return JsonResponse JSON с данными сборок
     */
    public function getBuilds(string $heroName): JsonResponse
    {
        $hero = Hero::where('name', $heroName)->first();
        if (!$hero) {
            return response()->json(['error' => "Герой $heroName не найден."], 404);
        }

        $builds = Build::where('hero_id', $hero->id)->get();

        return response()->json($builds);
    }
}
