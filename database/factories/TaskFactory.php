<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['task', 'story', 'bug'];
        $priorities = ['low', 'medium', 'high'];
        $statuses = ['todo', 'in_progress', 'done'];
        $names = ['Alex Johnson', 'Maria Garcia', 'James Smith', 'Sarah Williams', 'David Brown',
            'Emily Davis', 'Michael Miller', 'Jessica Wilson', 'Daniel Taylor', 'Olivia Anderson'];

        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(3),
            'type' => $this->faker->randomElement($types),
            'priority' => $this->faker->randomElement($priorities),
            'assignee' => $this->faker->randomElement($names),
            'status' => $this->faker->randomElement($statuses),
            'created_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
