@extends('layouts.myapp')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">Change Password</h2>

    @if(session('success'))
    <div class="flex justify-center">
        <div id="success-message" class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-md text-center font-medium transition-opacity duration-500">
            {{ session('success') }}
        </div>
    </div>

    <script>
        setTimeout(() => {
            const msg = document.getElementById('success-message');
            if (msg) {
                msg.style.opacity = '0';
                setTimeout(() => msg.remove(), 500); // Remove after fade out
            }
        }, 5000); // 5 seconds
    </script>
@endif

    @if($errors->any())
        <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

   <form action="{{ route('profile.password.update') }}" method="POST">
    @csrf

    <div class="mb-4">
        <label class="block mb-1">Current Password</label>
        <input type="password" name="current_password" class="w-full border border-gray-300 rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1">New Password</label>
        <input type="password" name="new_password" class="w-full border border-gray-300 rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1">Confirm New Password</label>
        <input type="password" name="new_password_confirmation" class="w-full border border-gray-300 rounded px-3 py-2" required>
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
        Update Password
    </button>
</form>

</div>
@endsection