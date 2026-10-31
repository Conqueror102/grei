<header class="site-header" aria-label="GREI navigation">
    <a class="wordmark" href="{{ route('home') }}" aria-label="GREI home">GREI</a>
    <div class="navigation-cluster">
        <nav class="navigation-island" aria-label="Main navigation">
            <a href="{{ request()->routeIs('home') ? '#property' : route('properties.index') }}" data-service-link="property"><span>Find a property</span></a>
            <a href="{{ request()->routeIs('home') ? '#stay' : route('stays.index') }}" data-service-link="stay"><span>Book a stay</span></a>
            <a href="{{ request()->routeIs('home') ? '#design' : route('design') }}" data-service-link="design"><span>Design a space</span></a>
        </nav>
        <button class="icon-button header-contact" type="button" data-enquiry aria-label="Start a conversation with GREI">
            <span class="icon" data-icon="arrow-up-right" aria-hidden="true"></span>
        </button>
    </div>
    <a class="about-link text-link" href="{{ route('about') }}">About<span class="link-line" aria-hidden="true"></span></a>
    <button class="mobile-menu-toggle icon-button" type="button" aria-label="Open navigation" aria-expanded="false" aria-controls="mobile-navigation">
        <span class="icon" data-icon="list" aria-hidden="true"></span>
    </button>
    <nav id="mobile-navigation" class="mobile-navigation" aria-label="Mobile navigation" hidden>
        <a href="{{ route('properties.index') }}" data-service-link="property">Find a property<span class="icon" data-icon="arrow-up-right" aria-hidden="true"></span></a>
        <a href="{{ route('stays.index') }}" data-service-link="stay">Book a stay<span class="icon" data-icon="arrow-up-right" aria-hidden="true"></span></a>
        <a href="{{ route('design') }}" data-service-link="design">Design a space<span class="icon" data-icon="arrow-up-right" aria-hidden="true"></span></a>
        <a href="{{ route('about') }}">About GREI<span class="icon" data-icon="arrow-up-right" aria-hidden="true"></span></a>
        <a href="{{ route('contact') }}">Contact & Viewings<span class="icon" data-icon="arrow-up-right" aria-hidden="true"></span></a>
        <button type="button" data-enquiry>Let’s talk<span class="icon" data-icon="arrow-up-right" aria-hidden="true"></span></button>
    </nav>
</header>
