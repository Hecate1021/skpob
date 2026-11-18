<!-- Call to Action Section -->
<!-- CTA Section -->
<section class="py-20 relative overflow-hidden">
    <!-- Updated to use your new pink sk-green theme variable -->
    <div class="absolute inset-0 bg-sk-green"></div>
    <!-- Abstract pattern overlay -->
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#FBBF24 2px, transparent 2px); background-size: 30px 30px;"></div>

    <div class="max-w-4xl mx-auto px-4 relative z-10 text-center">
        <h2 class="text-3xl md:text-5xl font-black text-white mb-6 tracking-tight">Be a Catalyst for Change</h2>
        <!-- Changed emerald-100 to pink-100 for better blending -->
        <p class="text-pink-100 text-lg mb-10 max-w-2xl mx-auto font-medium leading-relaxed">
            Do you have ideas to improve our community? We want to hear from you. Volunteer for our programs or suggest a new initiative today.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">

            <!-- Suggestion Button (Triggers Modal) -->
            <button onclick="openSuggestionModal()" class="px-8 py-4 rounded-xl bg-sk-yellow text-sk-darkgreen font-bold text-lg hover:bg-yellow-300 hover:shadow-xl transition-all transform hover:-translate-y-1 shadow-lg">
                Suggest an Idea <i class="fas fa-lightbulb ml-1"></i>
            </button>

        </div>
    </div>
</section>

<!-- SUGGESTION MODAL OVERLAY -->
<div id="suggestion-modal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm transition-opacity">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden animate-modal">

        <!-- Modal Header -->
        <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50">
            <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                <i class="fas fa-lightbulb text-sk-yellow"></i> Suggest an Initiative
            </h3>
            <button onclick="closeSuggestionModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Modal Form -->
        <form action="{{ route('suggestions.store') }}" method="POST">
            @csrf
            <div class="p-6 space-y-5">
                <p class="text-sm text-gray-600 mb-2">Have a project in mind for Brgy. Poblacion? Let the SK Council know!</p>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Your Name <span class="text-gray-400 font-normal">(Optional)</span></label>
                    <!-- Updated focus rings/borders to sk-green -->
                    <input type="text" name="name" class="w-full px-4 py-3 rounded-lg border-gray-300 bg-gray-50 focus:bg-white focus:border-sk-green focus:ring focus:ring-sk-green/30 transition-colors" placeholder="e.g. Juan Dela Cruz"
                           @auth value="{{ Auth::user()->name }}" @endauth>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Your Idea / Suggestion <span class="text-red-500">*</span></label>
                    <textarea name="suggestion" rows="4" required class="w-full px-4 py-3 rounded-lg border-gray-300 bg-gray-50 focus:bg-white focus:border-sk-green focus:ring focus:ring-sk-green/30 transition-colors" placeholder="Tell us how we can improve our barangay..."></textarea>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="p-5 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                <button type="button" onclick="closeSuggestionModal()" class="px-5 py-2.5 bg-white border border-gray-300 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition-colors shadow-sm">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2.5 bg-sk-green text-white font-bold rounded-xl hover:bg-sk-darkgreen transition-colors shadow-md flex items-center gap-2">
                    Submit Idea <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </form>

    </div>
</div>

<!-- Modal Script -->
<script>
    function openSuggestionModal() {
        document.getElementById('suggestion-modal').classList.remove('hidden');
    }

    function closeSuggestionModal() {
        document.getElementById('suggestion-modal').classList.add('hidden');
    }

    // Close when clicking outside the modal box
    document.getElementById('suggestion-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeSuggestionModal();
        }
    });
</script>

<!-- Contact & Footer Section -->
<footer id="contact" class="bg-gray-900 text-white pt-20 pb-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-12 lg:gap-8 mb-16">

            <!-- Brand Info -->
            <div class="md:col-span-12 lg:col-span-4">
                <div class="flex items-center gap-3 mb-6">
                    <!-- Automatically uses the new pink sk-green -->
                    <div class="w-10 h-10 rounded-full bg-sk-green flex items-center justify-center text-white font-bold shadow-lg border border-sk-yellow">
                        SK
                    </div>
                    <h2 class="font-bold text-2xl text-white tracking-wide">Brgy. Poblacion</h2>
                </div>
                <p class="text-gray-400 mb-8 leading-relaxed">
                    Empowering the youth through transparent, inclusive, and effective local governance. Stay connected with us for updates on programs and events.
                </p>
                <!-- Socials -->
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-sk-green hover:text-white transition-colors duration-300">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-sk-green hover:text-white transition-colors duration-300">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-sk-green hover:text-white transition-colors duration-300">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-sk-green hover:text-white transition-colors duration-300">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="md:col-span-5 lg:col-span-3 lg:col-start-6">
                <h3 class="text-lg font-bold mb-6 text-white uppercase tracking-wider">Quick Links</h3>
                <ul class="space-y-4">
                    <li><a href="#home" class="text-gray-400 hover:text-sk-yellow transition-colors flex items-center"><i class="fas fa-angle-right mr-2 text-sm"></i> Home</a></li>
                    <li><a href="#disclosure" class="text-gray-400 hover:text-sk-yellow transition-colors flex items-center"><i class="fas fa-angle-right mr-2 text-sm"></i> Public Disclosure</a></li>
                    <li><a href="#projects" class="text-gray-400 hover:text-sk-yellow transition-colors flex items-center"><i class="fas fa-angle-right mr-2 text-sm"></i> Projects & Events</a></li>
                    <li><a href="#sk-id" class="text-gray-400 hover:text-sk-yellow transition-colors flex items-center"><i class="fas fa-angle-right mr-2 text-sm"></i> SK ID</a></li>
                    <li><a href="#about" class="text-gray-400 hover:text-sk-yellow transition-colors flex items-center"><i class="fas fa-angle-right mr-2 text-sm"></i> About Us</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="md:col-span-7 lg:col-span-4">
                <h3 class="text-lg font-bold mb-6 text-white uppercase tracking-wider">Contact Us</h3>
                <ul class="space-y-5">
                    <li class="flex items-start">
                        <div class="mt-1 w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-sk-yellow shrink-0">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-white font-medium">Barangay Hall</h4>
                            <p class="text-gray-400 text-sm mt-1"> Brgy. Poblacion, Lake Sebu, South Cotabato, Philippines </p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <div class="mt-1 w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-sk-yellow shrink-0">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-white font-medium">Email Address</h4>
                            <a href="mailto:sk@poblacion.gov.ph" class="text-gray-400 text-sm mt-1 hover:text-sk-yellow transition-colors">sk@poblacion.gov.ph</a>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <div class="mt-1 w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-sk-yellow shrink-0">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-white font-medium">Phone Number</h4>
                            <p class="text-gray-400 text-sm mt-1">+63 912 345 6789</p>
                        </div>
                    </li>
                </ul>
            </div>

        </div>

        <!-- Copyright -->
        <div class="pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-gray-500 text-sm text-center md:text-left">
                © <span id="year"></span> Sangguniang Kabataan of Brgy. Poblacion. All rights reserved.
            </p>
            <div class="flex gap-4 text-sm text-gray-500">
                <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
