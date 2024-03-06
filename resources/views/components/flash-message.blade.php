@if (session()->has('success_message'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" class=" w-full bg-green-500 text-white px-24 py-4">
        <p>
            {{ session('success_message') }}
        </p>
    </div>
@endif

@if (session()->has('error_message'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" class=" w-full bg-red-500 text-white px-48 py-4">
        <p>
            {{ session('error_message') }}
        </p>
    </div>
@endif
