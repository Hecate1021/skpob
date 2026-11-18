@extends('layouts.admin')

@section('header_title', 'Manage Projects & Events')

@section('content')
    @if(session('success'))
        <div class="bg-emerald-100 border-l-4 border-sk-green text-emerald-800 p-4 mb-6 rounded shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <!-- Create Form -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 h-fit xl:col-span-1">
            <h3 class="font-bold text-gray-800 mb-6 border-b pb-2">Add New Project</h3>

            <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Project Title</label>
                    <input type="text" name="title" value="{{ old('title') }}" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20" placeholder="e.g. Oplan Linis Barangay">
                    @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Event Date</label>
                        <input type="date" name="event_date" value="{{ old('event_date') }}" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20">
                        @error('event_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Status</label>
                        <select name="status" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20">
                            <option value="upcoming" {{ old('status') == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                            <option value="ongoing" {{ old('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        @error('status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Upload Photo</label>
                    <input type="file" name="image" accept="image/*" required class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-sk-green hover:file:bg-green-100 border border-gray-200 rounded-md p-1">
                    @error('image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Description</label>
                    <textarea name="description" rows="4" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20" placeholder="Brief details about the event...">{{ old('description') }}</textarea>
                    @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="w-full py-3 bg-sk-green text-white font-bold rounded-lg hover:bg-sk-darkgreen transition-colors mt-4">
                    Save Project
                </button>
            </form>
        </div>

        <!-- Projects List -->
        <div class="xl:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-gray-800 mb-6 border-b pb-2">Archived & Active Projects</h3>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="px-4 py-3 w-24">Photo</th>
                            <th class="px-4 py-3">Project Details</th>
                            <th class="px-4 py-3">Date & Status</th>
                            <th class="px-4 py-3 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($projects as $project)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">
                                    <img src="{{ asset($project->image_path) }}" alt="{{ $project->title }}" class="w-16 h-16 object-cover rounded shadow-sm">
                                </td>
                                <td class="px-4 py-3">
                                    <p class="font-bold text-gray-900">{{ $project->title }}</p>
                                    <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $project->description }}</p>
                                </td>
                                <td class="px-4 py-3">
                                    <p class="font-bold text-gray-700">{{ $project->event_date->format('M d, Y') }}</p>
                                    <span class="inline-block mt-1 px-2 py-1 text-[10px] font-bold uppercase rounded-full
                                        {{ $project->status == 'completed' ? 'bg-blue-100 text-blue-700' : '' }}
                                        {{ $project->status == 'ongoing' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                        {{ $project->status == 'upcoming' ? 'bg-amber-100 text-amber-700' : '' }}">
                                        {{ $project->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right flex flex-col sm:flex-row justify-end gap-2">
                                    <a href="{{ route('admin.projects.edit', $project) }}" class="px-3 py-1.5 bg-amber-100 text-amber-700 rounded hover:bg-amber-200 text-xs font-bold transition text-center">Edit</a>

                                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Delete this project and its photo forever?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full sm:w-auto px-3 py-1.5 bg-red-100 text-red-700 rounded hover:bg-red-200 text-xs font-bold transition text-center">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-gray-500">No projects recorded yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
