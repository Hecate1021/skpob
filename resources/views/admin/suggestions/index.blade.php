@extends('layouts.admin')

@section('header_title', 'Youth Suggestions & Initiatives')

@section('content')
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 overflow-hidden">
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h3 class="font-bold text-gray-800 text-lg">Community Idea Box</h3>
        </div>

        <div class="space-y-4">
            @forelse($suggestions as $suggestion)
                <div class="p-5 border border-gray-100 rounded-xl bg-gray-50 hover:bg-white hover:shadow-md transition-all">
                    <div class="flex justify-between items-start mb-2">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center font-bold text-sm shrink-0">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">{{ $suggestion->name }}</h4>
                                <p class="text-[11px] text-gray-500">{{ $suggestion->created_at->format('M d, Y • h:i A') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 pl-10">
                        <p class="text-gray-700 whitespace-pre-line leading-relaxed">"{{ $suggestion->suggestion }}"</p>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3 text-gray-400">
                        <i class="fas fa-lightbulb text-2xl"></i>
                    </div>
                    <p class="text-gray-500 font-medium">The idea box is currently empty.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $suggestions->links() }}
        </div>
    </div>
@endsection
