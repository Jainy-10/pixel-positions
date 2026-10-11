@extends('layout.app')
@section('title', 'Pixel Positions - Login')

@section('content')

    <x-page-heading>Login</x-page-heading>

    <x-forms.form method="POST" action="/login">
        <x-forms.input label="Email" name="email" type="email" />
        <x-forms.input label="Password" name="password" type="password" />
        <div class="flex  items-center  justify-between">
            <x-forms.button>Login</x-forms.button>

            <div class="text-center text-sm text-gray-400">
                Do not have an account?
                <a href="/register" class="text-blue-400 hover:text-blue-300 font-semibold underline transition">
                    Register here
                </a>
            </div>
        </div>

    </x-forms.form>
@endsection
