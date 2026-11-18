<!-- SK ID Section -->
<section id="sk-id" class="py-24 bg-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center gap-12">
            <!-- Text / Instructions -->
            <div class="lg:w-1/2 z-10">
                <div class="flex items-center gap-2 mb-4 text-sk-green font-bold tracking-wider uppercase text-sm">
                    <span class="w-8 h-1 bg-sk-green rounded-full"></span>
                    Official Identification
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 leading-tight">
                    Get Your Official <span class="text-sk-yellow">SK ID</span> Today
                </h2>
                <p class="text-gray-600 mb-8 text-lg">
                    The SK ID is your official youth passport in Barangay Poblacion. It grants you access to exclusive youth programs, free training seminars, and local partner discounts.
                </p>

                <h3 class="text-xl font-bold text-gray-900 mb-4">How to Apply:</h3>
                <ul class="space-y-6">
                    <li class="flex items-start">
                        <div class="w-10 h-10 rounded-full bg-sk-green text-white flex-shrink-0 flex items-center justify-center font-bold text-lg mr-4 mt-1">1</div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-lg">Register Online</h4>
                            <p class="text-gray-600">Create an account and fill out the official youth profiling form on our portal.</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <div class="w-10 h-10 rounded-full bg-sk-green text-white flex-shrink-0 flex items-center justify-center font-bold text-lg mr-4 mt-1">2</div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-lg">Submit ID Request</h4>
                            <p class="text-gray-600">Upload your 2x2 ID picture with a white background and add your emergency contact details.</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <div class="w-10 h-10 rounded-full bg-sk-green text-white flex-shrink-0 flex items-center justify-center font-bold text-lg mr-4 mt-1">3</div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-lg">Download or Print</h4>
                            <p class="text-gray-600">Once approved by the admin, save the digital ID to your phone or print a physical copy.</p>
                        </div>
                    </li>
                </ul>

                <div class="mt-8">
                    <a href="{{ route('register') }}" class="inline-block px-8 py-3 rounded-full bg-sk-yellow text-sk-darkgreen font-bold hover:bg-yellow-300 transition-colors shadow-md transform hover:-translate-y-1">
                        Register Now
                    </a>
                </div>
            </div>

            <!-- Detailed Custom SK ID Mockup -->
            <div class="lg:w-1/2 relative flex justify-center mt-10 lg:mt-0">
                <!-- Background glow -->
                <div class="absolute inset-0 bg-sk-green opacity-10 rounded-full blur-3xl w-80 h-80 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></div>

                <!-- Responsive Scale Wrapper (Prevents horizontal scroll on mobile) -->
                <div class="transform scale-75 sm:scale-90 md:scale-100 lg:scale-105 xl:scale-110 origin-center transition-transform duration-500">

                    <!-- FRONT CARD -->
                    <div style="width: 450px; min-width: 450px; max-width: 450px; height: 285px; min-height: 285px; max-height: 285px;"
                         class="relative rounded-2xl shadow-2xl overflow-hidden shrink-0 border border-gray-200/50 bg-white font-sans transform rotate-2 hover:rotate-0 hover:scale-105 transition-all duration-500 cursor-default">

                        <!-- Custom Background Image -->
                        <img src="{{ asset('images/id-bg.png') }}" alt="Front Background" class="absolute inset-0 w-full h-full object-cover z-0">

                        <!-- SK Watermark -->
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none z-[5] opacity-[0.15]">
                            <img src="{{ asset('images/sklogo.png') }}" alt="Watermark" class="w-[220px] h-[220px] object-contain rounded-full">
                        </div>

                        <!-- Card Content Container -->
                        <div class="relative z-10 w-full h-full flex flex-col pt-3 px-5 pb-2">

                            <!-- Header -->
                            <div class="flex items-center justify-center gap-3 mb-2 shrink-0 overflow-hidden pr-6">
                                <img src="{{ asset('images/logo.jpg') }}" alt="Logo"
                                     style="width: 45px; height: 45px; min-width: 45px; max-width: 45px;"
                                     class="rounded-full object-cover shadow-sm border border-gray-200">
                                <div class="leading-tight shrink-0 text-center">
                                    <h1 class="text-[17px] font-black text-black uppercase tracking-wide drop-shadow-sm">Sangguniang Kabataan</h1>
                                    <h1 class="text-[14px] font-black text-black uppercase tracking-wide drop-shadow-sm">Brgy. Poblacion Lake Sebu</h1>
                                </div>
                            </div>

                            <!-- Body -->
                            <div class="flex h-full gap-4 mt-1">
                                <!-- Left Column: Photo Box & Signature -->
                                <div style="width: 120px; min-width: 120px; max-width: 120px;" class="flex flex-col items-center shrink-0">

                                  <!-- Dummy Photo for Landing Page Preview -->
                                    <div style="width: 115px; height: 120px; min-width: 115px; min-height: 120px;" class="bg-gray-100 rounded-lg overflow-hidden border border-gray-800 shadow-sm">
                                        <img src="https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&w=200&q=80" alt="Sample Profile" class="w-full h-full object-cover">
                                    </div>

                                    <!-- Signature Block -->
                                    <div class="w-full flex flex-col items-center mt-3">
                                        <div class="w-[100px] border-b-[1.5px] border-gray-600"></div>
                                        <p class="text-[11px] text-gray-800 font-normal mt-0.5">Signature</p>
                                    </div>

                                </div>

                                <!-- Right Column: Details & QR -->
                                <div class="flex-grow flex flex-col justify-start pl-1">
                                    <!-- Name -->
                                    <div class="border-b-[1.5px] border-gray-400 pb-0.5 mb-1.5 w-[95%]">
                                        <h2 class="text-[19px] font-black text-black uppercase leading-none tracking-wide text-left">JUAN DELA CRUZ</h2>
                                    </div>

                                    <div class="flex justify-between items-start w-[95%]">
                                        <!-- Demographics -->
                                        <div class="flex flex-col gap-1 text-left">
                                            <div class="leading-none mt-0.5">
                                                <p class="text-[11px] text-gray-800 font-normal mb-0.5">Date of Birth</p>
                                                <p class="text-[12px] font-bold text-black">August 11, 2000</p>
                                            </div>
                                            <div class="leading-none mt-1">
                                                <p class="text-[11px] text-gray-800 font-normal mb-0.5">Address</p>
                                                <p class="text-[12px] font-bold text-black max-w-[140px] leading-tight">Sitio Lugan Poblacion Lake Sebu</p>
                                            </div>
                                            <div class="leading-none mt-1">
                                                <p class="text-[11px] text-gray-800 font-normal mb-0.5">Contact No.</p>
                                                <p class="text-[12px] font-bold text-black">09123456789</p>
                                            </div>
                                            <div class="leading-none mt-1">
                                                <p class="text-[9px] text-gray-800 font-normal mb-0.5">Expire Date</p>
                                                <p class="text-[11px] font-bold text-black">November, 2026 - 2029</p>
                                            </div>
                                        </div>

                                        <!-- QR Code & ID Number -->
                                        <div class="shrink-0 flex flex-col items-center justify-start mt-0.5">
                                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&margin=1&data=SKPOB-26-0001" alt="QR Code" class="w-[85px] h-[85px] bg-white border border-gray-300 p-0.5">
                                            <p class="text-[11px] font-bold text-black mt-1">SKPOB-26-0001</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
