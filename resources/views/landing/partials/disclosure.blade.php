<!-- Full Public Disclosure Board Section -->
<section id="disclosure" class="py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <div class="flex items-center justify-center gap-2 mb-4 text-sk-green font-bold tracking-wider uppercase text-sm">
                <span class="w-8 h-1 bg-sk-green rounded-full"></span>
                Transparency & Accountability
                <span class="w-8 h-1 bg-sk-green rounded-full"></span>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Full Public Disclosure Board</h2>
            <p class="text-gray-600 text-lg">Browse our official documents, financial reports, and development plans to see how we manage the SK funds for the Poblacion youth.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-16 sm:gap-8 justify-items-center mt-12 mb-8 fade-in-up">
    @foreach($categories as $category)
        <!-- Dynamic Book -->
        <div class="book-container relative w-56 h-[340px] cursor-pointer perspective-1000 group" data-category-id="{{ $category->id }}" data-title="{{ $category->name }}">
            <!-- Shadow & Pages -->
            <div class="absolute inset-0 bg-{{ $category->theme_color }}-900 rounded-r-2xl rounded-l-md shadow-2xl translate-x-2 translate-y-2"></div>
            <div class="absolute inset-y-2 right-0 left-4 bg-gray-50 border border-gray-200 rounded-r-xl translate-x-1.5 translate-y-1.5 flex flex-col justify-between py-2 items-end pr-1 overflow-hidden">
                <div class="w-full h-[1px] bg-gray-200"></div><div class="w-full h-[1px] bg-gray-200"></div><div class="w-full h-[1px] bg-gray-200"></div>
                <div class="w-full h-[1px] bg-gray-200"></div><div class="w-full h-[1px] bg-gray-200"></div><div class="w-full h-[1px] bg-gray-200"></div>
            </div>

            <!-- Cover -->
            <div class="book-cover absolute inset-0 bg-{{ $category->theme_color }}-700 rounded-r-2xl rounded-l-md shadow-xl border-l-8 border-{{ $category->theme_color }}-900 z-10 overflow-hidden flex flex-col justify-between p-5 text-center group-hover:shadow-2xl">
                <div class="absolute left-1 top-0 bottom-0 w-px bg-white/30"></div>
                <div class="flex flex-col items-center mt-4">
                    <div class="w-14 h-14 rounded-full bg-white flex items-center justify-center mb-4 shadow-inner p-2 border-2 border-sk-yellow">
                        <i class="fas {{ $category->icon }} text-2xl text-{{ $category->theme_color }}-700"></i>
                    </div>
                    <h3 class="text-white font-extrabold text-lg uppercase tracking-wider leading-tight mb-2 font-serif drop-shadow-md px-2 break-words w-full">
    {!! str_replace(' ', '<br>', e($category->name)) !!}
</h3>
                    <div class="w-10 h-1 bg-sk-yellow mx-auto mb-2"></div>
                    <p class="text-white/80 text-[10px] font-semibold tracking-widest uppercase truncate w-full">
                        {{ $category->description ?? 'SK Poblacion' }}
                    </p>
                </div>
                <div class="mt-auto bg-white/10 px-3 py-2 rounded-lg backdrop-blur-sm border border-white/20 w-full group-hover:bg-white/20 transition-colors shadow-inner flex items-center justify-center gap-2">
                    <i class="fas fa-folder-open text-sk-yellow"></i>
                    <span class="text-white font-bold text-sm">View Files</span>
                </div>
            </div>
        </div>
    @endforeach
</div>

        <div class="text-center mt-6 text-gray-500 text-sm">
            <i class="fas fa-hand-pointer mr-1"></i> Click on any book to explore the archived files for each category.
        </div>
    </div>
</section>
