<dialog id="enquiry-dialog" class="enquiry-dialog" aria-labelledby="enquiry-title" data-lenis-prevent>
    <button class="dialog-close icon-button" type="button" aria-label="Close enquiry"><span class="icon" data-icon="x" aria-hidden="true"></span></button>
    <div class="dialog-inner">
        <p class="eyebrow">Your next chapter</p>
        <h2 id="enquiry-title">Let’s make<br>room for you.</h2>
        <p class="dialog-description">Tell us a little about what you have in mind.</p>
        <form id="enquiry-form">
            <label for="enquiry-service">I’m interested in</label>
            <select id="enquiry-service" name="service">
                <option value="property">Finding a property</option>
                <option value="stay">Booking a stay</option>
                <option value="design">Designing a space</option>
            </select>
            <label for="enquiry-name">Your name</label>
            <input id="enquiry-name" name="name" type="text" autocomplete="name" maxlength="100" required placeholder="How should we address you?">
            <label for="enquiry-message">A few details</label>
            <textarea id="enquiry-message" name="message" rows="3" maxlength="2000" required placeholder="Location, budget, dates, or an idea you’d love to explore…"></textarea>
            <button class="dialog-submit" type="submit"><span data-submit-label>Prepare enquiry</span><span class="icon" data-icon="arrow-up-right" aria-hidden="true"></span></button>
            <p class="enquiry-note" data-enquiry-note>Prepare your enquiry, then copy it to share with GREI.</p>
        </form>
        <div class="enquiry-result" id="enquiry-result" hidden>
            <p class="result-title">Your enquiry is ready.</p>
            <p id="enquiry-preview"></p>
            <button class="dialog-submit" id="copy-enquiry" type="button">Copy enquiry<span class="icon" data-icon="copy" aria-hidden="true"></span></button>
            <button class="text-link edit-enquiry" type="button">Edit details</button>
        </div>
        <p class="enquiry-status" role="status" aria-live="polite"></p>
    </div>
</dialog>
