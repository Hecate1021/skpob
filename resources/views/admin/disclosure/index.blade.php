@extends('layouts.admin')

@section('header_title', 'Manage Public Disclosures')

@section('content')
    @if(session('success'))
        <div class="bg-emerald-100 border-l-4 border-sk-green text-emerald-800 p-4 mb-6 rounded shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Upload Form -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 h-fit">
            <h3 class="font-bold text-gray-800 mb-6 border-b pb-2">Upload New Document</h3>

            <form action="{{ route('admin.disclosure.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Document Title</label>
                    <input type="text" name="title" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20" placeholder="e.g. 2026 Annual Budget">
                    @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

               <div>
    <label class="block text-sm font-bold text-gray-700 mb-1">Book Category</label>
    <select name="disclosure_category_id" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20">
        <option value="" disabled selected>-- Select a Book --</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    @error('disclosure_category_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
</div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Year</label>
                    <input type="number" name="year" value="{{ date('Y') }}" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20">
                    @error('year') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">PDF File</label>
                    <input type="file" name="document" accept=".pdf" required class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-sk-green hover:file:bg-green-100">
                    @error('document') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="w-full py-3 bg-sk-green text-white font-bold rounded-lg hover:bg-sk-darkgreen transition-colors mt-4">
                    Upload Document
                </button>
            </form>
        </div>

        <!-- Documents List -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-gray-800 mb-6 border-b pb-2">Uploaded Documents</h3>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="px-4 py-3">Year</th>
                            <th class="px-4 py-3">Title</th>
                            <th class="px-4 py-3">Category</th>
                            <th class="px-4 py-3 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($documents as $doc)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 font-bold text-gray-900">{{ $doc->year }}</td>
                                <td class="px-4 py-3">{{ $doc->title }}</td>
                               <td class="px-4 py-3 uppercase text-xs font-semibold text-gray-500">
    {{ $doc->category ? $doc->category->name : 'Uncategorized' }}
</td>

                                <!-- Update the Action column inside your foreach loop to look like this: -->
<td class="px-4 py-3 text-right flex justify-end gap-2">
    <a href="{{ asset($doc->file_path) }}" target="_blank" class="px-3 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200 text-xs font-bold transition">View</a>

    <a href="{{ route('admin.disclosure.edit', $doc) }}" class="px-3 py-1 bg-amber-100 text-amber-700 rounded hover:bg-amber-200 text-xs font-bold transition">Edit</a>

    <form action="{{ route('admin.disclosure.destroy', $doc) }}" method="POST" onsubmit="return confirm('Delete this document forever?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="px-3 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200 text-xs font-bold transition">Delete</button>
    </form>
</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-gray-500">No documents uploaded yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
