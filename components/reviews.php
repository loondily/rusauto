<!-- Reviews Component -->
<section class="relative mx-auto max-w-6xl px-4 py-40">
    <div class="mb-20 space-y-4 text-center">
        <h2 class="text-4xl font-bold text-white tracking-tight uppercase italic">Отзывы клиентов</h2>
        <div class="h-1 w-20 bg-cyan-500 mx-auto"></div>
    </div>
    
    <div class="relative group">
        <!-- Navigation Arrows -->
        <button id="review-prev" class="absolute -left-6 top-1/2 z-10 -translate-y-1/2 rounded-full border border-white/10 bg-slate-900/80 px-4 py-3 text-white shadow-2xl backdrop-blur transition hover:bg-white hover:text-slate-950" aria-label="Предыдущий">
            <i class="ri-arrow-left-s-line text-2xl"></i>
        </button>
        <button id="review-next" class="absolute -right-6 top-1/2 z-10 -translate-y-1/2 rounded-full border border-white/10 bg-slate-900/80 px-4 py-3 text-white shadow-2xl backdrop-blur transition hover:bg-white hover:text-slate-950" aria-label="Следующий">
            <i class="ri-arrow-right-s-line text-2xl"></i>
        </button>

        <div class="overflow-hidden">
            <div id="reviews-track" class="flex gap-8 transition-transform duration-500 ease-out">
                <article class="w-full md:w-[calc(33.333%-1.35rem)] shrink-0 rounded-[24px] border border-white/5 bg-white/[0.02] p-10 transition-all duration-300 hover:bg-white/[0.04] hover:border-white/10">
                    <p class="text-base leading-relaxed text-slate-200 mb-12 font-medium">
                        «Всё русифицировали за один день. Меню понятное, навигация и подсказки — на русском. Дилер даже не заметил изменений в системе.»
                    </p>
                    <div class="flex items-center gap-4 border-t border-white/5 pt-8">
                        <div class="h-10 w-10 rounded-full bg-slate-900 flex items-center justify-center font-black text-[11px] text-cyan-500 border border-white/10 tracking-tighter">АК</div>
                        <div class="flex flex-col">
                            <span class="text-[12px] font-bold text-white uppercase tracking-widest">Андрей К.</span>
                            <span class="text-[10px] uppercase tracking-[0.2em] text-slate-500 font-bold">Toyota Camry</span>
                        </div>
                    </div>
                </article>
                
                <article class="w-full md:w-[calc(33.333%-1.35rem)] shrink-0 rounded-[24px] border border-white/5 bg-white/[0.02] p-10 transition-all duration-300 hover:bg-white/[0.04] hover:border-white/10">
                    <p class="text-base leading-relaxed text-slate-200 mb-12 font-medium">
                        «Сделали аккуратно и быстро. Теперь все системные сообщения читаемы. Голосовое управление работает безупречно на русском языке.»
                    </p>
                    <div class="flex items-center gap-4 border-t border-white/5 pt-8">
                        <div class="h-10 w-10 rounded-full bg-slate-900 flex items-center justify-center font-black text-[11px] text-cyan-500 border border-white/10 tracking-tighter">МС</div>
                        <div class="flex flex-col">
                            <span class="text-[12px] font-bold text-white uppercase tracking-widest">Марина С.</span>
                            <span class="text-[10px] uppercase tracking-[0.2em] text-slate-500 font-bold">BMW X5</span>
                        </div>
                    </div>
                </article>
                
                <article class="w-full md:w-[calc(33.333%-1.35rem)] shrink-0 rounded-[24px] border border-white/5 bg-white/[0.02] p-10 transition-all duration-300 hover:bg-white/[0.04] hover:border-white/10">
                    <p class="text-base leading-relaxed text-slate-200 mb-12 font-medium">
                        «Отличная работа. Голосовые подсказки и мультимедиа полностью на русском. Рекомендую всем владельцам современных автомобилей.»
                    </p>
                    <div class="flex items-center gap-4 border-t border-white/5 pt-8">
                        <div class="h-10 w-10 rounded-full bg-slate-900 flex items-center justify-center font-black text-[11px] text-cyan-500 border border-white/10 tracking-tighter">ИП</div>
                        <div class="flex flex-col">
                            <span class="text-[12px] font-bold text-white uppercase tracking-widest">Игорь П.</span>
                            <span class="text-[10px] uppercase tracking-[0.2em] text-slate-500 font-bold">Geely Tugella</span>
                        </div>
                    </div>
                </article>

                <article class="w-full md:w-[calc(33.333%-1.35rem)] shrink-0 rounded-[24px] border border-white/5 bg-white/[0.02] p-10 transition-all duration-300 hover:bg-white/[0.04] hover:border-white/10">
                    <p class="text-base leading-relaxed text-slate-200 mb-12 font-medium">
                        «Профессиональный подход. Русификация выполнена безупречно, навигация работает корректно. Обязательно обращусь снова.»
                    </p>
                    <div class="flex items-center gap-4 border-t border-white/5 pt-8">
                        <div class="h-10 w-10 rounded-full bg-slate-900 flex items-center justify-center font-black text-[11px] text-cyan-500 border border-white/10 tracking-tighter">ВЛ</div>
                        <div class="flex flex-col">
                            <span class="text-[12px] font-bold text-white uppercase tracking-widest">Виктор Л.</span>
                            <span class="text-[10px] uppercase tracking-[0.2em] text-slate-500 font-bold">Lixiang L7</span>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>

<script>
    (function () {
        const track = document.getElementById("reviews-track");
        const prev = document.getElementById("review-prev");
        const next = document.getElementById("review-next");
        if (!track || !prev || !next) return;

        let currentOffset = 0;
        
        function getCardWidth() {
            return track.firstElementChild.offsetWidth + 32; // width + gap
        }
        
        function getMaxOffset() {
            return track.scrollWidth - track.parentElement.offsetWidth;
        }

        next.addEventListener("click", () => {
            const cardWidth = getCardWidth();
            const maxOffset = getMaxOffset();
            if (currentOffset < maxOffset) {
                currentOffset = Math.min(currentOffset + cardWidth, maxOffset);
                track.style.transform = `translateX(-${currentOffset}px)`;
            } else {
                currentOffset = 0;
                track.style.transform = `translateX(0)`;
            }
        });

        prev.addEventListener("click", () => {
            const cardWidth = getCardWidth();
            const maxOffset = getMaxOffset();
            if (currentOffset > 0) {
                currentOffset = Math.max(currentOffset - cardWidth, 0);
                track.style.transform = `translateX(-${currentOffset}px)`;
            } else {
                currentOffset = maxOffset;
                track.style.transform = `translateX(-${currentOffset}px)`;
            }
        });

        window.addEventListener('resize', () => {
            currentOffset = 0;
            track.style.transform = `translateX(0)`;
        });
    })();
</script>