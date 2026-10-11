<aside class="h-fit sticky top-24">

    <div class="application-sidebar rounded-xl border border-[var(--color-outline-variant)] p-6 space-y-8">

        {{-- ===================== --}}
        {{-- ACTIONS --}}
        {{-- ===================== --}}

        <section>

            <h3 class="uppercase tracking-wider text-sm font-semibold text-[var(--color-on-surface-variant)] mb-5">
                Application Actions
            </h3>

            <div class="gap-4 grid-cols-1 sm:grid-cols-2 grid xl:grid-cols-1 min-[1280px]:grid-cols-1 ">

                <div>
                    <button type="button"
                            onclick="openActionModal('accept')"
                            class="btn-primary w-full py-3 rounded-lg flex justify-center items-center gap-2">
                        <span class="material-symbols-outlined">person_check</span>
                        Accept
                    </button>
                </div>

                <div>
                    <button type="button"
                            onclick="openActionModal('interview')"
                            class="btn-secondary w-full py-3 rounded-lg flex justify-center items-center gap-2">
                        <span class="material-symbols-outlined">calendar_month</span>
                        Book Interview
                    </button>
                </div>

                <div>
                    <a href="/redirect-to-gmail/{{ $application->candidate->email }}" 
                            class="btn-secondary w-full py-3 rounded-lg flex justify-center items-center gap-2">
                       <span class="material-symbols-outlined">
                            mail
                            </span>
                        Email Candidate
                    </a>
                </div>

                <div>
                    <button type="button"
                            onclick="openActionModal('reject')"
                            class="w-full py-3 note-card border-red-500/30 text-red-300 hover:bg-red-500/10 transition flex justify-center items-center gap-2">
                        <span class="material-symbols-outlined">close</span>
                        Reject
                    </button>
                </div>

            </div>

        </section>

    </div>

</aside>

{{-- ===================== --}}
{{-- SHARED ACTION MODAL --}}
{{-- ===================== --}}

<div id="actionModalOverlay"
     class="hidden fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">

    <div class="bg-[var(--color-surface)] border border-[var(--color-outline-variant)] rounded-xl w-full max-w-md p-6 space-y-4 shadow-xl">

        <div class="flex items-start justify-between">
            <h3 id="actionModalTitle" class="text-lg font-semibold text-[var(--color-on-surface)]"></h3>
            <button type="button" onclick="closeActionModal()"
                    class="text-[var(--color-on-surface-variant)] hover:text-[var(--color-on-surface)]">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <p id="actionModalDescription" class="text-sm text-[var(--color-on-surface-variant)]"></p>

        <form id="actionModalForm" method="POST" action="{{ route('applications.instructions', ['application' => $application->id])  }}">
            @csrf

            <input type="hidden" id="action" name="action" value="" >

             {{-- Interview-only date/time picker --}}
            <div id="actionModalDateWrapper" class="hidden mb-4">
                <label for="actionModalDate"
                       class="block text-sm font-medium text-[var(--color-on-surface-variant)] mb-1">
                    Interview Date & Time
                </label>
                <input type="datetime-local"
                       id="actionModalDate"
                       name="interview_at"
                       class="w-full rounded-lg border border-[var(--color-outline-variant)] bg-transparent p-3 text-sm focus:ring-inset focus:ring-2 focus:outline-none">
            </div>

            <textarea id="actionModalInput"
                      name="instructions"
                      rows="4"
                      required
                      class="w-full rounded-lg border border-[var(--color-outline-variant)] bg-transparent p-3 text-sm focus:ring-inset focus:ring-2 focus:outline-none"
                      placeholder=""></textarea>
    

            <div class="flex justify-end gap-3 mt-4">
                <button type="button" onclick="closeActionModal()"
                        class="btn-secondary px-4 py-2 rounded-lg text-sm">
                    Cancel
                </button>
                <button type="submit" id="actionModalSubmit"
                        class="btn-primary px-4 py-2 rounded-lg text-sm">
                    Confirm
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    // Configure each mode: title, description, placeholder, submit label, form action, http method
    const actionModalConfig = {
        accept: {
            title: 'Accept Application',
            description: 'Add any onboarding instructions or next steps for the candidate.',
            placeholder: 'e.g. Please complete the attached onboarding form and confirm your start date...',
            submitLabel: 'Accept',
            value: 'accepted',
            showDate: false,

        },
        interview: {
            title: 'Book Interview',
            description: 'Let the candidate know when and where the interview will take place.',
            placeholder: 'e.g. Interview scheduled for Monday, 10 AM at our office / Google Meet link...',
            submitLabel: 'Schedule',
            value: 'interview',
            showDate: true,

        },

        reject: {
            title: 'Reject Application',
            description: 'Let the candidate know why their application was not successful.',
            placeholder: 'e.g. Thank you for applying. Unfortunately...',
            submitLabel: 'Reject',
            value: 'rejected',
            showDate: false,
        }
    };

    // Set this from Blade to the current application's ID
    const currentApplicationId = {{ $application->id ?? 'null' }};

    function openActionModal(mode) {
        const config = actionModalConfig[mode];
        if (!config) return;

        document.getElementById('actionModalTitle').textContent = config.title;
        document.getElementById('actionModalDescription').textContent = config.description;
        document.getElementById('actionModalInput').placeholder = config.placeholder;
        document.getElementById('actionModalInput').value = '';
        document.getElementById('actionModalSubmit').textContent = config.submitLabel;
        document.getElementById('actionModalOverlay').classList.remove('hidden');
        document.getElementById('action').value = config.value;

        const dateWrapper = document.getElementById('actionModalDateWrapper');
        const dateInput = document.getElementById('actionModalDate');

        if (config.showDate) {
            dateWrapper.classList.remove('hidden');
            dateInput.required = true;
            dateInput.value = '';
            dateInput.min = new Date().toISOString().slice(0, 16); // prevent picking a past date/time
        } else {
            dateWrapper.classList.add('hidden');
            dateInput.required = false;
            dateInput.value = '';
        }

        document.getElementById('actionModalOverlay').classList.remove('hidden');
    }

    function closeActionModal() {
        document.getElementById('actionModalOverlay').classList.add('hidden');
    }

    // Close on backdrop click
    document.getElementById('actionModalOverlay').addEventListener('click', (e) => {
        if (e.target.id === 'actionModalOverlay') closeActionModal();
    });

    // Close on Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeActionModal();
    });
</script>