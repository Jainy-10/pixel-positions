@extends('layout.app')

@section('title', 'Apply for ' . $job->title)

@section('content')

<section class="py-3">

    <div class="max-w-3xl mx-auto px-6">

        {{-- Heading --}}
        <div class="text-center mb-12">
            <h1 class="text-5xl font-bold text-on-surface">
                Apply for {{ $job->title }}
            </h1>

            <p class="mt-4 text-on-surface-variant text-lg">
                {{ $job->short_descroption}}
            </p>
        </div>


        {{-- Card --}}
        <div class="glass-card rounded-xl p-8 md:p-10">

            <form
                action="{{ route('applications.store',$job) }}"
                method="POST"
                enctype="multipart/form-data"
                id="applicationForm" >

                @csrf

                {{-- ============================= --}}
                {{-- Applicant Identity --}}
                {{-- ============================= --}}

                <div>
                    <div class="flex items-center gap-3 mb-6">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-7 h-7 text-primary"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2"
                             viewBox="0 0 24 24">
                            <path d="M20 21a8 8 0 10-16 0"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>

                        <h2 class="text-2xl font-semibold text-on-surface">
                            Applicant Identity
                        </h2>
                    </div>


                    <div class="grid md:grid-cols-2 gap-6">

                        {{-- First Name --}}
                        <div>

                            <label
                                class="block mb-2 uppercase text-xs tracking-widest text-outline">
                                First Name
                            </label>

                            <input
                                readonly
                                value="{{ ucfirst(auth()->user()->first_name) }}"
                                class="w-full rounded-lg bg-surface-container-low border border-outline-variant px-4 py-3 text-on-surface-variant cursor-not-allowed">

                        </div>

                        {{-- Last Name --}}
                        <div>

                            <label
                                class="block mb-2 uppercase text-xs tracking-widest text-outline">
                                Last Name
                            </label>

                            <input
                                readonly
                                value="{{ ucfirst(auth()->user()->last_name) }}"
                                class="w-full rounded-lg bg-surface-container-low border border-outline-variant px-4 py-3 text-on-surface-variant cursor-not-allowed">

                        </div>

                        {{-- Email --}}
                        <div class="md:col-span-2 ">

                            <label
                                class="block mb-2 uppercase text-xs tracking-widest text-outline">
                                Email Address
                            </label>

                            <input
                                readonly
                                value="{{ auth()->user()->email }}"
                                class="w-full rounded-lg bg-surface-container-low border border-outline-variant px-4 py-3 text-on-surface-variant cursor-not-allowed">

                        </div>
                    </div>


                    {{-- Notice --}}
                    <div
                        class="mt-6 flex items-start gap-3 rounded-lg border border-outline-variant bg-surface-container-low px-4 py-3 ">                       
                        
                        <span class="material-symbols-outlined text-secondary -mt-0.5 h-0">
                                info
                        </span>
                        

                        <p class="text-sm text-on-surface-variant">

                            To edit your information, please visit your

                            <a
                                href="#{{--  route('profile.edit') --}}"
                                class="text-primary hover:underline font-medium">

                                User Profile

                            </a>

                        </p>

                    </div>

                </div>


                {{-- ============================= --}}
                {{-- Resume --}}
                {{-- ============================= --}}

                <div class="mt-12">

                    <div class="flex items-center gap-3 mb-5">

                        <span style="font-size: 25px" class="material-symbols-outlined text-primary">
                            description
                        </span>

                        <h2 class="text-2xl font-semibold">
                            Upload Your Resume
                        </h2>

                    </div>


                    {{-- Upload Area --}}

                    <label
                        for="resume"
                        id="dropZone"
                        class="group flex h-50 cursor-pointer flex-col items-center justify-center rounded-xl border-2 border-dashed border-outline-variant transition hover:border-primary hover:bg-primary/5">

                        <div
                            class="mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-surface-container">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-8 w-8 text-primary"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="2"
                                 viewBox="0 0 24 24">

                                <path d="M12 16V4"/>
                                <path d="M8 8l4-4 4 4"/>
                                <path d="M20 16.5A3.5 3.5 0 0016.5 13H15"/>
                                <path d="M4 16.5A3.5 3.5 0 017.5 13H9"/>

                            </svg>

                        </div>

                        <p class="text-lg text-on-surface">
                            Click to upload or drag & drop
                        </p>

                        <p class="mt-2 text-sm text-outline">
                            PDF, DOC or DOCX (Max 5MB)
                        </p>

                    </label>

                    <input
                        id="resume"
                        type="file"
                        name="resume"
                        class="hidden">

                    {{-- Selected file --}}
                    <div
                        id="selectedFile"
                        class="hidden mt-5 rounded-lg border border-primary bg-surface-container p-4">

                        <div class="flex items-center justify-between">

                            <span
                                id="fileName"
                                class="text-on-surface"></span>

                            <button
                                type="button"
                                id="removeFile"
                                class="text-red-400 hover:text-red-300">

                                Remove

                            </button>

                        </div>

                    </div>

                    @error('resume')

                        <p class="mt-3 text-sm text-red-400">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

                {{-- ============================= --}}
                {{-- Cover Letter --}}
                {{-- ============================= --}}

                <div class="mt-12">

                    <div class="flex items-center gap-3 mb-5">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6 text-primary"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>

                        </svg>

                        <h2 class="text-2xl font-semibold text-on-surface">
                            Cover Letter
                        </h2>

                    </div>

                    <p class="mb-4 text-sm text-on-surface-variant">
                        Introduce yourself and explain why you're a great fit for this position.
                    </p>

                    <textarea
                        name="cover_letter"
                        rows="10"
                        placeholder="Write your cover letter here..."
                        class="w-full rounded-xl border border-outline-variant
                            bg-surface-container-low
                            px-5 py-4
                            text-on-surface
                            placeholder:text-outline
                            resize-y
                            focus:border-primary
                            focus:ring-2
                            focus:ring-primary/20
                            outline-none
                            transition"
                    >{{ old('cover_letter') }}</textarea>

                    <div class="mt-2 flex justify-between text-sm text-outline">

                        <span>
                            Tell the employer why you're interested in this role.
                        </span>

                        <span id="letterCount">
                            0 Characters
                        </span>

                    </div>

                    @error('cover_letter')

                        <p class="mt-2 text-sm text-red-400">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Submit --}}

                <div class="mt-12">

                    <button
                        class="btn-primary w-full rounded-lg py-4 text-xl font-semibold">

                        Submit Application →

                    </button>

                    <p class="mt-5 text-center text-sm text-outline">

                        By submitting, you agree to our

                        <a href="#"
                           class="text-on-surface hover:text-primary">

                            Candidate Privacy Policy

                        </a>

                    </p>

                </div>

            </form>

        </div>

    </div>

