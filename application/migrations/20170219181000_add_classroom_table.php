<?php
defined('BASEPATH') OR exit('No direct script access allowed!');

class Migration_Add_classroom_table extends CI_Migration {

  function up() {
    $this->dbforge->add_field(array(
      'id' => array(
        'type'           => 'INT',
        'constraint'     => 11,
        'unsigned'       => TRUE,
        'auto_increment' => TRUE
      ),
      'name' => array(
        'type' => 'VARCHAR',
        'constraint' => 255
      ),
      'disabled' => array(
        'type' => 'TINYINT',
        'constraint' => 1,
        'default' => 0,
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
    $this->dbforge->create_table('Classroom', TRUE);
    echo '<p>Migration Created : 20170219181000_add_classroom_table</p>';
  }

  function down() {
    $this->dbforge->drop_table('Classroom');
    echo '<p>Migration Dropped : 20170219181000_add_classroom_table</p>';
  }

}