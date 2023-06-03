<!-- resources/views/admin/editors/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Add Editor</h1>
        <form action="{{ route('admin.editors.store') }}" method="POST" class="max-w-md">
            @csrf
            <!-- Add your form fields here -->
            <div class="mb-4">
                <label for="name" class="block mb-2 font-bold">Name</label>
                <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded p-2" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block mb-2 font-bold">Email</label>
                <input type="email" name="email" id="email" class="w-full border border-gray-300 rounded p-2" required>
            </div>
            <!-- Add other fields as needed -->

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Add Editor</button>
        </form>
    </div>
@endsection