</section>


{{-- Upload Preview --}}

<script>

const fileInput=document.getElementById('resume');
const selected=document.getElementById('selectedFile');
const fileName=document.getElementById('fileName');
const remove=document.getElementById('removeFile');
const dropZone=document.getElementById('dropZone');

fileInput.addEventListener('change',()=>{

    if(fileInput.files.length){

        fileName.innerHTML=fileInput.files[0].name;

        selected.classList.remove('hidden');

        dropZone.classList.add('hidden');

    }

});

remove.addEventListener('click',()=>{

    fileInput.value='';

    selected.classList.add('hidden');

    dropZone.classList.remove('hidden');

});

dropZone.addEventListener('dragover',(e)=>{

    e.preventDefault();

    dropZone.classList.add('border-primary');

});

dropZone.addEventListener('dragleave',()=>{

    dropZone.classList.remove('border-primary');

});

dropZone.addEventListener('drop',(e)=>{

    e.preventDefault();

    dropZone.classList.remove('border-primary');

    fileInput.files=e.dataTransfer.files;

    fileName.innerHTML=e.dataTransfer.files[0].name;

    selected.classList.remove('hidden');

    dropZone.classList.add('hidden');
});

const coverLetter = document.querySelector('textarea[name="cover_letter"]');
const letterCount = document.getElementById('letterCount');

if (coverLetter) {

    const updateCount = () => {
        letterCount.textContent = `${coverLetter.value.length} Characters`;
    };

    updateCount();

    coverLetter.addEventListener('input', updateCount);

}

</script>

@endsection