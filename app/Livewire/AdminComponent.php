<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Gate;
use Livewire\Component;

abstract class AdminComponent extends Component
{
    public function boot(): void { Gate::authorize('access-admin'); }
}
