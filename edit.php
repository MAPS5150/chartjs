<?php
/**
 * @package local_message
 * @author miguel
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// echo 'Hola';
require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . '/local/message/classes/form/edit.php');

global $DB;

$PAGE->set_url(new moodle_url('/local/message/edit.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Editar');

// queremos mostrar el form(formulario)
$mform = new edit();

if ($mform->is_cancelled()) {
    // go back to manage page
    redirect('/moodle/local/message/manage.php', 'Cancelaste el formulario de mensaje');

} else if ($fromform = $mform->get_data()) {
  // var_dump($fromform);
  // die;

  $recordtoinsert = new stdClass();
  $recordtoinsert->messagetext = $fromform->messagetext;
  $recordtoinsert->messagetype = $fromform->messagetype;

  // se inserta la información del formulario en la tabla local_message
  $DB->insert_record('local_message', $recordtoinsert);

  // se redirecciona a la pagina de manage.php
  redirect($CFG->wwwroot . '/local/message/manage.php', 'Creaste un nuevo mensaje con el título ' . $fromform->messagetext);
}
echo $OUTPUT->header();
$mform->display();
echo $OUTPUT->footer();