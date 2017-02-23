<?php defined('BASEPATH') OR exit('No direct script access allowed!');

class Migration_Add_apply_table extends CI_Migration {

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
        'unsigned' => TRUE
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
      'phone' => array(
        'type' => 'TEXT'
      ),
      'participantCount' => array(
        'type' => 'INT',
        'constraint' => 11,
        'unsigned' => TRUE,
        'default' => 0
      ),
      'purpose' => array(
        'type' => 'TEXT'
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
    $this->dbforge->create_table('Apply', TRUE);
    echo '<p>Migration Created : 20170223101400_add_apply_table</p>';
  }

  function down() {
    $this->dbforge->drop_table('Apply');
    echo '<p>Migration Dropped : 20170223101400_add_apply_table</p>';
  }

}