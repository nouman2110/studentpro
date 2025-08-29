<div class="min-h-screen" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">

    <!-- 🌌 Animated Background -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse delay-2000"></div>
        <div class="absolute top-40 left-1/2 w-80 h-80 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse delay-4000"></div>
    </div>

    <!-- Page Content -->
    <div class="relative z-10 min-h-screen py-10 px-4 sm:px-6 lg:px-12">
        <div class="max-w-6xl mx-auto space-y-10">
            <!-- 🔙 Back Button -->
            <div class="animate-fade-in">
                <a href="{{ route('filament.admin.pages.course') }}"
                   class="group inline-flex items-center gap-3 px-6 py-3 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white hover:bg-white/20 hover:scale-105 transition-all duration-300 shadow-md hover:shadow-xl">
                    <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span>Back to Course List</span>
                </a>
            </div>

            <!-- 🌐 Tab Container -->
            <div class="animate-slide-up bg-white/5 backdrop-blur-xl rounded-3xl border border-white/20 shadow-2xl overflow-hidden">
                <!-- Tabs -->
                <div class="border-b border-white/20 bg-white/10 px-6 py-4">
                    <nav class="flex flex-wrap justify-center gap-3">
                        @foreach([
                            'course' => ['label' => 'Course Details', 'icon' => '📘'],
                            'location' => ['label' => 'Location', 'icon' => '📍'],
                            'institute' => ['label' => 'Institute', 'icon' => '🏛️'],
                            'contact' => ['label' => 'Contact', 'icon' => '📞'],
                        ] as $key => $tab)
                            <button wire:click="$set('activeTab', '{{ $key }}')"
                                    class="px-5 py-2.5 rounded-full border text-sm font-medium flex items-center gap-2 transition-all duration-300
                                    {{ $activeTab === $key
                                        ? 'bg-gradient-to-tr from-blue-600/30 to-purple-600/30 text-white border-white/30 shadow-lg scale-105'
                                        : 'bg-white/10 text-white/70 border-white/20 hover:bg-white/20 hover:text-white hover:scale-105'
                                    }}">
                                <span>{{ $tab['icon'] }}</span>
                                <span>{{ $tab['label'] }}</span>
                            </button>
                        @endforeach
                    </nav>
                </div>

                <!-- Tab Content -->
                <div class="p-6">
                    @if($activeTab === 'course')
                        <div class="space-y-6">
                            <!-- Course Header -->
                            <div class="bg-white/10 rounded-xl p-6 shadow border border-white/20">
                                <h2 class="text-2xl font-bold text-white mb-2">{{ $course->name }}</h2>
                                <div class="flex flex-wrap gap-2">
                                    @if($course->cricos_course_code)
                                        <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-800 font-semibold">CRICOS: {{ $course->cricos_course_code }}</span>
                                    @endif
                                    @if($course->vet_national_code)
                                        <span class="px-3 py-1 text-xs rounded-full bg-indigo-100 text-indigo-800 font-semibold">VET Code: {{ $course->vet_national_code }}</span>
                                    @endif
                                    @if($course->dual_qualification === 'Yes' || $course->dual_qualification === 1)
                                        <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-800 font-semibold">✓ Dual Qualification</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Course Info -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- General Info -->
                                <div class="space-y-3">
                                    <h4 class="text-lg font-semibold text-white">General Information</h4>
                                    @foreach([
                                        'Course Sector' => $course->sector,
                                        'Course Level' => $course->course_level,
                                        'Language' => $course->language,
                                        'Duration (Weeks)' => $course->duration_weeks,
                                    ] as $label => $value)
                                        <div class="flex justify-between text-sm border-b border-white/10 pb-1">
                                            <span class="text-white/60">{{ $label }}</span>
                                            <span class="text-white font-medium">{{ $value ?: 'N/A' }}</span>
                                        </div>
                                    @endforeach
                                    @foreach([
                                        'Foundation Studies' => $course->foundation_study,
                                        'Work Component' => $course->work_component,
                                    ] as $label => $value)
                                        <div class="flex justify-between text-sm border-b border-white/10 pb-1">
                                            <span class="text-white/60">{{ $label }}</span>
                                            <span class="text-white font-medium">
                                                {{ $value ? '✓ Yes' : '✗ No' }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Field + Fees -->
                                <div class="space-y-3">
                                    <h4 class="text-lg font-semibold text-white">Field of Education</h4>
                                    @foreach([
                                        'Broad Field' => $course->broad_field,
                                        'Narrow Field' => $course->narrow_field,
                                        'Detailed Field' => $course->detailed_field,
                                    ] as $label => $value)
                                        <div class="flex justify-between text-sm border-b border-white/10 pb-1">
                                            <span class="text-white/60">{{ $label }}</span>
                                            <span class="text-white font-medium">{{ $value ?: 'N/A' }}</span>
                                        </div>
                                    @endforeach

                                    <h4 class="text-lg font-semibold text-white mt-4">Fees</h4>
                                    @foreach([
                                        'Tuition Fee' => $course->tuition_fee ? '$AU ' . number_format($course->tuition_fee) : 'N/A',
                                        'Non Tuition Fee' => $course->non_tuition_fee ? '$AU ' . number_format($course->non_tuition_fee) : 'N/A',
                                    ] as $label => $value)
                                        <div class="flex justify-between text-sm border-b border-white/10 pb-1">
                                            <span class="text-white/60">{{ $label }}</span>
                                            <span class="text-white font-medium">{{ $value }}</span>
                                        </div>
                                    @endforeach
                                    <div class="flex justify-between text-base font-semibold pt-2">
                                        <span class="text-white">Total Estimated Cost</span>
                                        <span class="text-blue-300">
                                            {{ $course->estimated_total_cost ? '$AU ' . number_format($course->estimated_total_cost) : '$AU ' . number_format(($course->tuition_fee ?? 0) + ($course->non_tuition_fee ?? 0)) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @elseif($activeTab === 'location')
                        <div class="text-center py-10 space-y-4">
                            <div class="text-5xl">📍</div>
                            <h3 class="text-xl font-semibold text-white">Course Location</h3>
                            <p class="text-base text-white/90 bg-white/10 px-6 py-4 inline-block rounded-xl border border-white/10">
                                {{ $course->course_location }}
                            </p>
                        </div>

                    @elseif($activeTab === 'institute')
                        <div class="space-y-6">
                            <div class="text-center">
                                <div class="text-4xl mb-2">🏛️</div>
                                <h3 class="text-2xl font-bold text-white">{{ $course->institution_name ?: 'Institution Details' }}</h3>
                                <p class="text-white/60">{{ $course->institution_type }}</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <h4 class="text-lg font-semibold text-white">Institution Info</h4>
                                    @foreach([
                                        'CRICOS Provider Code' => $course->provider_cricos_code,
                                        'Institution Trading Name' => $course->institution_trading_name,
                                        'Institution Name' => $course->institution_name,
                                        'Institution Type' => $course->institution_type,
                                        'Total Capacity' => $course->institution_total_capacity,
                                    ] as $label => $value)
                                        <div class="flex justify-between text-sm border-b border-white/10 pb-1">
                                            <span class="text-white/60">{{ $label }}</span>
                                            <span class="text-white">{{ $value ?: 'N/A' }}</span>
                                        </div>
                                    @endforeach
                                    @if($course->institution_website)
                                        <div class="pt-3">
                                            <a href="{{ $course->institution_website }}" class="text-blue-400 hover:underline text-sm" target="_blank">
                                                🌐 Visit Website ↗
                                            </a>
                                        </div>
                                    @endif
                                </div>

                                <div>
                                    <h4 class="text-lg font-semibold text-white mb-2">Postal Address</h4>
                                    <div class="bg-white/10 rounded-xl p-4 border border-white/10 shadow-sm text-sm text-white">
                                        {{ $course->institution_postal_address ?: 'N/A' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                    @elseif($activeTab === 'contact')
                        <div class="space-y-6 text-center">
                            <div class="text-4xl">📞</div>
                            <h3 class="text-2xl font-bold text-white">Contact Information</h3>

                            <div class="max-w-md mx-auto space-y-4">
                                @if($course->head_title || $course->head_name)
                                    <div class="bg-white/10 border border-white/20 shadow rounded-xl p-4">
                                        <h4 class="text-lg font-semibold text-white">
                                            {{ collect([$course->head_title, $course->head_name])->filter()->implode(' ') }}
                                        </h4>
                                    </div>
                                @endif

                                @foreach([
                                    'Phone' => ['value' => $course->head_phone, 'icon' => '📞', 'link' => 'tel:'],
                                    'Email' => ['value' => $course->head_email, 'icon' => '✉️', 'link' => 'mailto:'],
                                    'Fax' => ['value' => $course->head_fax, 'icon' => '📠', 'link' => null],
                                ] as $label => $data)
                                    @if($data['value'])
                                        <div class="flex items-center gap-4 bg-white/10 rounded-xl p-4 border border-white/20 shadow-sm">
                                            <span class="text-xl">{{ $data['icon'] }}</span>
                                            <div class="text-left text-sm">
                                                <div class="text-white/60 text-xs uppercase">{{ $label }}</div>
                                                @if($data['link'])
                                                    <a href="{{ $data['link'] . $data['value'] }}" class="text-white hover:underline font-medium">
                                                        {{ $data['value'] }}
                                                    </a>
                                                @else
                                                    <span class="text-white font-medium">{{ $data['value'] }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-out',
                        'slide-up': 'slideUp 0.5s ease-out',
                        'scale-in': 'scaleIn 0.3s ease-out',
                        'gradient': 'gradient 15s ease infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        scaleIn: {
                            '0%': { opacity: '0', transform: 'scale(0.95)' },
                            '100%': { opacity: '1', transform: 'scale(1)' }
                        },
                        gradient: {
                            '0%, 100%': { backgroundPosition: '0% 50%' },
                            '50%': { backgroundPosition: '100% 50%' }
                        }
                    },
                    backdropBlur: {
                        'xs': '2px',
                    }
                }
            }
        }
    </script>

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
</div>
