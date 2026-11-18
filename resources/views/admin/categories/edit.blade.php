@extends('layouts.admin')

@section('header_title', 'Edit Book Category')

@section('content')
    <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <div class="flex items-center justify-between mb-6 border-b pb-4">
            <h3 class="font-bold text-gray-800 text-xl">Edit {{ $category->name }}</h3>
            <a href="{{ route('admin.categories.index') }}" class="text-sm font-semibold text-gray-500 hover:text-sk-green"><i class="fas fa-arrow-left mr-1"></i> Back</a>
        </div>

        <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Book Name</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20">
                @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Short Description</label>
                <input type="text" name="description" value="{{ old('description', $category->description) }}" class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">FontAwesome Icon</label>
                <select name="icon" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20">
                    <option value="fa-folder-open" {{ $category->icon == 'fa-folder-open' ? 'selected' : '' }}>Folder</option>
                    <option value="fa-coins" {{ $category->icon == 'fa-coins' ? 'selected' : '' }}>Coins</option>
                    <option value="fa-chart-pie" {{ $category->icon == 'fa-chart-pie' ? 'selected' : '' }}>Chart</option>
                    <option value="fa-sitemap" {{ $category->icon == 'fa-sitemap' ? 'selected' : '' }}>Sitemap</option>
                    <option value="fa-trophy" {{ $category->icon == 'fa-trophy' ? 'selected' : '' }}>Trophy</option>
                    <option value="fa-gavel" {{ $category->icon == 'fa-gavel' ? 'selected' : '' }}>Gavel</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Theme Color</label>
                <select name="theme_color" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20">
                    <option value="emerald" {{ $category->theme_color == 'emerald' ? 'selected' : '' }}>Emerald Green</option>
                    <option value="blue" {{ $category->theme_color == 'blue' ? 'selected' : '' }}>Royal Blue</option>
                    <option value="amber" {{ $category->theme_color == 'amber' ? 'selected' : '' }}>Amber Yellow</option>
                    <option value="purple" {{ $category->theme_color == 'purple' ? 'selected' : '' }}>Deep Purple</option>
                    <option value="red" {{ $category->theme_color == 'red' ? 'selected' : '' }}>Crimson Red</option>
                    <option value="gray" {{ $category->theme_color == 'gray' ? 'selected' : '' }}>Slate Gray</option>
                </select>
            </div>

            <div class="pt-4 flex justify-end gap-3">
                <button type="submit" class="px-6 py-3 bg-sk-green text-white font-bold rounded-lg hover:bg-sk-darkgreen transition-colors">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
@endsection
