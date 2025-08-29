<div class="max-w-4xl mx-auto p-6 space-y-4">
    <h1 class="text-2xl font-bold">{{ $course->name }}</h1>

    <div class="grid grid-cols-2 gap-4 text-sm">
        <div><strong>Provider:</strong> {{ $course->provider_name }}</div>
        <div><strong>Study Level:</strong> {{ $course->study_level }}</div>
        <div><strong>Sector:</strong> {{ $course->sector }}</div>
        <div><strong>Duration:</strong> {{ $course->duration }}</div>
        <div><strong>Location:</strong> {{ $course->course_location }}</div>
        <div><strong>Language:</strong> {{ $course->language }}</div>
        <div><strong>Tuition Fee:</strong> ${{ number_format($course->tuition_fee, 2) }}</div>
        <div><strong>Work Component:</strong> {{ $course->work_component ? 'Yes' : 'No' }}</div>
        <div><strong>Foundation Study:</strong> {{ $course->foundation_study ? 'Yes' : 'No' }}</div>
        <div><strong>Institution Website:</strong> <a href="{{ $course->institution_website }}" target="_blank" class="text-blue-600 underline">{{ $course->institution_website }}</a></div>
    </div>

    <div class="mt-6">
        <a href="{{ url()->previous() }}" class="text-blue-500 hover:underline">← Back to course list</a>
    </div>
</div>
