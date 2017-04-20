<?php defined('BASEPATH') OR exit('No direct script access allowed!');

class Migration_Add_device_apply_table extends CI_Migration {

  function up() {
    $this->dbforge->add_field(array(
      'id' => array(
        'type'           => 'INT',
        'constraint'     => 11,
        'unsigned'       => TRUE,
        'auto_increment' => TRUE
      ),
      'student_id' => array(
        'type' => 'VARCHAR',
        'constraint' => 16
      ),
      'status' => array(
        'type' => 'TINYINT',
        'constraint' => 1,
        'unsigned' => TRUE,
        'default' => '0'
      ),
      'date' => array(
        'type' => 'DATE'
      ),
      'organization' => array(
        'type' => 'TEXT',
      ),
      'applicant' => array(
        'type' => 'TEXT'
      ),
      'applicantPosition' => array(
        'type' => 'TEXT'
      ),
      'phone' => array(
        'type' => 'TEXT'
      ),
      'purpose' => array(
        'type' => 'TEXT'
      ),
      'ip' => array(
        'type' => 'TEXT'
      ),
      'created_at' => array(
        'type' => 'BIGINT',
        'constraint' => 20,
        'unsigned' => TRUE
      ),
      'updated_at' => array(
        'type' => 'BIGINT',
        'constraint' => 20,
        'unsigned' => TRUE
      )
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('DeviceApply', TRUE);
    echo '<p>Migration Created : 20170411211200_add_device_apply_table</p>';
  }

  function down() {
    $this->dbforge->drop_table('DeviceApply');
    echo '<p>Migration Dropped : 20170411211200_add_device_apply_table</p>';
  }

}