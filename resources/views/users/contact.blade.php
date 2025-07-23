<x-app-layout>
    <section class="contact-us text-[#3A3A3A]">

        <!-- Breadcrumb + Heading -->
        <div class="Breadcrumb px-4 sm:px-8 md:px-16 lg:px-24 py-6 border-b-2">
            <nav class="flex items-center text-xs sm:text-sm md:text-base space-x-2 font-medium uppercase">
                <a href="{{ route('users.index') }}" class="hover:underline">Home</a>
                <span>/</span>
                <span class="text-[#1083E5]">Contact Us</span>
            </nav>
            <h1 class="text-xl sm:text-3xl md:text-[45px] font-medium text-center uppercase mt-3">
                Contact Us
            </h1>
        </div>

        <!-- Main Content -->
        <div class="content px-4 sm:px-8 md:px-16 lg:px-24 py-10 mb-16">
            <div class="flex flex-col md:flex-row md:space-x-12 space-y-12 md:space-y-0">

                <!-- Contact Info -->
                <div class="md:w-1/2 space-y-6">
                    <h2 class="text-2xl sm:text-3xl font-semibold">Let’s talk with us</h2>
                    <p class="leading-relaxed">
                        Questions, comments, or suggestions? Simply fill in the form and we’ll be in touch shortly.
                    </p>
                    <ul class="space-y-3">
                        <li>
                            <span class="font-semibold">Address:</span>
                            1055 Arthur Ave Elk Groot, 67, Faisalabad, Pakistan
                        </li>
                        <li>
                            <span class="font-semibold">Phone:</span>
                            +92-329-8007788
                        </li>
                        <li>
                            <span class="font-semibold">Email:</span>
                            support@kingdomsdraw.com
                        </li>
                    </ul>
                </div>

                <!-- Contact Form -->
                <div class="md:w-1/2 bg-[#21366F] text-white p-6 rounded-lg">
                    <form action="#" method="POST" class="space-y-5">
                        <!-- name inputs -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <input type="text" name="first_name" placeholder="First Name"
                                class="w-full px-4 py-2 rounded text-[#3A3A3A]" required />
                            <input type="text" name="last_name" placeholder="Last Name"
                                class="w-full px-4 py-2 rounded text-[#3A3A3A]" required />
                        </div>
                        <input type="email" name="email" placeholder="Email Address"
                            class="w-full px-4 py-2 rounded text-[#3A3A3A]" required />

                        <input type="tel" name="phone" placeholder="Phone Number"
                            class="w-full px-4 py-2 rounded text-[#3A3A3A]" />

                        <textarea name="message" rows="4" placeholder="Your Message…"
                            class="w-full px-4 py-2 rounded text-[#3A3A3A] resize-none" required></textarea>

                        <button type="submit"
                            class="w-full text-black py-2 bg-[#FDC741] hover:bg-[#ffc738] rounded font-semibold">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
