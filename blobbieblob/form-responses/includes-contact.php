<!-- This file includes the creation code for the contact form
to be used when users find their way on the page without filling
out the form -->

<div class="container-fluid">
    <div class="row col-12">
        <header>
            <h1>Contact Us</h1>
        </header>
    </div>
</div>

<!-- Contact Form -->
<div class="row justify-content-center">
    <form class="form-container pt-0 col-lg-5 col-md-8 col-sm-10 col-10"
          id="contact-form" action="../form-responses/contact-form.php" method="POST"
          onsubmit="return validateContactForm()">
        <!-- Name -->
        <section class="form-group">
            <label for="name">Name* </label><span class="text-danger" id="name-error"></span>
            <input type="text" class="form-control" id="name" name="name" maxlength="100" minlength="1"
                   aria-describedby="nameHelp" placeholder="Enter name" required>
            <small id="nameHelp" class="form-text text-muted"></small>
        </section>
        <!-- Email -->
        <section class="form-group">
            <label for="email">Email address*</label><span class="text-danger" id="email-error"></span>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                   placeholder="Enter email" required>
            <small id="emailHelp" class="form-text text-muted"></small>
        </section>
        <!-- Message -->
        <section class = form-group>
            <label for = "subject">Subject</label>
            <input type = "text" class = "form-control" id = "subject" name = "subject"
                   placeholder = "Optional email title">
            <small id="subjectHelp" class="form-text text-muted"></small>
            <br />
        </section>
        <section class="form-group">
            <label for="message">Message*</label><span class="text-danger" id="message-error"></span>
            <textarea type="textbox" class="form-control" id="message" name="message" rows="5"
                      aria-describedby="emailHelp" placeholder="Enter Message" required></textarea>
            <small id="emailHelp" class="form-text text-muted"></small><br />
        </section>
        <!-- Submit Button -->
        <section class="form-group text-left">
            <input id="submit-button" type="submit" class="btn btn-primary" value="Send"></input>
        </section>
    </form>
</div>
