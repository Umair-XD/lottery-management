<x-app-layout>
    <section class="giving">
        <div class="Breadcrumb px-4 sm:px-8 md:px-16 lg:px-20 xl:px-24 py-6 sm:py-8 md:py-10 border-b-2">
            <!-- Breadcrumb Navigation -->
            <nav
                class="flex flex-wrap items-center space-x-2 text-xs sm:text-sm md:text-base font-medium cursor-pointer">
                <a href="{{ route('users.index') }}" class="hover:underline px-1 sm:px-2 uppercase">Home</a>
                <span>/</span>
                <span class="text-[#1083E5] uppercase">FAQ's</span>
            </nav>

            <!-- Main Heading -->
            <h1 class="text-xl sm:text-3xl md:text-[45px] font-medium text-center uppercase mt-3">
                Frequently Ask Questions
            </h1>
        </div>

        <!-- FAQ Content -->
        <div class="content px-4 sm:px-8 md:px-16 lg:px-24 xl:px-28 py-8 sm:py-12 md:py-16">
            <div class="grid grid-cols-1 gap-8">

                <!-- 1. How do I enter the draw… -->
                <div class="faq-item bg-white rounded-xl shadow-lg p-6 transition hover:shadow-2xl">
                    <div class="faq-header flex items-center justify-between cursor-pointer">
                        <h2 class="text-base sm:text-lg md:text-xl lg:text-2xl font-bold text-[#1B1139]">
                            How do I enter the draw and what do I need to buy?
                        </h2>
                        <span class="toggle-icon text-xl sm:text-2xl">−</span>
                    </div>
                    <div class="faq-answer overflow-hidden transition-all duration-300 ease-out" style="max-height:0;">
                        <p class="mt-4 text-sm sm:text-base md:text-lg lg:text-xl text-[#363049]">
                            To enter a Kingdoms Draw, you need to purchase a ticket through our website or mobile app.
                            Each ticket is considered a product that qualifies you for a chance to win in the lucky
                            draw.
                        </p>
                    </div>
                </div>

                <!-- 2. Can I use points from a previous draw… -->
                <div class="faq-item bg-white rounded-xl shadow-lg p-6 transition hover:shadow-2xl">
                    <div class="faq-header flex items-center justify-between cursor-pointer">
                        <h2 class="text-base sm:text-lg md:text-xl lg:text-2xl font-bold text-[#1B1139]">
                            Can I use points from a previous draw to participate again?
                        </h2>
                        <span class="toggle-icon text-xl sm:text-2xl">+</span>
                    </div>
                    <div class="faq-answer overflow-hidden transition-all duration-300 ease-out" style="max-height:0;">
                        <p class="mt-4 text-sm sm:text-base md:text-lg lg:text-xl text-[#363049]">
                            Yes! If you don’t win, your ticket value is converted into points (Rs. 1 = 1 point), which
                            you can use to buy entries for future draws.
                        </p>
                    </div>
                </div>

                <!-- 3. How do I know if I’ve won… -->
                <div class="faq-item bg-white rounded-xl shadow-lg p-6 transition hover:shadow-2xl">
                    <div class="faq-header flex items-center justify-between cursor-pointer">
                        <h2 class="text-base sm:text-lg md:text-xl lg:text-2xl font-bold text-[#1B1139]">
                            How do I know if I’ve won and how will I receive my prize?
                        </h2>
                        <span class="toggle-icon text-xl sm:text-2xl">+</span>
                    </div>
                    <div class="faq-answer overflow-hidden transition-all duration-300 ease-out" style="max-height:0;">
                        <p class="mt-4 text-sm sm:text-base md:text-lg lg:text-xl text-[#363049]">
                            Winners are notified via email/SMS and can view results in their “My Draws” section. Prizes
                            are sent via wallet credit or bank transfer within 3–7 working days.
                        </p>
                    </div>
                </div>

                <!-- 4. Is my personal and payment information safe? -->
                <div class="faq-item bg-white rounded-xl shadow-lg p-6 transition hover:shadow-2xl">
                    <div class="faq-header flex items-center justify-between cursor-pointer">
                        <h2 class="text-base sm:text-lg md:text-xl lg:text-2xl font-bold text-[#1B1139]">
                            Is my personal and payment information safe?
                        </h2>
                        <span class="toggle-icon text-xl sm:text-2xl">+</span>
                    </div>
                    <div class="faq-answer overflow-hidden transition-all duration-300 ease-out" style="max-height:0;">
                        <p class="mt-4 text-sm sm:text-base md:text-lg lg:text-xl text-[#363049]">
                            Absolutely. We use secure encryption and never share your personal data with third parties.
                        </p>
                    </div>
                </div>

                <!-- 5. What payment options do you accept? -->
                <div class="faq-item bg-white rounded-xl shadow-lg p-6 transition hover:shadow-2xl">
                    <div class="faq-header flex items-center justify-between cursor-pointer">
                        <h2 class="text-base sm:text-lg md:text-xl lg:text-2xl font-bold text-[#1B1139]">
                            What payment options do you accept?
                        </h2>
                        <span class="toggle-icon text-xl sm:text-2xl">+</span>
                    </div>
                    <div class="faq-answer overflow-hidden transition-all duration-300 ease-out" style="max-height:0;">
                        <p class="mt-4 text-sm sm:text-base md:text-lg lg:text-xl text-[#363049]">
                            We accept JazzCash, EasyPaisa, debit/credit cards, bank transfers, and other popular local
                            methods.
                        </p>
                    </div>
                </div>

                <!-- 6. How can I take a break or delete my account? -->
                <div class="faq-item bg-white rounded-xl shadow-lg p-6 transition hover:shadow-2xl">
                    <div class="faq-header flex items-center justify-between cursor-pointer">
                        <h2 class="text-base sm:text-lg md:text-xl lg:text-2xl font-bold text-[#1B1139]">
                            How can I take a break or delete my account?
                        </h2>
                        <span class="toggle-icon text-xl sm:text-2xl">+</span>
                    </div>
                    <div class="faq-answer overflow-hidden transition-all duration-300 ease-out" style="max-height:0;">
                        <p class="mt-4 text-sm sm:text-base md:text-lg lg:text-xl text-[#363049]">
                            You can pause or permanently delete your account anytime from your profile settings. While
                            on a break, your tickets won’t be entered into draws.
                        </p>
                    </div>
                </div>

                <!-- 7. How do I get help if I have issues… -->
                <div class="faq-item bg-white rounded-xl shadow-lg p-6 transition hover:shadow-2xl">
                    <div class="faq-header flex items-center justify-between cursor-pointer">
                        <h2 class="text-base sm:text-lg md:text-xl lg:text-2xl font-bold text-[#1B1139]">
                            How do I get help if I have issues with my account or payment?
                        </h2>
                        <span class="toggle-icon text-xl sm:text-2xl">+</span>
                    </div>
                    <div class="faq-answer overflow-hidden transition-all duration-300 ease-out" style="max-height:0;">
                        <p class="mt-4 text-sm sm:text-base md:text-lg lg:text-xl text-[#363049]">
                            Our customer support is available Monday–Saturday, 10:00 AM to 7:00 PM (PKT). You can reach
                            us at +92-329-8007788 or email support@kingdomsdraw.com.
                        </p>
                    </div>
                </div>

            </div>
        </div>

    </section>

    <!-- JavaScript for animated accordion behavior using Tailwind classes -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.faq-item').forEach((item, index) => {
                const header = item.querySelector('.faq-header');
                const answer = item.querySelector('.faq-answer');
                const icon = item.querySelector('.toggle-icon');

                // Expand the first FAQ item by default
                if (index === 0) {
                    answer.style.maxHeight = answer.scrollHeight + "px";
                    icon.textContent = "-";
                }

                header.addEventListener('click', () => {
                    // If the answer is expanded, collapse it; otherwise, expand it.
                    if (answer.style.maxHeight && answer.style.maxHeight !== "0px") {
                        answer.style.maxHeight = "0";
                        icon.textContent = "+";
                    } else {
                        answer.style.maxHeight = answer.scrollHeight + "px";
                        icon.textContent = "-";
                    }
                });
            });
        });
    </script>
</x-app-layout>
