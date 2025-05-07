<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\HealthProgram;

class HealthProgramsTable extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $programs = HealthProgram::query()
            ->withCount('enrollments')
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('livewire.health-programs-table', [
            'programs' => $programs,
        ]);
    }
}
