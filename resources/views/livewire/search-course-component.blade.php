<div class="px-6 pb-6">
    <div class="">
        <div class="bg-white rounded-lg p-3">
            <div class="grid grid-cols-4 gap-3">
                <div class="">
                    <label for="state"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select State:</label>
                        <select id="state" wire:model.live='state'
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Select State</option>
                                @foreach ($states as $state)
                                <option value="{{ $state['state_id'] }}">
                                    {{ $state['state_name'] }} 
                                </option>
                            @endforeach
                        </select>
                </div>
                <div class="">
                    <label for="school" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select University</label>
                    <select id="school" wire:model.live='school'
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Select University</option>
                    @foreach ($schools as $school)
                        <option value="{{ $school->id }}">
                            {{ optional($school->university)->name ?? 'N/A' }}  
                        </option>
                    @endforeach
                </select>
                @error('school')
                <span class="text-red-600 text-xs"> {{ $message }}</span>
                @enderror
                
                </div>
                <div class="col-span-1">
                    <label for="category"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Category:</label>
                    <select id="category" wire:model.live="category"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <span class="text-red-600 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                
                
                <div class="">
                    <label for="studyLevel"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Study Level</label>
                    <select id="studyLevel" wire:model.live='studyLevel'
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Select Study Level</option>
                        @foreach ($studyLevels as $studyLevel)
                            <option value="{{ $studyLevel->id }}">{{ $studyLevel->name }}</option>
                        @endforeach
                    </select>
                    @error('studyLevel')
                    <span class="text-red-600 text-xs"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="">
                    <label for="school/Class"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                        course Name :</label>
                        <select id="courseName" wire:model.live='courseName'
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Select Course Name</option>
                    @foreach ($courseNames as $courseName)
                        <option value="{{ $courseName }}">{{ $courseName }}</option>
                    @endforeach
                    </select>
                    @error('courseName')
                    <span class="text-red-600 text-xs"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-1">
                    <label for="searchCourseName"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Search:</label>
                    <input id="searchCourseName" wire:model.live="searchCourseName"
                        type="text" placeholder="Search course or university name ..."
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @error('searchCourseName')
                        <span class="text-red-600 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                
            </div>

          
            <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($courses as $course)
                    <div class="group relative overflow-hidden bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100">
                        <div class="bg-gradient-to-r from-[#55b4a0] to-[#55b4a0] px-4 py-3 text-sm font-bold text-white">
                            {{ $course->studyLevel->name ?? 'N/A' }}
                        </div>
                        <div class="p-6">
                            <div class="text-xl font-bold text-gray-800 hover:text-[#55b4a0] transition-colors duration-200">
                                <a href="{{ route('filament.admin.pages.course-detail', ['record' => $course->id]) }}" class="hover:underline">
                                    {{ $course->name }}
                                </a>
                            </div>
                            <div class="text-sm text-gray-500 mt-1">{{ $course->school->university->name ?? 'N/A' }}</div>
                            <div class="flex flex-wrap gap-x-4 gap-y-2 mt-4 text-sm text-gray-700">
                                <div class="flex items-center space-x-1">
                                    <span class="material-icons-outlined text-[#55b4a0] text-base">school</span>
                                    <span><span class="font-medium">Level:</span> {{ $course->studyLevel->name ?? 'N/A' }}</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <span class="material-icons-outlined text-[#55b4a0] text-base">place</span>
                                    <span><span class="font-medium">Location:</span> {{ $course->school->university->location ?? 'N/A' }}</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <span class="material-icons-outlined text-[#55b4a0] text-base">attach_money</span>
                                    <span><span class="font-medium">Annual Fee:</span> {{ $course->annual_fee }}</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <span class="material-icons-outlined text-[#55b4a0] text-base">event</span>
                                    <span><span class="font-medium">Intakes:</span> {{ $course->start_date ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="absolute inset-0 bg-[#55b4a0] opacity-0 group-hover:opacity-10 transition-opacity duration-300 pointer-events-none"></div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500 py-6">No courses found.</div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $courses->links() }}
        </div>
    </div>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</div>
