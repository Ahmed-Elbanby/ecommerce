<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Replace with your models
use App\Models\Faculty;
use App\Models\Classroom;
use App\Models\Section;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $category = $request->input('category');

        // Perform the search based on the selected category
        switch ($category) {
            case 'users':
                $results = User::where('name', 'like', '%' . $query . '%')->get();
                break;
            case 'faculties':
                $results = Faculty::where('name', 'like', '%' . $query . '%')->get();
                break;
            case 'classrooms':
                $results = Classroom::where('name', 'like', '%' . $query . '%')->get();
                break;
            case 'sections':
                $results = Section::where('name', 'like', '%' . $query . '%')->get();
                break;
            default:
                $results = collect(); // Return an empty collection
                break;
        }

        // Return the results as HTML
        if ($results->isEmpty()) {
            return '<div class="text-muted">No results found.</div>';
        }

        $html = '';
        foreach ($results as $result) {
            $html .= '<a href="#" class="list-group-item list-group-item-action">' . $result->name . '</a>';
        }

        return $html;
    }
}