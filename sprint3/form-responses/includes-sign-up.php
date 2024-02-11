<!-- This file includes the creation code for the sign up form
to be used when users find their way on the page without filling
out the form -->
<div class="container-fluid">
        <div class="row col-12">
            <header>
                <h1>Sign Up</h1>
            </header>
        </div>
    </div>

    <div class = "row justify-content-center">
        <form class = "form-container pt-0 col-lg-4 col-md-8 col-sm-12 col-12"
        id="signUp" method="POST" action="../form-responses/sign-up-form.php">


            <!-- Name -->
            <div class="form-group">
                <label for="name">Name*</label>
                <input type="text" class="form-control" id="name" name="name" maxlength="100" minlength="1"
                       aria-describedby="nameHelp" placeholder="Enter name" required>
                <small id="nameHelp" class="form-text text-muted"></small>
            </div>

            <!-- Email -->
        <section class="form-group">
            <label for="email">Email address*</label><span class="text-danger" id="email-error"></span>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                   placeholder="Enter email" required>
            <small id="emailHelp" class="form-text text-muted"></small>
        </section>

            <!-- Cohort Number -->
            <section class="form-group">
                <label for="cohortNumber">Cohort Number*</label>
                <input type="number" id="cohortNumber" name="cohortNumber" required>

            </section>

            <!-- Check Boxes -->
            <section class="form-group">
                <label></label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="seekingInternship" name="seekingInternship"
                        value="Seeking Internship">
                    <label class="form-check-label" for="seekingInternship">Seeking Internship</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="seekingJob" name="seekingInternship"
                        value="Seeking Job">
                    <label class="form-check-label" for="seekingJob">Seeking Job</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="notActivelySearching" name="seekingInternship"
                        value="Not Actively Searching">
                    <label class="form-check-label" for="notActivelySearching">Not Actively Searching</label>
                </div>
            </section>

            <!-- Text -->
            <div class="row">
                <label for="seekingRoles">What types of roles are you seeking?*</label>
                <textarea class="form-control" name="seekingRoles" id="seekingRoles" rows="4" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
