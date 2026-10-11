@extends('layout.app')
@section('title', 'Pixel Positions - Register')

@section('content')
    <x-page-heading>Reigster</x-page-heading>

    <x-forms.form method="POST" action="/register">
        <x-forms.input label="First Name" name="first_name" />
        <x-forms.input label="Last Name" name="last_name" />
        <x-forms.input label="Email" name="email" type="email" />
        <x-forms.input label="Password" name="password" type="password" />
        <x-forms.input label="Password Confirmation" name="password_confirmation" type="password" />

        <div class="flex  items-center  justify-between">
            <x-forms.button>Create Account</x-forms.button>

            <div class="text-center text-sm text-gray-400">
                Already have an account?
                <a href="/login" class="text-blue-400 hover:text-blue-300 font-semibold underline transition">
                    Login here
                </a>
            </div>
        </div>

    </x-forms.form>
@endsection
