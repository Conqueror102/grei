<footer class="grei-footer">
    <div class="footer-inner">
        <div class="footer-invitation">
            <div>
                <p class="eyebrow">Your next chapter starts here.</p>
                <h2>Let’s make<br>room for <span>you.</span></h2>
                <button class="footer-contact" type="button" data-enquiry>
                    <span>Start a conversation</span>
                    <span class="icon" data-icon="arrow-up-right" aria-hidden="true"></span>
                </button>
            </div>
            <img class="footer-portal" src="{{ asset('assets/metal-portal.webp') }}" width="500" height="500" alt="" loading="lazy">
        </div>
        <div class="footer-links">
            <a href="{{ route('properties.index') }}">Find a property<span class="icon" data-icon="arrow-up-right" aria-hidden="true"></span></a>
            <a href="{{ route('stays.index') }}">Book a stay<span class="icon" data-icon="arrow-up-right" aria-hidden="true"></span></a>
            <a href="{{ route('design') }}">Design a space<span class="icon" data-icon="arrow-up-right" aria-hidden="true"></span></a>
            <a href="{{ route('about') }}">Our point of view<span class="icon" data-icon="arrow-up-right" aria-hidden="true"></span></a>
            <a href="{{ route('contact') }}">Contact & Viewings<span class="icon" data-icon="arrow-up-right" aria-hidden="true"></span></a>
            <a href="{{ route('privacy') }}">Privacy notice<span class="icon" data-icon="arrow-up-right" aria-hidden="true"></span></a>
            <a href="{{ route('terms') }}">Terms<span class="icon" data-icon="arrow-up-right" aria-hidden="true"></span></a>
        </div>
        <div class="footer-wordmark" aria-label="GREI">GREI</div>
        <div class="footer-baseline">
            <span>© 2026 GREI</span>
            <span>Property · Stays · Interiors</span>
            <a href="#top">Back to top<span class="icon" data-icon="arrow-up" aria-hidden="true"></span></a>
        </div>
    </div>
</footer>
