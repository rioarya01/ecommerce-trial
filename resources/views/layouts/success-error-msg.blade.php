{{-- success and error messages --}}
@if (session('success'))
<div class="bg-white rounded-lg shadow p-4 mb-6 border border-green-200">
    <div class="flex items-center gap-2 text-green-600">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="font-medium text-sm">{{ __('Success') }}</span>
    </div>
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('success') }}
    </div>
</div>
@endif
@if ($errors->any())
<div class="bg-white rounded-lg shadow p-4 mb-6 border border-red-200">
    <div class="flex items-center gap-2 text-red-600">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.008v-.008H12v.008zM12 18h.008v-.008H12V18z" />
        </svg>
        <span class="font-medium text-sm">{{ __('Error') }}</span>
    </div>
    <div class="mb-4 font-medium text-sm text-red-600">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
</div>
@endif