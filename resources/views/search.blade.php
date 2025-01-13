@extends('layouts.dashboard') <!-- Replace with your layout file -->

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h1 class="mb-4">Search</h1>

                <!-- Search Bar -->
                <div class="input-group mb-3">
                    <!-- Category Dropdown -->
                    <select id="category" class="form-select">
                        <option value="users">Users</option>
                        <option value="faculties">Faculties</option>
                        <option value="classrooms">Classrooms</option>
                        <option value="sections">Sections</option>
                    </select>

                    <!-- Search Input -->
                    <input type="text" id="search" class="form-control" placeholder="Search for...">
                </div>

                <!-- Search Results -->
                <div id="results" class="list-group mt-3"></div>
            </div>
        </div>
    </div>

    <!-- Include jQuery (or use Axios/Fetch if preferred) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Debounce function to limit AJAX requests
            function debounce(func, wait) {
                let timeout;
                return function (...args) {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), wait);
                };
            }

            // Perform search on input change
            $('#search').on('input', debounce(function () {
                const query = $(this).val();
                const category = $('#category').val();

                if (query.length >= 2) { // Only search if query has 2 or more characters
                    $.ajax({
                        url: '/search',
                        method: 'GET',
                        data: {
                            query: query,
                            category: category
                        },
                        success: function (response) {
                            $('#results').html(response); // Update results
                        },
                        error: function (xhr) {
                            console.error('Error:', xhr.responseText);
                        }
                    });
                } else {
                    $('#results').html(''); // Clear results if query is too short
                }
            }, 300)); // 300ms debounce
        });
    </script>
@endsection