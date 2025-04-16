<div>
    @if (count($schools) > 0)
        <h3 class="font-semibold text-gray-700">Schools in Selected State</h3>
        <ul class="list-disc ml-5">
            @foreach ($schools as $school)
                <li class="text-gray-600">School ID: {{ $school->id }}</li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-600">Select a state to view related schools.</p>
    @endif
</div>
