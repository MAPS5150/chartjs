<?php
/**
 * @package local_message
 * @author miguel
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

header("Content-Type: application/json");

require_once(__DIR__ . '/../../config.php');
// require_once(__DIR__ . '/../../lib.php');

global $DB;
$array_labels = array();
$array_id = array();
// echo 'Hola';

$messages = $DB->get_records_sql('SELECT * FROM {local_message}'); 
foreach($messages as $message){
    array_push($array_labels, $message->messagetext);
    array_push($array_id, $message->id);
}
$arr_names_labels = array_slice($array_labels, 0, 5);   
$arr_id_word = array_slice($array_id, 0, 5);   
$arr['arr_names_words'] = $arr_names_labels;
$arr['arr_enroll_id'] = $arr_id_word;    
echo json_encode($arr);


