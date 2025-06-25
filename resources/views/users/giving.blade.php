<x-app-layout>
    <section class="giving">
        <div class="Breadcrumb px-24 py-10 border-b-2 uppercase">
            <!-- Breadcrumb Navigation -->
            <nav class="flex items-center space-x-2 text-lg font-medium cursor-pointer">
                <a href="{{ route('users.index') }}" class="hover:underline px-2 uppercase">Home</a>
                <span>/</span>
                <span class="text-[#1083E5] uppercase">Giving Back</span>
            </nav>
            <!-- Main Heading -->
            <h1 class="text-[45px] font-medium text-center uppercase">Giving Back</h1>
        </div>
        <div class="content px-[100px] py-12 flex gap-10">
            <div class="left w-1/2 bg-[#21366F] rounded-[20px]"></div>
            <div class="right w-1/2 flex flex-col space-y-5 font-normal text-xl text-[#3A3A3A]">
                <p>Lorem ipsum dolor sit amet consectetur. Massa in mollis nunc elit viverra sapien tellus commodo
                    volutpat. Laoreet pharetra mauris turpis nec. Nullam velit odio quam placerat. Dignissim tellus
                    pharetra pellentesque aliquet ut egestas. Lorem ipsum dolor sit amet consectetur. Massa in mollis
                    nunc elit viverra sapien tellus commodo volutpat. Laoreet pharetra mauris turpis nec. </p>
                <p>
                    Nullam velit odio quam placerat. Dignissim tellus pharetra pellentesque aliquet ut egestas.Lorem
                    ipsum dolor sit amet consectetur. Massa in mollis nunc elit viverra sapien tellus commodo volutpat.
                    Laoreet pharetra mauris turpis nec.
                </p>
                <p>
                    Nullam velit odio quam placerat. Dignissim tellus pharetra pellentesque aliquet ut egestas.Lorem
                    ipsum dolor sit amet consectetur. Massa in mollis nunc elit viverra sapien tellus commodo volutpat.
                    Laoreet pharetra mauris turpis nec.
                </p>
            </div>
        </div>
    </section>
</x-app-layout>
