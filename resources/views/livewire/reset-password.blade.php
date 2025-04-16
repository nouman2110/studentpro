<div class="flex min-h-screen">
    <div class="hidden lg:block w-1/2 h-screen">
        <img src="{{ asset('studentPro-banner.jpg') }}" alt="Illustration" class="w-full h-full object-cover">
    </div>

    <div class="w-full lg:w-1/2 flex items-center justify-center bg-white">
        <div class="w-full max-w-md p-8">
            <div class="flex justify-center mb-6">
                <img src="{{ asset('student-logo.png') }}" alt="Logo" class="h-20">
            </div>

            <h2 class="text-2xl font-bold text-center mb-4">Reset Password</h2>

            @if (session()->has('success'))
                <div class="text-green-600 text-center mb-3">{{ session('success') }}</div>
            @endif

            @if (session()->has('error'))
                <div class="text-red-600 text-center mb-3">{{ session('error') }}</div>
            @endif

            <form wire:submit.prevent="resetPassword">
                <input type="hidden" wire:model="token">
            
                <div class="mb-4">
                    <label for="email" class="block font-medium">Your Email</label>
                    <input type="email" id="email" wire:model="email"
                        class="w-full border p-2 rounded bg-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500">
                    @error('email') 
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            
                <div class="mb-4">
                    <label for="password" class="block font-medium">New Password</label>
                    <input type="password" id="password" wire:model="password"
                        class="w-full border p-2 rounded bg-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500">
                    @error('password') 
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            
                <div class="mb-4">
                    <label for="password_confirmation" class="block font-medium">Confirm Password</label>
                    <input type="password" id="password_confirmation" wire:model="password_confirmation"
                        class="w-full border p-2 rounded bg-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500">
                    @error('password_confirmation') 
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            
                <button type="submit"
                    class="w-full bg-green-600 text-white py-2 rounded flex justify-center items-center hover:bg-green-700 space-x-2"
                    wire:loading.attr="disabled">
                    <span>Reset Password</span>
                    <span wire:loading>
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                    </span>
                </button>
            
                <div class="mt-4 flex justify-center text-sm">
                    <a href="{{ route('login') }}" class="text-green-600 hover:underline">Back to Login</a>
                </div>
            </form>
            
        </div>
    </div>
</div>

