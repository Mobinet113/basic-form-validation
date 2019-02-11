const $contactForm = $('.contact-form');
let $thisForm;
let entries = [];
let errors = [];

$(document).ready(function () {
  handleSubmit();
});

function handleSubmit() {
  $contactForm.find('input[type="submit"]').on('click', function (e) {
    e.preventDefault();

    errors = []; // Reset the errors
    entries = []; // Reset the entries

    $thisForm = $(this).closest('form');

    getEntry();
    validateForm();
  })
}

function getEntry() {
  $thisForm.find('input:not([type="submit"])').each(function () {

    entries.push({
      name: $(this).attr('name'),
      value: $(this).val(),
      type: $(this).attr('type'),
      required: $(this).attr('required')
    })

  });
}

function validateForm() {

  entries.map(entry => {

    if (entry.required) {

      if (entry.type === 'email') {
        validateEmail(entry.value);
      } else {
        validateText(entry);
      }

    } // END if entry.required

  });

  // If the entry is valid, then submit and show a confirmation message
  if (errors.length === 0) {

    $.ajax({
      method: "POST",
      url: "inc/HandleContactForm.php",
      data: JSON.stringify(entries),
      contentType: "application/json; charset=utf-8",
      dataType: "json"
    })
      .done(function (msg) {
        console.log(msg);
        confirmMessage();
      });

  } else {
    showErrors();
  }
}

function validateEmail(email) {
  const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

  let valid = re.test(String(email).toLowerCase());

  if (!valid) {
    errors.push({
      type: "email",
      name: "email",
      message: "Please provide a valid email address"
    });
  }
  return valid;
}

function validateText(entry) {
  if (entry.value.length > 0) {
    return true;
  }

  errors.push({
    type: "text",
    name: entry.name,
    message: "This field is required"
  });

  return false;
}

function showErrors() {

  // Reset the validations
  $thisForm.find('input').removeClass('is-invalid');

  $thisForm.addClass('was-validated');

  errors.map(error => {
    $(`input[name="${error.name}"]`).addClass('is-invalid');
  });

}

function confirmMessage() {
  $contactForm.find('form').hide();
  $contactForm.find('.confirmation').addClass('active');
}

