<div class="p-6 bg-gray-50 rounded-lg shadow-lg">
    <!-- Courses Table -->
    <div class="overflow-x-auto mb-6">
        <table class="w-full bg-white rounded-lg shadow-md overflow-hidden">
            <thead>
                <tr class="border-b bg-gray-50">
                    <th colspan="2" class="px-6 py-4 text-xl font-semibold text-gray-800 text-left">
                        {{ $record->university->name }}
                    </th>
                </tr>
                <tr class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wider">
                    <th class="px-6 py-3 text-left font-semibold">Course Name</th>
                    <th class="px-6 py-3 text-left font-semibold">Annual Fee</th>
                    <th class="px-6 py-3 text-left font-semibold">Duration</th>
                    <th class="px-6 py-3 text-left font-semibold">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($record->courses as $course)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 border-b text-gray-700">{{ $course->name }}</td>
                        <td class="px-6 py-4 border-b text-gray-700">{{ $course->annual_fee }}</td>
                        <td class="px-6 py-4 border-b text-gray-700">{{ $course->duration }}%</td>
                        <td class="px-6 py-4 border-b text-gray-700">
                            <a 
                                href="{{ route('filament.admin.resources.add-courses.edit', ['record' => $course->id]) }}" 
                                class="text-blue-600 hover:underline"
                            >
                                edit
                            </a>
                        </td>
                        
                        
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
