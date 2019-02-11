<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div class="container">

  <h1>Basic Form Validation</h1>

  <div class="contact-form">
    <form method="POST" action="inc/HandleContactForm.php">
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
          <input type="text" class="form-control" name="company name" placeholder="Company name">
          <div class="invalid-feedback">
            Please provide your company name.
          </div>
        </div>

      </div>

      <input type="submit" class="btn btn-primary fluid btn-block" value="Do the thing">

    </form>

  </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="js/HandleContactForm.js" type="text/javascript"></script>