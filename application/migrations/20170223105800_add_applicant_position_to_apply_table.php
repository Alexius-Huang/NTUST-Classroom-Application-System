<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_applicant_position_to_apply_table extends CI_Migration {

  function up() {
    $fields = array(
      'applicantPosition' => array(
        'type' => 'VARCHAR',
        'constraint' => 32,
        'after' => 'applicant'
      )
    );

    $this->dbforge->add_column('Apply', $fields);
    echo '<p>Migration Created : 20170223105800_add_applicant_position_to_apply_table</p>';
  }

  function down() {
    $this->dbforge->drop_column('Apply', 'applicantPosition');
    echo '<p>Migration Dropped : 20170223105800_add_applicant_position_to_apply_table</p>';
  }

}