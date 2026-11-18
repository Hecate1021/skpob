@extends('layouts.admin')

@section('header_title', 'Youth Registry')

@section('content')
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 overflow-hidden">

        <!-- Header & Search -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6 border-b pb-4">
            <div>
                <h3 class="font-bold text-gray-800 text-lg">Master Masterlist</h3>
                <p class="text-sm text-gray-500 mt-1">All registered youth accounts in Brgy. Poblacion.</p>
            </div>

            <form action="" method="GET" class="w-full md:w-1/3 relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name, address, or contact..."
                       class="w-full pl-10 pr-10 py-2 border border-gray-300 rounded-lg focus:border-sk-green focus:ring-1 focus:ring-sk-green text-sm transition-colors">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>

                @if(request('search'))
                    <a href="{{ route('admin.youth_registry') }}" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-red-400 hover:text-red-600 transition-colors">
                        <i class="fas fa-times-circle"></i>
                    </a>
                @endif
            </form>
        </div>

        <!-- Registry Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="px-4 py-3">Full Name & Email</th>
                        <th class="px-4 py-3">Demographics</th>
                        <th class="px-4 py-3">Address & Contact</th>
                        <th class="px-4 py-3">Registered On</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($youths as $youth)
                        <tr class="hover:bg-gray-50 transition-colors">

                            <!-- Name & Email -->
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-green-100 text-[#00a651] flex items-center justify-center font-bold shadow-sm shrink-0">
                                        {{ substr($youth->first_name, 0, 1) }}{{ substr($youth->last_name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-900 text-base">{{ $youth->first_name }} {{ $youth->last_name }}</p>
                                        <p class="text-xs text-gray-500">{{ $youth->email }}</p>
                                    </div>
                                </div>
                            </td>

                            <!-- Demographics -->
                            <td class="px-4 py-4">
                                @if($youth->dob)
                                    <p class="text-gray-900 font-medium">{{ \Carbon\Carbon::parse($youth->dob)->age }} years old</p>
                                    <p class="text-xs text-gray-500">{{ $youth->gender ?? 'Not specified' }} • Born: {{ \Carbon\Carbon::parse($youth->dob)->format('M d, Y') }}</p>
                                @else
                                    <span class="text-xs text-gray-400 italic">Incomplete Profile</span>
                                @endif
                            </td>

                            <!-- Contact Info -->
                            <td class="px-4 py-4">
                                <p class="font-medium text-gray-800"><i class="fas fa-phone-alt text-xs text-[#00a651] mr-1"></i> {{ $youth->contact_number ?? 'N/A' }}</p>
                                <p class="text-xs text-gray-500 truncate max-w-[200px]" title="{{ $youth->address }}">{{ $youth->address ?? 'N/A' }}</p>
                            </td>

                            <!-- Date Joined -->
                            <td class="px-4 py-4">
                                <p class="text-gray-800 font-medium">{{ $youth->created_at->format('M d, Y') }}</p>
                                <p class="text-xs text-gray-500">{{ $youth->created_at->diffForHumans() }}</p>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-12 text-center">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3 text-gray-400">
                                    <i class="fas fa-users text-2xl"></i>
                                </div>
                                <p class="text-gray-500 font-medium">No registered youth found.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="mt-6">
            {{ $youths->links() }}
        </div>
    </div>
@endsection
