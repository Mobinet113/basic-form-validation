<?php
/**
 * Class to handle contact form enquiries
 */

require_once('../config.php');
require('../vendor/autoload.php');

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
      $this->sendNotifications();
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

  private function sendNotifications()
  {
    $email = new \SendGrid\Mail\Mail();
    $email->setFrom("notifications@niikiis.com", "niikiis landing page");
    $email->setSubject("New submission from the contact form");

    // Define the recipients
    foreach( NOTIFICATION_EMAIL as $notifAddress ) {
      $email->addTo($notifAddress, "Admin");
    }

    $email->addContent("text/plain", "and easy to do anywhere, even with PHP");

    $email->addContent(
      "text/html", "

        <table>
          <tr>
            <td style='text-align: center;'>
              <img src='https://www.nowcomms.com/wp-content/uploads/2019/01/logo-niikiis.png' alt='niikiis logo' width='75' />
            </td>
          </tr>
          
          <h1>
            New submission from the contact form<br />
            <small>Here are their details...</small>
          </h1>" . $this->renderEmailTable() .
      "</table>"
    );


    $sendgrid = new \SendGrid(SENDGRID_API_KEY);

    try {
      $response = $sendgrid->send($email);
      print $response->statusCode() . "\n";
      print $response->body() . "\n";
    } catch (Exception $e) {
      echo 'Caught exception: ' . $e->getMessage() . "\n";
    }
  }

  private function renderEmailTable()
  {

    $html = "<table>";

    foreach ($this->entries as $entry) {
      $html .= "<tr><td><strong>" . strtoupper($entry['name']) . "</strong></td><td>" . $entry['value'] . "</td></tr>";
    }

    $html .= "</table>";

    return $html;

  }

}