<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Search Bar -->
            <div class="input-group mb-3">
                <!-- Category Dropdown -->
                <select class="form-select" wire:model="category">
                    @foreach ($categories as $key => $label)
                        <option value="{{ $key }}">{{ $label }}</option>
                    @endforeach
                </select>

                <!-- Search Input -->
                <input type="text" class="form-control" placeholder="Search for..." wire:model.debounce.500ms="search">
            </div>

            <!-- Search Results -->
            @if (!empty($results) && !empty($search))
                <div class="list-group">
                    @foreach ($results as $result)
                        <a href="#" class="list-group-item list-group-item-action">
                            {{ $result->name }}
                        </a>
                    @endforeach
                </div>
            @elseif (!empty($search))
                <div class="text-muted mt-3">No results found.</div>
            @endif
        </div>
    </div>
</div>