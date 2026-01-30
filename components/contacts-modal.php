<div id="contacts-modal"
     class="fixed inset-0 z-[99999] flex items-center justify-center p-5 opacity-80 invisible pointer-events-none transition-[opacity,visibility] duration-200 group [&.modal-open]:opacity-100 [&.modal-open]:visible [&.modal-open]:pointer-events-auto"
     aria-hidden="true"
     role="dialog"
     aria-labelledby="contacts-modal-title"
     aria-modal="true">

    <div id="contacts-modal-backdrop"
         class="absolute inset-0 bg-slate-950/80 backdrop-blur-sm"
         data-close></div>

    <div id="contacts-modal-panel"
         class="relative z-10 w-full max-w-sm rounded-2xl transition-transform duration-300 ease-out translate-y-3 scale-95 group-[.modal-open]:translate-y-0 group-[.modal-open]:scale-100"
         style="box-shadow: 0 25px 50px -12px rgba(0,0,0,0.6), 0 0 0 1px rgba(255,255,255,0.06), 0 0 80px -10px rgba(34,211,238,0.35);">
        <div class="rounded-2xl border border-white/10 bg-slate-900/95 ring-1 ring-white/5 overflow-hidden">
            <div class="h-1 w-full bg-gradient-to-r from-cyan-500/80 to-cyan-400/50"></div>
            <div class="p-6 pt-5 pb-8">
                <div class="flex items-start justify-between gap-4 mb-5">
                    <h2 id="contacts-modal-title" class="text-xl font-bold text-slate-400 uppercase tracking-widest">
                        Контакты
                    </h2>
                    <button type="button"
                            data-close
                            class="shrink-0 p-1.5 rounded-lg text-slate-500 hover:text-white hover:bg-white/10 transition-colors"
                            aria-label="Закрыть">
                        <i class="ri-close-line text-xl"></i>
                    </button>
                </div>

                <div class="space-y-5">
                    <div>
                        <a href="tel:+79230000000" class="text-lg font-bold text-white hover:text-cyan-400 transition-colors">
                            +7 (923) 000-00-00
                        </a>
                        <p class="text-xs text-slate-500 mt-0.5">Ежедневно с 10:00 до 20:00</p>
                    </div>

                    <div class="flex gap-3 text-slate-400">
                        <i class="ri-map-pin-line text-cyan-500 text-base shrink-0 mt-0.5"></i>
                        <p class="text-sm leading-relaxed text-slate-300">
                            г. Кемерово,<br/>
                            ул. Примерная, 12, бокс 4
                        </p>
                    </div>

                    <div class="flex gap-2 pt-1">
                        <a href="#" class="flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-2 text-xs font-bold uppercase tracking-wider text-slate-300 hover:border-cyan-500/40 hover:text-cyan-400 transition-colors">
                            <i class="ri-whatsapp-line"></i>
                            WhatsApp
                        </a>
                        <a href="#" class="flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-2 text-xs font-bold uppercase tracking-wider text-slate-300 hover:border-cyan-500/40 hover:text-cyan-400 transition-colors">
                            <i class="ri-telegram-line"></i>
                            Telegram
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>