@extends('layout.app')

@section('content')
    <x-page-heading>Update Employer Profile</x-page-heading>

    <x-forms.form method="PATCH" action="/employer"  enctype="multipart/form-data">
        <x-forms.input name="name" label="Employer / Company Name" value="{{ $employer->name }}" />
        <x-forms.input name="description" label="Company Description (Short)" value="{{ $employer->description }}"/>
        <x-forms.input name="logo" label="Company Logo (must be a square)" type="file" helperText="Leave empty if you do not want to change it." />
        <div>
            <img class="aspect-square w-20" src="{{ Storage::disk('public')->url($employer->logo) }}" alt="failed to load the file ">
        </div>

        <x-forms.input name="logo" label="Company Cover picture" type="file" helperText="Leave empty if you do not want to change it." />
        <div>
            <img class=" w-50" src="{{ Storage::disk('public')->url($employer->cover_picture) }}" alt="failed to load the file ">
        </div>

        <x-forms.input name="url" label="Company URL (optional)" value="{{ $employer->url }}" />
        
        <x-forms.button>Submit</x-forms.button>
    </x-forms.form>
@endsection