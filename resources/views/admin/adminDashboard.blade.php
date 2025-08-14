@extends('layouts.myapp')

@section('content')
<div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
    <div class="flex flex-col flex-1 w-full">
        <main class="h-full overflow-y-auto">
            <div class="container px-6 mx-auto grid mb-32"> 
                <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"> 
                    Dashboard  
                </h2> 
             
                <!-- Cards -->
                <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">

                    <!-- Clients Card -->
                    <a href="{{ route('users') }}">
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs hover:bg-pr-200">
                            <div class="p-3 mr-4 bg-pr-400 rounded-full">
                                <svg style="fill: #fff" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-lg font-medium text-pr-400">Total clients</p>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                    {{ ($clients ?? 0) + ($admins ?? 0) }} (admins: {{ $admins ?? 0 }})
                                </p>
                            </div>
                        </div>
                    </a>

                    <!-- Available Cars Card -->
                    <a href="{{ route('cars.index') }}">
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs hover:bg-pr-200">
                            <div class="p-3 mr-4 bg-pr-400 rounded-full">
                                <svg style="fill: #fff" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                    <path d="..."></path> {{-- (SVG path here) --}}
                                </svg>
                            </div>
                            <div>
                                <p class="text-lg font-medium text-pr-400">Available Cars</p>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                    {{ $cars->where('status', 'Available')->count() }}
                                </p>
                            </div>
                        </div>
                    </a>

                    <!-- Reservations Card -->
                    <a href="javascript:void(0);" onclick="scrollToReservations();">
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs hover:bg-pr-200">
                            <div class="p-3 mr-4 bg-pr-400 rounded-full">
                                <svg style="fill: #fff" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                    <path d="..."></path> {{-- (SVG path here) --}}
                                </svg>
                            </div>
                            <div>
                                <p class="text-lg font-medium text-pr-400">Active Reservations</p>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                    {{ $reservations->where('status', 'Active')->count() }}
                                </p>
                            </div>
                        </div>
                    </a>

                </div>

                <!-- Reservations Section -->
                <div id="reservations" class="mt-12">
                    <div class="flex align-middle justify-center">
                        <hr class="mt-8 h-0.5 w-1/2 bg-pr-500">
                        <p class="my-2 mx-8 p-2 font-bold text-gray-600 text-lg">RESERVATIONS</p>
                        <hr class="mt-8 h-0.5 w-1/2 bg-pr-500">
                    </div>
                </div>

                <!-- Reservations Table -->
                <div class="w-full overflow-hidden rounded-lg shadow-xs">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full whitespace-no-wrap table-auto">
                            <thead>
                                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                    <th class="px-4 py-3">Client</th>
                                    <th class="px-4 py-3">Car</th>
                                    <th class="px-4 py-3">Start Date</th>
                                    <th class="px-4 py-3">End Date</th>
                                    <th class="px-4 py-3">Duration</th>
                                    <th class="px-4 py-3">Remaining Days</th>
                                    <th class="px-4 py-3">Price</th>
                                    <th class="px-4 py-3">Payment Status</th>
                                    <th class="px-4 py-3">Reservation Status</th>
                                    <th class="px-4 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                @forelse ($reservations as $reservation)
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm flex items-center">
                                            <img loading="lazy" src="{{ $reservation->user->avatar }}" alt="" class="w-8 h-8 rounded-full mr-3">
                                            <div>
                                                <p class="font-semibold">{{ $reservation->user->name }}</p>
                                                <p class="text-xs text-gray-600">{{ $reservation->user->email }}</p>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-sm">{{ $reservation->car->brand }} {{ $reservation->car->model }}</td>
                                        <td class="px-4 py-3 text-sm">{{ \Carbon\Carbon::parse($reservation->start_date)->format('Y-m-d') }}</td>
                                        <td class="px-4 py-3 text-sm">{{ \Carbon\Carbon::parse($reservation->end_date)->format('Y-m-d') }}</td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ \Carbon\Carbon::parse($reservation->end_date)->diffInDays(\Carbon\Carbon::parse($reservation->start_date)) }} days
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            @php
                                            $endDate = \Carbon\Carbon::parse($reservation->end_date);
                                            @endphp

                                            @if ($endDate->isPast())
                                                Expired
                                            @else
                                                {{ now()->diffInDays($endDate) }} days
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ $reservation->car->price_per_day * $reservation->days }} $
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            @if ($reservation->payment_status == 'Pending')
                                                <span class="px-2 py-1 bg-yellow-300 rounded text-white">{{ $reservation->payment_status }}</span>
                                            @elseif ($reservation->payment_status == 'Canceled')
                                                <span class="px-2 py-1 bg-red-500 rounded text-white">{{ $reservation->payment_status }}</span>
                                            @else
                                                <span class="px-2 py-1 bg-green-500 rounded text-white">{{ $reservation->payment_status }}</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            @if ($reservation->status == 'Pending')
                                                <span class="px-2 py-1 bg-yellow-300 rounded text-white">{{ $reservation->status }}</span>
                                            @elseif ($reservation->status == 'Ended')
                                                <span class="px-2 py-1 bg-black rounded text-white">{{ $reservation->status }}</span>
                                            @elseif ($reservation->status == 'Active')
                                                <span class="px-2 py-1 bg-green-500 rounded text-white">{{ $reservation->status }}</span>
                                            @else
                                                <span class="px-2 py-1 bg-red-500 rounded text-white">{{ $reservation->status }}</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-sm space-y-2">
                                            <a href="{{ route('editStatus', ['reservation' => $reservation->id]) }}" class="block p-2 bg-pr-500 hover:bg-pr-400 text-white rounded text-center">Edit Status</a>
                                            <a href="{{ route('editPayment', ['reservation' => $reservation->id]) }}" class="block p-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded text-center">Edit Payment</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-gray-400 py-8">No reservations found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="flex justify-center my-12">
                        {{ $reservations->links() }}
                    </div>
                </div>
                 
                   
                </div>

            </div>
        </main>
    </div>
</div>
<!-- <div class="flex justify-center my-12">
            {{ $reservations->links() }}
        </div> -->
<script>
    function scrollToReservations() {
        const section = document.getElementById('reservations');
        if (section) {
            section.scrollIntoView({ behavior: 'smooth' });
        }
    }
</script>
@endsection
