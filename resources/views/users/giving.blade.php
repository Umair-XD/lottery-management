<x-app-layout>
    <section class="giving">
        <div class="Breadcrumb px-4 sm:px-8 md:px-16 lg:px-20 xl:px-24 py-6 sm:py-8 md:py-10 border-b-2 uppercase">
            <!-- Breadcrumb Navigation -->
            <nav
                class="flex flex-wrap items-center space-x-2 text-xs sm:text-sm md:text-base font-medium cursor-pointer">
                <a href="{{ route('users.index') }}" class="hover:underline px-1 sm:px-2">Home</a>
                <span>/</span>
                <span class="text-[#1083E5]">Giving Back</span>
            </nav>
            <!-- Main Heading -->
            <h1 class="text-xl sm:text-3xl md:text-[45px] font-medium text-center mt-3">
                Giving Back
            </h1>
        </div>

        <div id="content"
            class=" content relative after:content-[''] after:block after:clear-both px-4 sm:px-6 md:px-10 lg:px-[80px] xl:px-[100px] py-8 sm:py-10 md:py-12 text-[#3A3A3A] text-base sm:text-lg md:text-xl leading-relaxed">

            <div
                class="float-left w-full sm:w-[500px] md:w-[550px] lg:w-[600px] aspect-[7/6] bg-[#21366F] rounded-[20px] mr-6 mb-4 overflow-hidden">
                <!-- <img src="/image.jpg" alt="" class="w-full h-full object-cover" /> -->
            </div>

            <p>
                At Kingdoms Draw, we believe that true success isn’t just about winning big prizes it’s also about
                spreading hope and creating real change in people’s lives. That’s why we’ve launched our Hope Fund
                Programme, a long-term initiative to give back to the people of Pakistan. A portion of every ticket you
                buy goes directly into supporting causes that matter, like improving education for children, providing
                clean drinking water in villages, and helping families earn a better living through skill-building and
                job opportunities. We understand that many communities in our country are struggling with basic needs,
                and through this programme, we want to be a small part of the solution. Every contribution, no matter
                how small, helps us reach more people and do more good. We see Kingdoms Draw as more than just a draw
                it’s a movement of care, hope, and giving.
            </p>
            <p class="mt-4">
                We want you, our participants, to know that your ticket is more than just a chance to win it’s also a
                chance to help. While one lucky winner walks away with a prize, thousands of others benefit through your
                support of our social work. Together, we are building a platform that doesn’t just reward individuals,
                but lifts entire communities. We believe that real progress comes when success is shared, and that’s
                exactly what we’re working towards. Whether it’s helping a child go to school, bringing clean water to a
                village, or training someone for a better future, your participation helps make it happen.
        </div>
    </section>
</x-app-layout>
