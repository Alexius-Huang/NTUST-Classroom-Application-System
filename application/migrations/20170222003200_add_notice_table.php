<?php
defined('BASEPATH') OR exit('No direct script access allowed!');

class Migration_Add_notice_table extends CI_Migration {

  function up() {
    $this->dbforge->add_field(array(
      'id' => array(
        'type'           => 'INT',
        'constraint'     => 11,
        'unsigned'       => TRUE,
        'auto_increment' => TRUE
      ),
      'zh-tw' => array(
        'type' => 'TEXT'
      ),
      'en-us' => array(
        'type' => 'TEXT'
      ),
      'updated_at' => array(
        'type' => 'BIGINT',
        'constraint' => 20,
        'unsigned' => TRUE
      )
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('Notice', TRUE);
    echo '<p>Migration Created : 20170222003200_add_notice_table</p>';
  }

  function down() {
    $this->dbforge->drop_table('Notice');
    echo '<p>Migration Dropped : 20170219153100_add_notice_table</p>';
  }

}