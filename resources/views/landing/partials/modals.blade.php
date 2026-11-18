<!-- Document Selection Modal Overlay -->
<div id="selection-modal" class="fixed inset-0 z-[90] hidden flex items-center justify-center p-4">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-gray-900/80 backdrop-blur-sm transition-opacity" id="selection-backdrop"></div>

    <!-- Modal Content Box -->
    <div class="relative w-full max-w-3xl bg-white rounded-2xl shadow-2xl flex flex-col overflow-hidden animate-modal max-h-[90vh]">
        <!-- Modal Header -->
        <div class="flex justify-between items-center p-6 bg-gray-100 border-b border-gray-200">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-sk-green text-white flex items-center justify-center text-lg shrink-0">
                    <i class="fas fa-folder-open"></i>
                </div>
                <div>
                    <h3 id="selection-modal-title" class="font-bold text-gray-800 text-xl leading-tight">Document List</h3>
                    <p class="text-sm text-gray-500">Select a file to view</p>
                </div>
            </div>
            <button type="button" id="close-selection-btn" class="text-gray-500 hover:text-red-500 transition-colors w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-200 focus:outline-none shrink-0">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>
        <!-- Modal Body (Grid of docs injected via JS) -->
        <div class="flex-grow p-6 overflow-y-auto bg-gray-50">
            <div id="doc-list-container" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Buttons will be injected here dynamically -->
            </div>
        </div>
    </div>
</div>

<!-- PDF Modal Overlay -->
<div id="pdf-modal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 md:p-10 lg:p-20">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-gray-900/90 backdrop-blur-sm transition-opacity" id="modal-backdrop"></div>

    <!-- Modal Content Box -->
    <div class="relative w-full h-full bg-white rounded-2xl shadow-2xl flex flex-col overflow-hidden animate-modal">
        <!-- Modal Header -->
        <div class="flex justify-between items-center p-4 bg-gray-100 border-b border-gray-200">
            <div class="flex items-center gap-3">
                <button type="button" id="back-to-docs-btn" class="flex items-center text-sm font-semibold text-gray-600 hover:text-sk-green transition-colors px-3 py-1.5 rounded-lg hover:bg-gray-200 mr-2 shrink-0">
                    <i class="fas fa-arrow-left mr-2"></i> Back
                </button>
                <div class="w-8 h-8 rounded bg-red-100 text-red-600 flex items-center justify-center shrink-0">
                    <i class="fas fa-file-pdf"></i>
                </div>
                <div class="overflow-hidden">
                    <h3 id="pdf-modal-title" class="font-bold text-gray-800 leading-tight truncate">Document Viewer</h3>
                    <p class="text-xs text-gray-500">PDF Document</p>
                </div>
            </div>
            <button type="button" id="close-modal-btn" class="text-gray-500 hover:text-red-500 transition-colors w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-200 focus:outline-none shrink-0">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <!-- Modal Body (Iframe) -->
        <div class="flex-grow w-full h-full relative bg-gray-200">
            <!-- Fallback loading message behind the iframe -->
            <div class="absolute inset-0 flex items-center justify-center text-gray-400">
                <div class="flex flex-col items-center">
                    <i class="fas fa-spinner fa-spin text-3xl mb-2"></i>
                    <p>Loading PDF...</p>
                </div>
            </div>
            <!-- Actual iframe (border-0 replaces deprecated frameborder) -->
            <iframe src="" class="absolute inset-0 w-full h-full z-10 border-0"></iframe>
        </div>
    </div>
</div>

<!-- Project Details Modal Overlay -->
<div id="project-modal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 sm:p-6 md:p-12">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-gray-900/80 backdrop-blur-sm transition-opacity" id="project-backdrop"></div>

    <!-- Modal Content Box -->
    <div class="relative w-full max-w-4xl bg-white rounded-2xl shadow-2xl flex flex-col overflow-hidden max-h-[90vh] animate-modal">
        <!-- Floating Close Button -->
        <button type="button" id="close-project-btn" class="absolute top-4 right-4 z-20 w-10 h-10 bg-white border border-gray-200 text-gray-800 rounded-full flex items-center justify-center shadow-lg hover:bg-gray-100 hover:text-red-500 transition-colors focus:outline-none">
            <i class="fas fa-times text-xl"></i>
        </button>

        <!-- flex-row with a forced minimum height so short text doesn't crush the modal -->
        <div class="overflow-y-auto flex-grow flex flex-col md:flex-row min-h-[450px]">

            <!-- Image Section (50% width on desktop) -->
            <div class="md:w-1/2 h-64 md:h-auto relative bg-gray-50 flex-shrink-0 border-b md:border-b-0 md:border-r border-gray-200">
                <img id="project-modal-image" src="" alt="Project Image" class="absolute inset-0 w-full h-full object-contain p-4">

                <!-- Fallback icon if no image -->
                <div id="project-modal-no-image" class="absolute inset-0 flex items-center justify-center text-gray-300 hidden">
                    <i class="fas fa-image text-5xl"></i>
                </div>
            </div>

            <!-- Content Section (50% width on desktop, vertically centered) -->
            <div class="p-8 md:p-10 md:w-1/2 flex flex-col justify-center">
                <div class="flex items-center gap-3 mb-6">
                    <span id="project-modal-status" class="px-3 py-1 text-[10px] font-bold uppercase tracking-wider rounded-full shadow-sm text-white"></span>
                    <div class="flex items-center text-sm text-gray-500 font-semibold">
                        <i class="far fa-calendar-alt text-sk-green mr-2"></i>
                        <span id="project-modal-date"></span>
                    </div>
                </div>

                <h3 id="project-modal-title" class="font-bold text-gray-900 text-2xl md:text-3xl leading-tight mb-6"></h3>

                <p id="project-modal-desc" class="text-gray-600 text-base leading-relaxed whitespace-pre-wrap overflow-y-auto max-h-[250px] pr-2 custom-scrollbar"></p>
            </div>
        </div>
    </div>
</div>
