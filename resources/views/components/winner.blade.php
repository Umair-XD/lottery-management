<section id="winning-section" class="px-4 sm:px-6 md:px-8 lg:px-14 xl:px-20 py-8 sm:py-12">
    <div class="text-center">
        <h2 class="text-3xl md:text-4xl lg:text-[45px] font-medium text-center">
            Winning Members</h2>
        <!-- Use 4 columns on md and above -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 lg:gap-10 mt-12 lg:mt-16">
            <!-- Panel 1: Grand Prize (span 1) -->
            <div
                class="bg-[#21366F] gap-9 text-white shadow-lg rounded-[30px] p-8 flex flex-col items-center md:col-span-1">
                <h3 class="text-xl sm:text-2xl md:text-[32px] font-normal uppercase">Grand Prize Winner</h3>
                <div id="grandPrizeContainer" class="flex text-4xl font-bold overflow-hidden"></div>
            </div>
            <!-- Panel 2: Middle (span 2) -->
            <div
                class="bg-[#21366F] gap-9 text-white shadow-lg rounded-[30px] p-8 flex flex-col items-center justify-center md:col-span-2">
                <h3 class="text-xl sm:text-2xl md:text-[32px] font-normal uppercase">Meet Our Lucky Winners</h3>
                <img class="rounded-full w-64" src="{{ asset('assets/winners/minion.jpg') }}" alt="">
                <button class="text-[#FDC741] underline text-[32px]">Know More</button>
            </div>
            <!-- Panel 3: Total Winning (span 1) -->
            <div
                class="bg-[#21366F] gap-9 text-white shadow-lg rounded-[30px] p-8 flex flex-col items-center md:col-span-1">
                <h3 class="text-xl sm:text-2xl md:text-[32px] font-normal uppercase">Total Winning & Counting</h3>
                <div id="totalWinningContainer" class="flex text-4xl font-bold overflow-hidden"></div>
            </div>
        </div>
    </div>
    <!-- Your JavaScript code remains unchanged -->
    <script>
        function animateRollingDigits(containerId, formattedNumber) {
            const container = document.getElementById(containerId);
            if (!container) return;
            container.innerHTML = '';

            const cs = window.getComputedStyle(container);
            const fontSize = cs.fontSize;
            const fontFamily = cs.fontFamily;
            const fontWeight = cs.fontWeight;
            const letterSpacing = cs.letterSpacing;

            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            const fontDesc = `${fontWeight} ${fontSize} ${fontFamily}`;
            ctx.font = fontDesc;

            const SLOT_HEIGHT = parseFloat(fontSize);
            const TRANSITION_DURATION_MS = 1000;
            const DELAY_MS = 150;
            const EXTRA_PADDING = 2;

            [...formattedNumber].forEach((ch, idx) => {
                let measuredWidth = ctx.measureText(ch).width;
                const ls = parseFloat(letterSpacing) || 0;
                measuredWidth += ls;
                const charWidth = Math.ceil(measuredWidth) + EXTRA_PADDING;

                const wrapper = document.createElement('div');
                wrapper.style.width = charWidth + 'px';
                wrapper.style.height = SLOT_HEIGHT + 'px';
                wrapper.className = 'overflow-hidden relative flex-shrink-0';

                const inner = document.createElement('div');
                inner.className = 'absolute top-0 left-0';
                inner.style.transition = `transform ${TRANSITION_DURATION_MS}ms ease-out`;

                if (/[0-9]/.test(ch)) {
                    for (let d = 0; d <= 9; d++) {
                        const dv = document.createElement('div');
                        dv.className = 'text-center';
                        dv.style.height = SLOT_HEIGHT + 'px';
                        dv.style.lineHeight = SLOT_HEIGHT + 'px';
                        dv.textContent = d;
                        inner.appendChild(dv);
                    }
                    const target = parseInt(ch, 10);
                    setTimeout(() => {
                        inner.style.transform = `translateY(-${SLOT_HEIGHT * target}px)`;
                    }, 100 + idx * DELAY_MS);
                } else {
                    const dv = document.createElement('div');
                    dv.className = 'text-center';
                    dv.style.height = SLOT_HEIGHT + 'px';
                    dv.style.lineHeight = SLOT_HEIGHT + 'px';
                    dv.textContent = ch;
                    inner.appendChild(dv);
                }

                wrapper.appendChild(inner);
                container.appendChild(wrapper);
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            const section = document.getElementById('winning-section');
            if (!section) return;

            function run() {
                animateRollingDigits('grandPrizeContainer', '{{ number_format($grandPrize ?? 1444444) }}');
                animateRollingDigits('totalWinningContainer', '{{ number_format($totalWinning ?? 2000123) }}');
            }
            if ('IntersectionObserver' in window) {
                new IntersectionObserver((entries, obs) => {
                    entries.forEach(e => {
                        if (e.isIntersecting) {
                            run();
                            obs.unobserve(e.target);
                        }
                    });
                }, {
                    threshold: 0.3
                }).observe(section);
            } else {
                run();
            }
        });
    </script>
</section>
