<?php
/**
 * Class to handle contact form enquiries
 */


if (isset($_REQUEST)) {
  new HandleContactForm(file_get_contents("php://input"));
}

class HandleContactForm
{

  protected $entries = array();
  private $errors = array(); // Form errors

  public function __construct($entries)
  {
    $this->entries = json_decode($entries, true);
    $this->errors = array();

    if ($this->validateEntry()) {
      // If the form is valid, then do something cool
    }
  }


  private function validateEntry()
  {

    foreach ($this->entries as $entry) {

      if (isset($entry['required'])) {

        // Perform validation types
        switch ($entry['type']) {
          case ('text'):
            $this->validateText($entry['value']);
            break;

          case ('email'):
            $this->validateEmail($entry['value']);
            break;
        }

      }
    }

    // If there are no errors, then continue
    if (sizeof($this->errors) === 0) {
      return true;
    }

    return false;
  }

  /**
   * Validate text by checking if the field has any content
   * @param $text
   * @return bool
   */
  private function validateText($text)
  {

    if (strlen($text) === 0) {
      $this->errors[] = [
        "type" => "text",
        "message" => "This field is required"
      ];

      return false;
    }

    return true;
  }

  /**
   * Validate an email address
   * @param $email
   * @return bool
   */
  private function validateEmail($email)
  {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $this->errors[] = [
        "type" => "email",
        "message" => "Valid email address required"
      ];

      return false;
    }

    return true;
  }


}