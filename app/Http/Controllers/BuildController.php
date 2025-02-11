<?php

namespace App\Http\Controllers;

use App\Models\Build;
use App\Models\Hero;
use Illuminate\Http\JsonResponse;

class BuildController extends Controller
{
    /**
     * Получаем сборки для конкретного героя.
     *
     * Этот метод получает все сборки, связанные с героем по его имени.
     * Каждая сборка может содержать информацию о предметах, эмблемах и спеллах героя.
     *
     * @param string $heroName Имя героя, для которого необходимо получить сборки.
     *
     * @return JsonResponse JSON-ответ, содержащий сборки для указанного героя.*
     */
    public function getBuilds(string $heroName): JsonResponse
    {
        // Получаем героя по имени
        $hero = Hero::where('name', $heroName)->first();

        // Получаем сборки для этого героя
        $builds = Build::where('hero_id', $hero->id)->get();

        // Возвращаем данные о сборках
        return response()->json($builds);
    }
}
