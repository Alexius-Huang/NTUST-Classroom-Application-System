<?php defined('BASEPATH') OR exit('No direct script access allowed!');

class Migration_Add_device_log_table extends CI_Migration {

  function up() {
    $this->dbforge->add_field(array(
      'id' => array(
        'type'           => 'INT',
        'constraint'     => 11,
        'unsigned'       => TRUE,
        'auto_increment' => TRUE
      ),
      'device_apply_id' => array(
        'type'           => 'INT',
        'constraint'     => 11,
        'unsigned'       => TRUE
      ),
      'device_id' => array(
        'type'           => 'INT',
        'constraint'     => 11,
        'unsigned'       => TRUE
      ),
      'lease_count' => array(
        'type'           => 'INT',
        'constraint'     => 11,
        'unsigned'       => TRUE
      )
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('DeviceLog', TRUE);
    echo '<p>Migration Created : 20170411211700_add_device_log_table</p>';
  }

  function down() {
    $this->dbforge->drop_table('DeviceLog');
    echo '<p>Migration Dropped : 20170411211700_add_device_log_table</p>';
  }

}