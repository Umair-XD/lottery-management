<x-app-layout>
    <section class="giving">
        <div class="Breadcrumb px-24 py-10 border-b-2">
            <!-- Breadcrumb Navigation -->
            <nav class="flex items-center space-x-2 text-lg font-medium cursor-pointer">
                <a href="{{ route('users.index') }}" class="hover:underline px-2 uppercase">Home</a>
                <span>/</span>
                <span class="text-[#1083E5] uppercase">Frequently Ask Questions</span>
            </nav>
            <!-- Main Heading -->
            <h1 class="text-[45px] font-medium text-center uppercase mt-3">Frequently Ask Questions</h1>
        </div>
        <!-- FAQ Content -->
        <div class="content px-24 py-12">
            <div class="grid grid-cols-1 gap-8">
                <!-- FAQ Item 1 (expanded by default) -->
                <div class="faq-item bg-white rounded-xl shadow-lg p-8 transition duration-300 hover:shadow-2xl">
                    <div class="faq-header flex text-[#1B1139] items-center justify-between cursor-pointer">
                        <h2 class="text-2xl font-bold">What is the Customer Service Number?</h2>
                        <span class="toggle-icon text-3xl">-</span>
                    </div>
                    <!-- The answer container uses Tailwind classes to handle the transition -->
                    <div class="faq-answer overflow-hidden transition-all duration-300 ease-out" style="max-height: 0;">
                        <p class="mt-4 text-[#363049]">
                            You can contact Kingdom Draw Customer Service at +92-XXX-XXXXXXX. Our team is available to
                            assist you with any inquiries or issues you may have.
                        </p>
                    </div>
                </div>
                <!-- FAQ Item 2 -->
                <div class="faq-item bg-white rounded-xl shadow-lg p-8 transition duration-300 hover:shadow-2xl">
                    <div class="faq-header flex text-[#1B1139] items-center justify-between cursor-pointer">
                        <h2 class="text-2xl font-bold">What are the servicing hours?</h2>
                        <span class="toggle-icon text-3xl">+</span>
                    </div>
                    <div class="faq-answer overflow-hidden transition-all duration-300 ease-out" style="max-height: 0;">
                        <p class="mt-4 text-[#363049]">
                            Our customer support team is available Monday to Saturday, 10:00 AM to 7:00 PM (PKT).
                        </p>
                    </div>
                </div>
                <!-- FAQ Item 3 -->
                <div class="faq-item bg-white rounded-xl shadow-lg p-8 transition duration-300 hover:shadow-2xl">
                    <div class="faq-header flex text-[#1B1139] items-center justify-between cursor-pointer">
                        <h2 class="text-2xl font-bold">What is the Customer Service email?</h2>
                        <span class="toggle-icon text-3xl">+</span>
                    </div>
                    <div class="faq-answer overflow-hidden transition-all duration-300 ease-out" style="max-height: 0;">
                        <p class="mt-4 text-[#363049]">
                            Reach us anytime at support@kingdomdraw.pk. Our team will respond to your queries as soon as
                            possible.
                        </p>
                    </div>
                </div>
                <!-- FAQ Item 4 -->
                <div class="faq-item bg-white rounded-xl shadow-lg p-8 transition duration-300 hover:shadow-2xl">
                    <div class="faq-header flex text-[#1B1139] items-center justify-between cursor-pointer">
                        <h2 class="text-2xl font-bold">In the My Profile section, I see I can take a break or delete my
                            account. How does this work?</h2>
                        <span class="toggle-icon text-3xl">+</span>
                    </div>
                    <div class="faq-answer overflow-hidden transition-all duration-300 ease-out" style="max-height: 0;">
                        <p class="mt-4 text-[#363049]">
                            You can pause or delete your account at any time through your profile settings. During a
                            break, you will not be entered into any draws until you reactivate your account.
                        </p>
                    </div>
                </div>

                <div class="faq-item bg-white rounded-xl shadow-lg p-8 transition duration-300 hover:shadow-2xl">
                    <div class="faq-header flex text-[#1B1139] items-center justify-between cursor-pointer">
                        <h2 class="text-2xl font-bold">Can I still win a prize while I’m on a break?</h2>
                        <span class="toggle-icon text-3xl">+</span>
                    </div>
                    <div class="faq-answer overflow-hidden transition-all duration-300 ease-out" style="max-height: 0;">
                        <p class="mt-4 text-[#363049]">
                            No, When your account is on break, your tickets are not entered into any draws.
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
