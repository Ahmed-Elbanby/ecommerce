<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User; // Replace with your models
use App\Models\Faculty;
use App\Models\Classroom;
use App\Models\Section;

class Search extends Component
{
    public $search = ''; // Holds the search query
    public $category = 'users'; // Holds the selected category
    public $results = []; // Holds the search results

    // Categories available for search
    public $categories = [
        'users' => 'Users',
        'faculties' => 'Faculties',
        'classrooms' => 'Classrooms',
        'sections' => 'Sections',
    ];

    // Perform the search automatically when $search or $category changes
    public function updatedSearch()
    {
        $this->search();
    }

    public function updatedCategory()
    {
        $this->search();
    }

    // Search logic
    public function search()
    {
        // Perform the search based on the selected category
        switch ($this->category) {
            case 'users':
                $this->results = User::where('name', 'like', '%' . $this->search . '%')->get();
                break;
            case 'faculties':
                $this->results = Faculty::where('name', 'like', '%' . $this->search . '%')->get();
                break;
            case 'classrooms':
                $this->results = Classroom::where('name', 'like', '%' . $this->search . '%')->get();
                break;
            case 'sections':
                $this->results = Section::where('name', 'like', '%' . $this->search . '%')->get();
                break;
            default:
                $this->results = [];
                break;
        }
    }

    // Render the Livewire view
    public function render()
    {
        return view('livewire.Global_Search');
    }
}