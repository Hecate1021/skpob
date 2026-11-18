@extends('layouts.admin')

@section('header_title', 'Edit Document')

@section('content')
    <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <div class="flex items-center justify-between mb-6 border-b pb-4">
            <h3 class="font-bold text-gray-800 text-xl">Edit Disclosure Document</h3>
            <a href="{{ route('admin.disclosure.index') }}" class="text-sm font-semibold text-gray-500 hover:text-sk-green"><i class="fas fa-arrow-left mr-1"></i> Back</a>
        </div>

        <form action="{{ route('admin.disclosure.update', $disclosure) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Document Title</label>
                <input type="text" name="title" value="{{ old('title', $disclosure->title) }}" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20">
                @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

           <div>
    <label class="block text-sm font-bold text-gray-700 mb-1">Book Category</label>
    <select name="disclosure_category_id" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20">
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ $disclosure->disclosure_category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('disclosure_category_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
</div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Year</label>
                <input type="number" name="year" value="{{ old('year', $disclosure->year) }}" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20">
                @error('year') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                <label class="block text-sm font-bold text-gray-700 mb-2">Replace PDF File (Optional)</label>
                <p class="text-xs text-gray-500 mb-3">Leave this empty if you want to keep the current file.</p>
                <input type="file" name="document" accept=".pdf" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-sk-green hover:file:bg-green-100">
                @error('document') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror

                <div class="mt-3 text-sm">
                    <span class="font-medium text-gray-700">Current File:</span>
                    <a href="{{ asset($disclosure->file_path) }}" target="_blank" class="text-sk-green hover:underline">View Current PDF</a>
                </div>
            </div>

            <div class="pt-4 flex justify-end gap-3">
                <a href="{{ route('admin.disclosure.index') }}" class="px-6 py-3 bg-gray-100 text-gray-700 font-bold rounded-lg hover:bg-gray-200 transition-colors">Cancel</a>
                <button type="submit" class="px-6 py-3 bg-sk-green text-white font-bold rounded-lg hover:bg-sk-darkgreen transition-colors">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
@endsection
