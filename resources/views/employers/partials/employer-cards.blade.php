@forelse($employers as $employer)
    @include('employers.partials.employer-card', ['employer' => $employer])
@empty
    <p class="col-span-full text-center text-on-surface-variant font-body-md text-body-md py-12">
        No employers found.
    </p>
@endforelse
 