@extends('layouts.app')
<style>
    /* General body and page styling */
body {
    background-color: #f4f4f9;
    font-family: 'Arial', sans-serif;
    color: #333;
}

/* Profile title */
h1 {
    text-align: center;
    font-size: 2rem;
    font-weight: bold;
    color: #4A4A4A;
    margin-bottom: 30px;
}

/* Container for the main content */
.py-12 {
    padding-top: 12px;
    padding-bottom: 12px;
}

/* Styling for the card-like sections */
.bg-white {
    background-color: #ffffff;
}

.dark\:bg-gray-800 {
    background-color: #2d3748; /* Dark mode background */
}

.shadow {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Rounded corners */
.sm\:rounded-lg {
    border-radius: 8px;
}

/* Padding */
.p-4 {
    padding: 16px;
}

.sm\:p-8 {
    padding: 32px;
}

/* Styling for form containers */
.max-w-xl {
    max-width: 600px;
    margin: 0 auto;
}

.space-y-6 > * + * {
    margin-top: 24px;
}

/* Button styling */
button {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

/* Form input fields */
input[type="text"],
input[type="email"],
input[type="password"],
textarea {
    width: 100%;
    padding: 12px 20px;
    margin-bottom: 12px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 1rem;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="password"]:focus,
textarea:focus {
    border-color: #4CAF50;
    outline: none;
}

/* Responsive design */
@media (max-width: 768px) {
    h1 {
        font-size: 1.5rem;
    }

    .max-w-xl {
        max-width: 100%;
    }

    .sm\:rounded-lg {
        border-radius: 4px;
    }

    .sm\:p-8 {
        padding: 16px;
    }
}
</style>
@section('content')
    <h1>Profile Page</h1>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form', ['user' => $user])
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form', ['user' => $user])
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form', ['user' => $user])
                </div>
            </div>
        </div>
    </div>
@endsection