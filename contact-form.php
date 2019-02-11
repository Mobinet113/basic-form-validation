<div class="contact-form">
  <form method="POST" action="HandleContactForm.php">
    <div class="form-row">

      <div class="form-group col">
        <label for="first name">First name</label>
        <input type="text" class="form-control" name="first name" placeholder="First name" required>
        <div class="invalid-feedback">
          Please provide your first name.
        </div>
      </div>

      <div class="form-group col">
        <label for="last name">Last name</label>
        <input type="text" class="form-control" name="last name" placeholder="Last name" required>
        <div class="invalid-feedback">
          Please provide your last name.
        </div>
      </div>

    </div>

    <div class="form-row">

      <div class="form-group col">
        <label for="email">Email address</label>
        <input type="email" class="form-control" name="email" placeholder="Email address" required>
        <div class="invalid-feedback">
          Please provide a valid email address.
        </div>
      </div>

    </div>

    <div class="form-row">

      <div class="form-group col">
        <label for="company name">Company name</label>
        <input type="text" class="form-control" name="company name" placeholder="Company name" required>
        <div class="invalid-feedback">
          Please provide your company name.
        </div>
      </div>

    </div>

    <input type="submit" class="button" value="Do the thing">

  </form>

</div>
