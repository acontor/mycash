<?php

namespace App\Listeners;

use App\Events\UserCreatedEvent;
use App\Models\Category;
use App\Models\User;

class CreateDefaultCategoriesToNewUserListener
{
    /**
     * Handle the event.
     *
     * @param UserCreatedEvent $event
     *
     * @return void
     */
    public function handle(UserCreatedEvent $event): void
    {
        $user = $event->user;

        $this->createCategory('#580eeb', 'bi bi-bank', 'Cuenta Corriente', 'Cuentas', $user);
        $this->createCategory('#580eeb', 'bi bi-piggy-bank', 'Cuenta Ahorro', 'Cuentas', $user);
        $this->createCategory('#580eeb', 'bi bi-wallet', 'Cuenta Objetivos', 'Cuentas', $user);
        $this->createCategory('#580eeb', 'bi bi-bag', 'Ropa', 'Transacciones', $user);
    }

    private function createCategory(
        string $color,
        string $icon,
        string $name,
        string $type,
        User $user
    ): void {
        Category::create([
            'color'   => $color,
            'icon'    => $icon,
            'name'    => $name,
            'type'    => $type,
            'user_id' => $user->id,
        ]);
    }
}
