<div class="loader-wrap">
    <span class="loader"></span>
</div>

<button class="scrollToTopBtn">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff"
        class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
    </svg>
</button>

@if(session('success'))
    <style>
        .ko-pop-message { position: fixed; top: 10px; right: 10px; z-index: 999; display: block; background: #fff5ed; padding: 1rem 1.5rem; border: 1px solid #ab8965; border-radius: 5px; }
        .ko-pop-message[data-show="false"] { display: none; }
        .ko-pop-message .ko-pop-close { line-height: 1; position: absolute; right: -8px; top: -8px; background: #fff5ed; border: 1px solid #ab8965; width: 20px; height: 20px; font-size: 15px; display: flex; flex-wrap: wrap; align-items: center; justify-content: center; color: #ab8965; border-radius: 50%; cursor: pointer; }
    </style>

    <div class="ko-pop-message" data-show="true">
        <span class="ko-pop-close">X</span>
        <p>{{ session('message') }}</p>
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let popElm = document.querySelector('.ko-pop-message');
            if(popElm) {
                let closeElm = popElm.querySelector('.ko-pop-close');
                closeElm.addEventListener('click', function() {
                    popElm.dataset.show = "false";
                });

                setTimeout(() => {
                    popElm.dataset.show = "false";
                }, 10000);
            }
        });
    </script>
@endif

<footer class="site-footer">
    {{-- <div class="ko-footer-top">
        <div class="ko-container">
            <div class="ko-footer-row">
                <div class="ko-footer-wiget">
                    <div class="ko-inner-footer-content">
                        <h4>Address</h4>
                        <p>{{ getSetting("admin_address") }}</p>
                    </div>
                </div>
                <div class="ko-footer-wiget">
                    <div class="ko-inner-footer-content">
                        <div class="ko-footer-logo">
                            <img src="{{ publicPath(getSetting("site_logo_light")) }}" alt="footer logo" />
                        </div>
                        <ul class="ko-footer-social">
                            @php
                                $s_media = json_decode(getSetting("site_social_links"));
                            @endphp
                            @if (!empty($s_media))
                                @foreach ($s_media as $index => $media)
                                    <li><a href="{{ $media->link }}" target="_blank"><img
                                                src="{{ publicPath($media->icon) }}"></img></svg></a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="ko-footer-wiget">
                    <div class="ko-inner-footer-content">
                        <h4>Contact Us</h4>
                        <a href="tel:{{ getSetting("admin_phone") }}">T. {{ getSetting("admin_phone") }}</a>
                        <a href="mailto:{{ getSetting("admin_email") }}">M. {{ getSetting("admin_email") }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="ko-copyright">
            <p>{{ getSetting("site_copyright_text") }}</p>
        </div>
    </div>  --}}

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script src="{{ publicPath('assets/js/custom-script.js') }}?version={{ rand(10,99) }}.{{ rand(10,99) }}.{{ rand(100,999) }}"></script>
    {{-- {!!getSetting('page_custom_scrip_footer') !!} --}}
   <script src="{{ asset('assets/js/user-script.js') }}"></script>
</footer>



</body>
</html>