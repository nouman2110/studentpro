<x-filament-panels::page> 
    <div class="flex justify-between items-center">
        <!-- Back to Course Search Button -->
        <a href="{{ route('filament.admin.pages.search-course') }}" 
            class="inline-block px-4 py-2 text-blue-600 border border-blue-600 rounded-md hover:bg-blue-600 hover:text-white font-semibold transition-all duration-300">
            ⬅ Back to Course Search
        </a>
        
        <!-- Edit Course Button (only visible if the course exists) -->
        @if ($course)
        <a href="{{ route('filament.admin.resources.add-courses.edit', ['record' => $course->id]) }}"
            class="inline-block px-4 py-2 text-blue-600 border border-blue-600 rounded-md hover:bg-blue-600 hover:text-white font-semibold transition-all duration-300">
            Edit Course
        </a>        
        @endif
    </div>
    
        
    <div class="p-6 bg-white shadow-lg rounded-lg ">
        @if ($course)
            <h1 class="text-2xl font-bold text-gray-900">{{ $course->name }}</h1>
            <h2 class="text-lg text-gray-700 font-semibold mt-1">At {{ $course->school->university->name ?? 'N/A' }}</h2>

            <div class="mt-4 border rounded-lg overflow-hidden shadow-md">
                <table class="w-full border-collapse bg-gray-100">
                    <tbody>
                        <tr class="border-b">
                            <td class="p-3 font-semibold bg-gray-200">QS World University Rankings 2025</td>
                            <td class="p-3 text-center text-xl font-bold">
                                {{ $course->school->university->qs_ranking ?? 'N/A' }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="p-3 font-semibold bg-gray-200">Level:</td>
                            <td class="p-3">{{ $course->studyLevel->name ?? 'N/A' }}</td>
                        </tr>
                        <tr class="border-b">
                            <td class="p-3 font-semibold bg-gray-200">Location:</td>
                            <td class="p-3"> {{ $course->school->university->location ?? 'N/A' }}</td>
                        </tr>
                        <tr class="border-b">
                            <td class="p-3 font-semibold bg-gray-200">Annual Fee:</td>
                            <td class="p-3">{{ $course->annual_fee }}</td>
                        </tr>
                        <tr class="border-b">
                            <td class="p-3 font-semibold bg-gray-200">Duration:</td>
                            <td class="p-3">{{ $course->duration }}</td>
                        </tr>
                        <tr class="border-b">
                            <td class="p-3 font-semibold bg-gray-200">Start Date:</td>
                            <td class="p-3">{{ $course->start_date }}</td>
                        </tr>
                        <tr class="border-b">
                            <td class="p-3 font-semibold bg-gray-200">Study Mode:</td>
                            <td class="p-3">{{ $course->study_mode }}</td>
                        </tr>
                        
                        {{-- Conditional tick marks (✔️) --}}
                        <tr class="border-b">
                            <td class="p-3 font-semibold bg-gray-200">Accreditation:</td>
                            <td class="p-3 text-green-600 text-xl">
                                @if($course->accreditation) ✔️ @endif
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="p-3 font-semibold bg-gray-200">Regional Area:</td>
                            <td class="p-3 text-green-600 text-xl">
                                @if($course->regional_area) ✔️ @endif
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="p-3 font-semibold bg-gray-200">Meet the Australian study requirement:</td>
                            <td class="p-3 text-green-600 text-xl">
                                @if($course->country_requirement) ✔️ @endif
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="p-3 font-semibold bg-gray-200">Meet Study in regional Australia:</td>
                            <td class="p-3 text-green-600 text-xl">
                                @if($course->regional_requirement) ✔️ @endif
                            </td>
                        </tr>
                        
                        {{-- Visa Pathway --}}
                        <tr class="border-b">
                            <td class="p-3 font-semibold bg-gray-200">Pathway to a 485 Visa:</td>
                            <td class="p-3">
                                {{ $course->pathway_to_visa ?? 'N/A' }}
                            </td>
                        </tr>
                        
                        {{-- Admission Requirements --}}
                        <tr class="border-b">
                            <td class="p-3 font-semibold bg-gray-200">Admission Requirements:</td>
                            <td class="p-3 bg-gray-50">{{ nl2br(strip_tags($course->admmision_req)) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-red-500">Course not found.</p>
        @endif
    </div>
</x-filament-panels::page>


{{-- other design --}}

{{-- <x-filament-panels::page>
    <div class="container mx-auto p-6">
        <div class="mb-6">
            <a href="{{ route('filament.admin.pages.search-course') }}" 
               class="text-blue-600 hover:text-blue-800 flex items-center">
                ⬅ <span class="ml-1 font-semibold">Back to Course Search</span>
            </a>
        </div>
        
        <div class="p-6 bg-white shadow-xl rounded-2xl border border-gray-200">
            @if ($course)
                <div class="text-center">
                    <h1 class="text-3xl font-bold text-gray-900">{{ $course->name }}</h1>
                    <h2 class="text-lg text-gray-600 mt-1">At <span class="font-semibold">{{ $course->school->university->name ?? 'N/A' }}</span></h2>
                </div>

                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-100 p-4 rounded-lg shadow">
                        <p class="text-gray-700 font-semibold">QS World University Rankings 2025</p>
                        <p class="text-2xl font-bold text-center mt-2">{{ $course->school->university->qs_ranking ?? 'N/A' }}</p>
                    </div>

                    <div class="bg-gray-100 p-4 rounded-lg shadow">
                        <p class="text-gray-700 font-semibold">Location</p>
                        <p class="text-lg mt-2">{{ $course->school->university->location ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-white p-4 border rounded-lg shadow-sm">
                        <p class="text-gray-700 font-semibold">Level</p>
                        <p class="mt-1">{{ $course->studyLevel->name ?? 'N/A' }}</p>
                    </div>
                    <div class="bg-white p-4 border rounded-lg shadow-sm">
                        <p class="text-gray-700 font-semibold">Annual Fee</p>
                        <p class="mt-1">{{ $course->annual_fee }}</p>
                    </div>
                    <div class="bg-white p-4 border rounded-lg shadow-sm">
                        <p class="text-gray-700 font-semibold">Duration</p>
                        <p class="mt-1">{{ $course->duration }}</p>
                    </div>
                    <div class="bg-white p-4 border rounded-lg shadow-sm">
                        <p class="text-gray-700 font-semibold">Start Date</p>
                        <p class="mt-1">{{ $course->start_date }}</p>
                    </div>
                    <div class="bg-white p-4 border rounded-lg shadow-sm">
                        <p class="text-gray-700 font-semibold">Study Mode</p>
                        <p class="mt-1">{{ $course->study_mode }}</p>
                    </div>
                </div>

                <div class="mt-6 p-4 bg-gray-50 border rounded-lg shadow-sm">
                    <h3 class="text-xl font-semibold text-gray-800">Additional Information</h3>
                    <div class="mt-2 flex flex-wrap gap-3">
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-lg text-sm font-medium">Accredited: {{ $course->accreditation ? '✔️' : '❌' }}</span>
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-lg text-sm font-medium">Regional Area: {{ $course->regional_area ? '✔️' : '❌' }}</span>
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-lg text-sm font-medium">Australian Study Requirement: {{ $course->country_requirement ? '✔️' : '❌' }}</span>
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-lg text-sm font-medium">Regional Study Requirement: {{ $course->regional_requirement ? '✔️' : '❌' }}</span>
                    </div>
                </div>

                <div class="mt-6 p-4 bg-white border rounded-lg shadow-sm">
                    <h3 class="text-xl font-semibold text-gray-800">Visa Pathway</h3>
                    <p class="mt-2">{{ $course->pathway_to_visa ?? 'N/A' }}</p>
                </div>

                <div class="mt-6 p-4 bg-white border rounded-lg shadow-sm">
                    <h3 class="text-xl font-semibold text-gray-800">Admission Requirements</h3>
                    <p class="mt-2 text-gray-700">{!! nl2br(e($course->admmision_req)) !!}</p>
                </div>
            @else
                <p class="text-red-500 text-center text-lg font-semibold">Course not found.</p>
            @endif
        </div>
    </div>
</x-filament-panels::page> --}}