<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_classroom_rule_table extends CI_Migration {

  function up() {
    $this->dbforge->add_field(array(
      'id' => array(
        'type'           => 'INT',
        'constraint'     => 11,
        'unsigned'       => TRUE,
        'auto_increment' => TRUE
      ),
      'classroom_id' => array(
        'type' => 'INT',
        'constraint' => 11,
        'unsigned' => TRUE,
      ),
      'type' => array(
        'type' => 'TINYINT',
        'constraint' => 1,
        'unsigned' => TRUE
      ),
      'start' => array(
        'type' => 'DATE',
      ),
      'end' => array(
        'type' => 'DATE',
        'null' => TRUE
      ),
      'weekday' => array(
        'type' => 'TINYINT',
        'constraint' => 3,
        'unsigned' => TRUE,
        'default' => 0
      ),
      'time1' => array(
        'type' => 'TINYINT',
        'constraint' => 1,
        'unsigned' => TRUE
      ),
      'time2' => array(
        'type' => 'TINYINT',
        'constraint' => 1,
        'unsigned' => TRUE
      ),
      'time3' => array(
        'type' => 'TINYINT',
        'constraint' => 1,
        'unsigned' => TRUE
      ),
      'time4' => array(
        'type' => 'TINYINT',
        'constraint' => 1,
        'unsigned' => TRUE
      ),
      'time5' => array(
        'type' => 'TINYINT',
        'constraint' => 1,
        'unsigned' => TRUE
      ),
      'time6' => array(
        'type' => 'TINYINT',
        'constraint' => 1,
        'unsigned' => TRUE
      ),
      'time7' => array(
        'type' => 'TINYINT',
        'constraint' => 1,
        'unsigned' => TRUE
      ),
      'time8' => array(
        'type' => 'TINYINT',
        'constraint' => 1,
        'unsigned' => TRUE
      ),
      'time9' => array(
        'type' => 'TINYINT',
        'constraint' => 1,
        'unsigned' => TRUE
      ),
      'time10' => array(
        'type' => 'TINYINT',
        'constraint' => 1,
        'unsigned' => TRUE
      ),
      'timeA' => array(
        'type' => 'TINYINT',
        'constraint' => 1,
        'unsigned' => TRUE
      ),
      'timeB' => array(
        'type' => 'TINYINT',
        'constraint' => 1,
        'unsigned' => TRUE
      ),
      'timeC' => array(
        'type' => 'TINYINT',
        'constraint' => 1,
        'unsigned' => TRUE
      ),
      'timeD' => array(
        'type' => 'TINYINT',
        'constraint' => 1,
        'unsigned' => TRUE
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
    $this->dbforge->create_table('ClassroomRule', TRUE);
    echo '<p>Migration Created : 20170220203000_add_classroom_rule_table</p>';
  }

  function down() {
    $this->dbforge->drop_table('ClassroomRule');
    echo '<p>Migration Dropped : 20170220203000_add_classroom_rule_table</p>';
  }

}