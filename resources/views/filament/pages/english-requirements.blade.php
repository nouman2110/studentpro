<div class="p-6 bg-gray-50 rounded-lg shadow-lg">
    <!-- English Requirements Table -->
    <div class="overflow-x-auto">
        <table class="w-full bg-white rounded-lg shadow-md overflow-hidden">
            <thead>
                <tr class="border-b bg-gray-50">
                    <th colspan="3" class="px-6 py-4 text-xl font-semibold text-gray-800 text-left">
                        English Requirements for {{ optional($record->university)->name ?? 'N/A' }}
                    </th>
                </tr>
                <tr class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wider">
                    <th class="px-6 py-3 text-left font-semibold">Study Level</th>
                    <th class="px-6 py-3 text-left font-semibold">Test Name</th>
                    <th class="px-6 py-3 text-left font-semibold">Minimum Score</th>
                    <th class="px-6 py-3 text-left font-semibold">Validity Period (Years)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($record->englishRequirements as $requirement)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 border-b text-gray-700">{{ $requirement->studyLevel->name ?? null }}</td>
                        <td class="px-6 py-4 border-b text-gray-700">{{ $requirement->test_name }}</td>
                        <td class="px-6 py-4 border-b text-gray-700">{{ $requirement->minimum_score }}</td>
                        <td class="px-6 py-4 border-b text-gray-700">{{ $requirement->validity_period }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">No English requirements available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
