@extends('layouts.admin')

@section('header_title', 'Manage Disclosure Books')

@section('content')
    @if(session('success'))
        <div class="bg-emerald-100 border-l-4 border-sk-green text-emerald-800 p-4 mb-6 rounded shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Create Form -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 h-fit">
            <h3 class="font-bold text-gray-800 mb-6 border-b pb-2">Create New Book</h3>

            <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Book Name</label>
                    <input type="text" name="name" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20" placeholder="e.g. Resolutions">
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Short Description</label>
                    <input type="text" name="description" class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20" placeholder="e.g. Approved SK Resolutions">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">FontAwesome Icon</label>
                    <select name="icon" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20">
                        <option value="fa-folder-open">Folder (Default)</option>
                        <option value="fa-coins">Coins (Budget)</option>
                        <option value="fa-chart-pie">Chart (Financials)</option>
                        <option value="fa-sitemap">Sitemap (Planning)</option>
                        <option value="fa-trophy">Trophy (Accomplishments)</option>
                        <option value="fa-gavel">Gavel (Resolutions)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Theme Color</label>
                    <select name="theme_color" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20">
                        <option value="emerald">Emerald Green</option>
                        <option value="blue">Royal Blue</option>
                        <option value="amber">Amber Yellow</option>
                        <option value="purple">Deep Purple</option>
                        <option value="red">Crimson Red</option>
                        <option value="gray">Slate Gray</option>
                    </select>
                </div>

                <button type="submit" class="w-full py-3 bg-sk-green text-white font-bold rounded-lg hover:bg-sk-darkgreen transition-colors mt-4">
                    Save Book
                </button>
            </form>
        </div>

        <!-- Categories List -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-gray-800 mb-6 border-b pb-2">Existing Books</h3>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="px-4 py-3">Book Name</th>
                            <th class="px-4 py-3">Color</th>
                            <th class="px-4 py-3">Files Inside</th>
                            <th class="px-4 py-3 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($categories as $category)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 font-bold text-gray-900">
                                    <i class="fas {{ $category->icon }} mr-2 text-{{ $category->theme_color }}-600"></i>
                                    {{ $category->name }}
                                </td>
                                <td class="px-4 py-3 uppercase text-xs font-semibold text-gray-500">{{ $category->theme_color }}</td>
                                <td class="px-4 py-3 font-bold">{{ $category->documents_count }} files</td>
                                <td class="px-4 py-3 text-right flex justify-end gap-2">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="px-3 py-1 bg-amber-100 text-amber-700 rounded hover:bg-amber-200 text-xs font-bold transition">Edit</a>

                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('WARNING: Deleting this book will also delete all PDFs inside it! Continue?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200 text-xs font-bold transition">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-gray-500">No books created yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
