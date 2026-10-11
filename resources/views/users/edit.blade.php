@extends('layout.app')

@section('title', 'Update')

@section('content')
    <x-page-heading>
        Update Your Info
    </x-page-heading>

    <x-forms.form method="POST" action="{{ route('users.update') }}">
        <x-forms.input label="First Name" name="first_name" value="{{ $user->first_name }}" />
        <x-forms.input label="Last Name" name="last_name" value="{{ $user->last_name }}"/>
        <x-forms.input label="Email" name="email" value="{{ $user->email }}" readonly/>

        
         <div  class="flex  items-center  justify-between">
            <x-forms.button type="submit">Update</x-forms.button>

            @if ($user->isEmployer())
                <div class="text-center text-sm text-gray-400">
                    Want to  update your employer Profile? 
                    <a href="{{ route('employers.edit') }}" class="text-blue-400 hover:text-blue-300 font-semibold underline transition">
                        Update here
                    </a>
                </div>
            @endif
        </div>
        
    </x-forms.form>
@endsection