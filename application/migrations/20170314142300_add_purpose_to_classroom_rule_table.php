<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_purpose_to_classroom_rule_table extends CI_Migration {

  function up() {
    $fields = array(
      'purpose' => array(
        'type' => 'TEXT',
        'null' => TRUE,
        'after' => 'type'
      )
    );

    $this->dbforge->add_column('ClassroomRule', $fields);
    echo '<p>Migration Created : 20170314142300_add_purpose_to_classroom_rule_table</p>';
  }

  function down() {
    $this->dbforge->drop_column('ClassroomRule', 'applicantPosition');
    echo '<p>Migration Dropped : 20170314142300_add_purpose_to_classroom_rule_table</p>';
  }

}