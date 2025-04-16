<div class="p-6 bg-gray-50 rounded-lg shadow-lg">
    <!-- Courses Table -->
    <div class="overflow-x-auto mb-6">
        <table class="w-full bg-white rounded-lg shadow-md overflow-hidden">
            <thead>
                <tr class="border-b bg-gray-50">
                    <th colspan="2" class="px-6 py-4 text-xl font-semibold text-gray-800 text-left">
                        Study Level and Commissions for {{ optional($record->university)->name ?? 'N/A' }}
                    </th>
                </tr>
                <tr class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wider">
                    <th class="px-6 py-3 text-left font-semibold">Study Level</th>
                    <th class="px-6 py-3 text-left font-semibold">Scholarship</th>
                    <th class="px-6 py-3 text-left font-semibold">Commission (%)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($record->commissions as $commission)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 border-b text-gray-700">{{ $commission->studyLevel->name }}</td>
                        <td class="px-6 py-4 border-b text-gray-700">{{ $commission->scholarship_amount }}</td>
                        <td class="px-6 py-4 border-b text-gray-700">{{ $commission->commission_percent }}%</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-6 py-4 text-center text-gray-500">No study lavel available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
