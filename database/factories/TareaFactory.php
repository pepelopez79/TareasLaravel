<?php

namespace Database\Factories;

use App\Models\Tarea;
use App\Models\User;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class TareaFactory extends Factory
{
    protected $model = Tarea::class;

    public function definition()
    {
        return [
            'usuario_id' => User::factory(),
            'categoria_id' => Categoria::factory(),
            'titulo' => $this->faker->sentence,
            'contenido' => $this->faker->paragraph,
        ];
    }
}
