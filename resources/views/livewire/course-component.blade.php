<div class="min-h-screen" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="min-h-screen py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto space-y-8">
            
            <!-- Header Section -->
            <div class="text-center space-y-4" style="animation: fadeIn 0.6s ease-out;">
                <h1 class="text-4xl md:text-5xl font-bold text-white tracking-tight">
                    Discover Your Perfect
                    <span style="background: linear-gradient(to right, #fbbf24, #f97316); background-clip: text; -webkit-background-clip: text; color: transparent;">
                        Course
                    </span>
                </h1>
                <p class="text-xl text-white opacity-80 max-w-2xl mx-auto">
                    Explore thousands of courses from top providers and find the one that matches your career goals
                </p>
            </div>

            <!-- Search Bar -->
            <div class="max-w-2xl mx-auto" style="animation: fadeIn 0.6s ease-out;">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" 
                           wire:model.live="search"
                           placeholder="Search by course name..."
                           class="w-full pl-12 pr-4 py-4 rounded-2xl border-0 text-gray-700 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:outline-none text-lg shadow-lg"
                           style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px);">
                </div>
            </div>

            <!-- Filters Section -->
            <div class="rounded-3xl p-6 shadow-2xl" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.3); animation: fadeIn 0.6s ease-out;">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                        </svg>
                        Filter Options
                    </h2>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    <select wire:model.live="state" class="rounded-xl px-4 py-3 text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm" style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border: 1px solid rgba(229, 231, 235, 0.5);">
                        <option value="">All States</option>
                        @foreach($filters['states'] as $state)
                            <option value="{{ $state }}">{{ $state }}</option>
                        @endforeach
                    </select>

                    <select wire:model.live="study_level" class="rounded-xl px-4 py-3 text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm" style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border: 1px solid rgba(229, 231, 235, 0.5);">
                        <option value="">All Study Levels</option>
                        @foreach($filters['study_levels'] as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>

                    <select wire:model.live="sector" class="rounded-xl px-4 py-3 text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm" style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border: 1px solid rgba(229, 231, 235, 0.5);">
                        <option value="">All Sectors</option>
                        @foreach($filters['sectors'] as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>

                    <select wire:model.live="broad_field" class="rounded-xl px-4 py-3 text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm" style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border: 1px solid rgba(229, 231, 235, 0.5);">
                        <option value="">All Broad Fields</option>
                        @foreach($filters['broad_fields'] as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>

                    <select wire:model.live="narrow_field" class="rounded-xl px-4 py-3 text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm" style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border: 1px solid rgba(229, 231, 235, 0.5);">
                        <option value="">All Narrow Fields</option>
                        @foreach($filters['narrow_fields'] as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>

                    <select wire:model.live="detailed_field" class="rounded-xl px-4 py-3 text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm" style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border: 1px solid rgba(229, 231, 235, 0.5);">
                        <option value="">All Detailed Fields</option>
                        @foreach($filters['detailed_fields'] as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>

                    <select wire:model.live="language" class="rounded-xl px-4 py-3 text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm" style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border: 1px solid rgba(229, 231, 235, 0.5);">
                        <option value="">All Languages</option>
                        @foreach($filters['languages'] as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>

                    <select wire:model.live="course_level" class="rounded-xl px-4 py-3 text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm" style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border: 1px solid rgba(229, 231, 235, 0.5);">
                        <option value="">All Course Levels</option>
                        @foreach($filters['course_levels'] as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            <!-- Results Summary -->
            <div class="flex justify-between items-center" style="animation: fadeIn 0.6s ease-out;">
                <div class="text-white">
                    <span class="text-2xl font-bold">{{ $courses->total() ?? count($courses) }}</span>
                    <span class="text-white opacity-80 ml-2">courses found</span>
                </div>
            </div>

            <!-- Courses Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" style="animation: fadeIn 0.6s ease-out;">
                @forelse ($courses as $course)
                    <div class="rounded-2xl p-6 shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300 hover:-translate-y-1" style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px);">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-2">
                                    @if($course->study_level)
                                        <span class="px-3 py-1 text-xs font-medium rounded-full
                                            @switch($course->study_level)
                                                @case('Certificate I')
                                                @case('Certificate II')
                                                @case('Certificate III')
                                                    bg-yellow-100 text-yellow-700
                                                    @break
                                                @case('Certificate IV')
                                                    bg-blue-100 text-blue-700
                                                    @break
                                                @case('Diploma')
                                                @case('Advanced Diploma')
                                                    bg-purple-100 text-purple-700
                                                    @break
                                                @case('Bachelor')
                                                    bg-red-100 text-red-700
                                                    @break
                                                @case('Master')
                                                @case('Masters')
                                                    bg-teal-100 text-teal-700
                                                    @break
                                                @default
                                                    bg-gray-100 text-gray-700
                                            @endswitch
                                        ">
                                            {{ $course->study_level }}
                                        </span>
                                    @endif
                                    @if($course->duration)
                                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">
                                            {{ $course->duration }} weeks
                                        </span>
                                    @endif
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">
                                    <a href="{{ route('filament.admin.pages.course-info', ['record' => $course->id]) }}" class="hover:text-blue-600 transition-colors">
                                        {{ $course->name }}
                                    </a>
                                </h3>
                                @if($course->sector || $course->broad_field)
                                    <p class="text-gray-600 text-sm mb-3">
                                        {{ $course->sector ?? $course->broad_field }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-xs font-bold"
                                     style="background: linear-gradient(135deg, #{{ substr(md5($course->provider_name), 0, 6) }}, #{{ substr(md5($course->provider_name), 6, 6) }});">
                                    {{ strtoupper(substr($course->provider_name, 0, 2)) }}
                                </div>
                                <span class="text-sm text-gray-600">{{ $course->provider_name }}</span>
                            </div>
                            <a href="{{ route('filament.admin.pages.course-info', ['record' => $course->id]) }}" 
                               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                View Details
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <div class="rounded-2xl p-8 shadow-lg" style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px);">
                            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.47.58-6.305 1.613"/>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No courses found</h3>
                            <p class="text-gray-500">Try adjusting your filters or search terms.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if(method_exists($courses, 'links'))
                <div class="flex justify-center" style="animation: fadeIn 0.6s ease-out;">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-2">
                        {{ $courses->links() }}
                    </div>
                </div>
            @endif

        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Custom pagination styles */
        .pagination {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .pagination a,
        .pagination span {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            text-decoration: none;
            transition: all 0.2s;
        }
        
        .pagination a {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }
        
        .pagination a:hover {
            background: rgba(255, 255, 255, 0.3);
        }
        
        .pagination .active span {
            background: #2563eb;
            color: white;
        }
        
        .pagination .disabled span {
            background: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.5);
        }
    </style>

   <script src="https://cdn.tailwindcss.com"></script>
</div>