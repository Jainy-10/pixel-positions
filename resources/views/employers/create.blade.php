@extends('layout.app')
@section('title', 'Create Employer Profile - Pixel Positions')
@section('content')
    <x-page-heading>Create Employer Profile</x-page-heading>

    <x-forms.form method="POST" action="/employer/create" enctype="multipart/form-data">
        <x-forms.input name="name" label="Employer / Company Name" />
        <x-forms.input name="description" label="Company Description (Short)"
            placeholder="Tell what your company do, what it's aim?" />
        <x-forms.input name="logo" label="Company Logo (must be a square)" type="file" />
        <x-forms.input name="cover_picture" label="Company Cover picture" type="file"
            helperText="Upload a 3:2 picture" />
        <x-forms.input name="url" label="Company URL (optional)" />

        <x-forms.button>Submit</x-forms.button>
    </x-forms.form>
@endsection
