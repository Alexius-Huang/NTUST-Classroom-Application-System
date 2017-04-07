<?php
defined('BASEPATH') OR exit('No direct script access allowed!');

class Migration_Add_device_table extends CI_Migration {

  function up() {
    $this->dbforge->add_field(array(
      'id' => array(
        'type'           => 'INT',
        'constraint'     => 11,
        'unsigned'       => TRUE,
        'auto_increment' => TRUE
      ),
      'name_zh-TW' => array(
        'type'           => 'VARCHAR',
        'constraint'     => 255
      ),
      'name_en-us' => array(
        'type'           => 'VARCHAR',
        'constraint'     => 255
      ),
      'total_count' => array(
        'type'           => 'INT',
        'constraint'     => 255,
        'unsigned'       => TRUE,
        'default'        => 1
      ),
      'max_lease_count' => array(
        'type'           => 'INT',
        'constraint'     => 255,
        'unsigned'       => TRUE,
        'default'        => 1
      ),
      'disabled' => array(
        'type'           => 'INT',
        'constraint'     => 1,
        'unsigned'       => TRUE,
        'default'        => 0
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
    $this->dbforge->create_table('Device', TRUE);
    echo '<p>Migration Created : 20170407213300_add_device_table</p>';
  }

  function down() {
    $this->dbforge->drop_table('Device');
    echo '<p>Migration Dropped : 20170407213300_add_device_table</p>';
  }

}