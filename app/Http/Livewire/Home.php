<?php

namespace App\Http\Livewire;

use App\Models\School;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;

    public $query;

    public function updatingQuery()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.home', [
            'schools' => School::with(['author', 'majors'])
                ->where('school_name', 'like', "%{$this->query}%")
                ->orWhere('address', 'like', "%{$this->query}%")
                ->orWhere('contact', 'like', "%{$this->query}%")
                ->orWhere('type', 'like', "%{$this->query}%")
                ->paginate(6),
        ]);
    }
}