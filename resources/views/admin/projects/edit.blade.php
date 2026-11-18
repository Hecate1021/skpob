@extends('layouts.admin')

@section('header_title', 'Edit Project')

@section('content')
    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <div class="flex items-center justify-between mb-6 border-b pb-4">
            <h3 class="font-bold text-gray-800 text-xl">Edit: {{ $project->title }}</h3>
            <a href="{{ route('admin.projects.index') }}" class="text-sm font-semibold text-gray-500 hover:text-sk-green"><i class="fas fa-arrow-left mr-1"></i> Back to Projects</a>
        </div>

        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Project Title</label>
                <input type="text" name="title" value="{{ old('title', $project->title) }}" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20">
                @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Event Date</label>
                    <!-- Format the Carbon date to YYYY-MM-DD so HTML5 date inputs can read it -->
                    <input type="date" name="event_date" value="{{ old('event_date', $project->event_date->format('Y-m-d')) }}" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20">
                    @error('event_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Status</label>
                    <select name="status" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20">
                        <option value="upcoming" {{ (old('status', $project->status) == 'upcoming') ? 'selected' : '' }}>Upcoming</option>
                        <option value="ongoing" {{ (old('status', $project->status) == 'ongoing') ? 'selected' : '' }}>Ongoing</option>
                        <option value="completed" {{ (old('status', $project->status) == 'completed') ? 'selected' : '' }}>Completed</option>
                    </select>
                    @error('status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200 flex gap-6 items-center">
                @if($project->image_path)
                    <img src="{{ asset($project->image_path) }}" alt="Current Photo" class="w-32 h-32 object-cover rounded-lg shadow-sm border border-gray-300">
                @endif
                <div class="flex-grow">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Replace Photo (Optional)</label>
                    <p class="text-xs text-gray-500 mb-3">Leave this empty if you want to keep the current photo.</p>
                    <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-sk-green hover:file:bg-green-100">
                    @error('image') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="5" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20">{{ old('description', $project->description) }}</textarea>
                @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="pt-4 flex justify-end gap-3">
                <a href="{{ route('admin.projects.index') }}" class="px-6 py-3 bg-gray-100 text-gray-700 font-bold rounded-lg hover:bg-gray-200 transition-colors">Cancel</a>
                <button type="submit" class="px-6 py-3 bg-sk-green text-white font-bold rounded-lg hover:bg-sk-darkgreen transition-colors">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
@endsection
