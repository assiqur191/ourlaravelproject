<!-- resources/views/unauthenticated.blade.php -->

<x-layout>

    <div class="container py-md-5 container--narrow">
        <div class="text-center">
            <h2>Unauthenticated Page</h2>
            <p>You need to be logged in to access this page.</p>
            <p><a href="{{ url('/') }}">Login</a></p>
        </div>
    </div>

</x-layout>
