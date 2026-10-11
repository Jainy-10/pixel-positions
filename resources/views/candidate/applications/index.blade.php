@extends('layout.app')

@section('content')
    <div class="glass-card rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[720px] text-left border-collapse">
                        <thead>
                            <tr class="bg-surface-container-high text-on-surface-variant font-label-sm text-label-sm uppercase tracking-wide">
                                <th scope="col" class="px-6 py-4 font-medium">Candidate</th>
                                <th scope="col" class="px-6 py-4 font-medium">Role Applied</th>
                                <th scope="col" class="px-6 py-4 font-medium">Date Applied</th>
                                <th scope="col" class="px-8 py-4 font-medium ">Status</th>
                                <th scope="col" class="px-5 py-4 font-medium">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($applications as $application)
                            
                                <tr class="border-t border-surface-container-highest hover:bg-surface-container transition-colors duration-200">
                                    
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            
                                            <div class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center text-on-surface-variant font-label-sm text-label-sm overflow-hidden shrink-0">
                                                @if(false)
                                                    <img src="" alt="" class="w-full h-full object-cover">
                                                @else
                                                    {{ Str::upper(Str::substr($application->candidate->first_name, 0, 1)) }} 
                                                    {{ Str::upper(Str::substr($application->candidate->last_name, 0, 1))}}
                                                @endif
                                            </div>
                                    
                                            <div class="min-w-0">
                                                <div class="text-on-surface font-body-md truncate">{{ $application->candidate->getFullName() }}</div>
                                                <div class="text-on-surface-variant font-code-xs text-code-xs truncate">{{ $application->candidate->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-on-surface-variant whitespace-nowrap">{{ $application->job->title }}</td>
                                    <td class="px-6 py-4 text-on-surface-variant whitespace-nowrap">{{ $application->created_at }}</td>
                                    <td class="px-6 py-4 ">
                                        <span class="status-badge status-badge--{{ $application->status }}">
                                            <span class="status-badge__dot"></span>
                                            {{ $application->status }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="application/{{ $application->id }}"
                                            class="text-on-surface-variant hover:text-on-surface transition-colors duration-200"
                                            aria-label="More actions for {{ $application->name }}"
                                        >
                                            <span class="flex items-start text-sm  hover:underline pr-5">View Application</span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
@endsection