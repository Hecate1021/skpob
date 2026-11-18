@extends('layouts.admin')

@section('header_title', 'Admin Dashboard')

@section('content')
    <!-- Welcome Banner -->
    <div class="bg-white rounded-2xl shadow-sm border-l-4 border-sk-green p-6 mb-8 flex items-center justify-between">
        <div>
            <h3 class="text-2xl font-bold text-gray-900 mb-1">Welcome back, {{ Auth::user()->name }}!</h3>
            <p class="text-gray-600">Here is what is happening in Barangay Poblacion today.</p>
        </div>
        <div class="hidden md:block">
            <i class="fas fa-leaf text-5xl text-emerald-100"></i>
        </div>
    </div>

    <!-- Metrics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Metric 1 -->
        <div class="bg-white rounded-2xl shadow-sm p-6 flex items-center gap-4 border border-gray-100">
            <div class="w-14 h-14 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center text-2xl shrink-0">
                <i class="fas fa-users"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium mb-1">Registered Youths</p>
                <h4 class="text-2xl font-bold text-gray-900">{{ number_format($totalYouths) }}</h4>
            </div>
        </div>

        <!-- Metric 2 -->
        <div class="bg-white rounded-2xl shadow-sm p-6 flex items-center gap-4 border border-gray-100">
            <div class="w-14 h-14 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center text-2xl shrink-0">
                <i class="fas fa-id-card"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium mb-1">Pending SK IDs</p>
                <h4 class="text-2xl font-bold text-gray-900">{{ number_format($pendingIds) }}</h4>
            </div>
        </div>

        <!-- Metric 3 -->
        <div class="bg-white rounded-2xl shadow-sm p-6 flex items-center gap-4 border border-gray-100">
            <div class="w-14 h-14 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl shrink-0">
                <i class="fas fa-folder-open"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium mb-1">Public Disclosures</p>
                <h4 class="text-2xl font-bold text-gray-900">0</h4>
            </div>
        </div>

        <!-- Metric 4 -->
        <div class="bg-white rounded-2xl shadow-sm p-6 flex items-center gap-4 border border-gray-100">
            <div class="w-14 h-14 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center text-2xl shrink-0">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium mb-1">Active Projects</p>
                <h4 class="text-2xl font-bold text-gray-900">0</h4>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Left Side: Recent ID Requests (Takes up 2 columns) -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col">
            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center shrink-0">
                <h3 class="font-bold text-gray-800">Recent SK ID Requests</h3>
                <a href="{{ route('admin.sk_ids.index') }}" class="text-sm font-semibold text-sk-green hover:underline">View All</a>
            </div>
            <div class="p-0 overflow-x-auto flex-grow">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 text-gray-600 font-medium">
                        <tr>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">Address</th>
                            <th class="px-6 py-3">Date Applied</th>
                            <th class="px-6 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($recentRequests as $request)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $request->first_name }} {{ $request->last_name }}</td>
                                <td class="px-6 py-4 text-gray-600 truncate max-w-[150px]" title="{{ $request->address }}">{{ $request->address }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $request->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-bold rounded-md uppercase tracking-wider
                                        {{ $request->status === 'pending' ? 'bg-amber-100 text-amber-700' : '' }}
                                        {{ $request->status === 'approved' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                        {{ $request->status === 'printed' ? 'bg-blue-100 text-blue-700' : '' }}
                                        {{ $request->status === 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                                        {{ $request->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500 font-medium">
                                    No recent ID requests found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Right Side: Demographics & Quick Actions (Takes up 1 column) -->
        <div class="space-y-8">

            <!-- Gender Demographics Chart -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h3 class="font-bold text-gray-800">Youth Demographics</h3>
                </div>
                <div class="p-6 flex justify-center items-center">
                    <!-- The Chart Canvas -->
                    <div class="relative w-full max-w-[220px]">
                        @if($maleCount == 0 && $femaleCount == 0)
                            <p class="text-center text-gray-400 text-sm py-8">No demographic data yet.</p>
                        @else
                            <canvas id="genderPieChart"></canvas>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h3 class="font-bold text-gray-800">Quick Actions</h3>
                </div>
                <div class="p-6 space-y-4">
                    <button class="w-full flex items-center justify-between p-4 rounded-xl border border-gray-200 hover:border-sk-green hover:bg-green-50 transition-colors group">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-emerald-100 text-sk-green flex items-center justify-center">
                                <i class="fas fa-upload"></i>
                            </div>
                            <span class="font-bold text-gray-700 group-hover:text-sk-darkgreen">Upload Document</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-sk-green"></i>
                    </button>
                    <button class="w-full flex items-center justify-between p-4 rounded-xl border border-gray-200 hover:border-sk-green hover:bg-green-50 transition-colors group">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                                <i class="fas fa-plus"></i>
                            </div>
                            <span class="font-bold text-gray-700 group-hover:text-sk-darkgreen">Create Project</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-sk-green"></i>
                    </button>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
<!-- Load Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctxElement = document.getElementById('genderPieChart');

        // Only render the chart if the canvas exists (i.e. if there is data)
        if (ctxElement) {
            const ctx = ctxElement.getContext('2d');

            // Injecting real data from Laravel controller
            const maleCount = {{ $maleCount }};
            const femaleCount = {{ $femaleCount }};

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Male', 'Female'],
                    datasets: [{
                        data: [maleCount, femaleCount],
                        backgroundColor: [
                            '#3b82f6', // Tailwind blue-500
                            '#ec4899'  // Tailwind pink-500
                        ],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: {
                                    family: "'Figtree', sans-serif",
                                    weight: 'bold'
                                },
                                usePointStyle: true,
                                padding: 20
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endpush
