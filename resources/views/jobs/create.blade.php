@extends('layout.app')

@section('title', 'Post a Job - Pixel Positions')

@section('content')

    <x-page-heading>
        Post a Job
    </x-page-heading>

    <x-forms.form method="POST" action="{{ route('jobs.create') }}">
        <x-forms.input label="Title" name="title" placeholder="CEO" />
        <x-forms.input label="Salary" name="salary" placeholder="$80,000 USD" />
        <x-forms.input label="Location" name="location" placeholder="Winter Park, Florida" />

        <x-forms.select label="Schedule" name="schedule">
            <option>Full Time</option>
            <option>Part Time</option>
        </x-forms.select>

        <x-forms.textarea label="About The Role" name="description" placeholder="Describe the role"></x-forms.textarea>
        <x-forms.textarea label="Key Responsibilities" name="responsibilities"
            placeholder="Describe the responsibilities. (Enter each on the seperate line)"></x-forms.textarea>
        <x-forms.textarea label="Requirements" name="requirements"
            placeholder="What requirements you want from candidate? (Enter each on the seperate line)"></x-forms.textarea>
        <x-forms.checkbox label="Feature (Costs Extra)" name="featured" />

        <x-forms.divider />

        <x-forms.input label="Tags (Comma Seperated)" name="tags" placeholder="IT, Technician, Developer" />

        <x-forms.button>Publish</x-forms.button>
    </x-forms.form>
@endsection
