<x-layout>
    <x-page-heading>Edit a Job</x-page-heading>

    <x-forms.form method="PATCH" action="/jobs/{{ $job->id }}/update" >
        <x-forms.input label="Title" name="title" value="{{ $job->title }}" placeholder="CEO" />
        <x-forms.input label="Salary" name="salary" value="{{ $job->salary }}" placeholder="$80,000 USD" />
        <x-forms.input label="Location" name="location" value="{{ $job->location }}" placeholder="Winter Park, Florida" />

        <x-forms.select label="Schedule" name="schedule">
            <option>Full Time</option>
            <option>Part Time</option>
        </x-forms.select> 

        <x-forms.textarea label="Description" name="description"  rows="5" cols="40" placeholder="Put your Brief Job Description ">{{ $job->description }}</x-forms.textarea>

        <x-forms.divider />
        
        <x-forms.input label="Tags (Comma Seperated)" name="tags" value="{{ implode(', ', $job->tags->pluck('name')->toArray() ) }}" placeholder="IT, Technician, Developer" />

        <x-forms.button>Publish</x-forms.button>
    </x-forms.form>

</x-layout>