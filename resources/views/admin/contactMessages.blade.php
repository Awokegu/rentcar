@extends('layouts.myapp')

@section('content')
<div class="container mx-auto mt-8">
    <!-- <div class="flex md:flex-row flex-col justify-between max-w-screen-xl md:px-16 px-8 mx-auto gap-12 ">
        <div class="md:w-1/2 order-last md:order-first mb-12 "> -->
    @if (session('success'))
        <div id="toast" class="fixed bottom-5 right-5 bg-green-500 text-white p-4 rounded shadow-md transition-opacity duration-300">
            {{ session('success') }}
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const toast = document.getElementById('toast');
                toast.classList.remove('hidden'); // Show the toast
                setTimeout(() => {
                    toast.classList.add('opacity-0'); // Fade out
                    setTimeout(() => {
                        toast.classList.add('hidden'); // Hide after fade out
                        toast.classList.remove('opacity-0'); // Reset for next show
                    }, 300); // Match the duration of the fade out
                }, 3000); // Show for 3 seconds
            });
        </script>
    @endif
    <div id="contact-messages" class="mt-12">
        <div class="flex items-center justify-center mt-8">
            <hr class="h-0.5 w-1/2 bg-pr-500">
            <p class="mx-4 font-bold text-gray-600 text-lg">CONTACT MESSAGES</p>
            <hr class="h-0.5 w-1/2 bg-pr-500">
        </div>
    </div>

    <!-- Contact Messages Table -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap table-auto">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">First Name</th>
                        <th class="px-4 py-3">Last Name</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Phone</th>
                        <th class="px-4 py-3">Subject</th>
                        <th class="px-4 py-3">Message</th>
                        <th class="px-4 py-3">Date</th>
                        <th class="px-4 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @forelse ($messages as $message)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm">{{ htmlspecialchars($message->first_name) }}</td>
                            <td class="px-4 py-3 text-sm">{{ htmlspecialchars($message->last_name) }}</td>
                            <td class="px-4 py-3 text-sm">{{ htmlspecialchars($message->email) }}</td>
                            <td class="px-4 py-3 text-sm">{{ htmlspecialchars($message->phone) }}</td>
                            <td class="px-4 py-3 text-sm">{{ htmlspecialchars($message->subject) }}</td>
                            <td class="px-4 py-3 text-sm">{{ nl2br(htmlspecialchars($message->message)) }}</td>
                            <td class="px-4 py-3 text-sm">{{ $message->created_at->format('Y-m-d H:i') }}</td>
                            <td class="px-4 py-3 text-sm">
                               <form action="{{ route('admin.contactMessages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-gray-400 py-8">No messages found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="flex justify-center my-12">
            {{ $messages->links() }}
        </div>
    </div>
</div>
@endsection