@if (session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
        {{ session('error') }}
    </div>
@endif