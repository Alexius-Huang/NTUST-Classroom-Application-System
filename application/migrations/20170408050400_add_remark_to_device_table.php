<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_remark_to_device_table extends CI_Migration {

  function up() {
    $fields = array(
      'remark' => array(
        'type' => 'VARCHAR',
        'constraint' => '255',
        'null' => TRUE,
        'default' => NULL,
        'after' => 'max_lease_count'
      )
    );

    $this->dbforge->add_column('Device', $fields);
    echo '<p>Migration Created : 20170408050400_add_remark_to_device_table</p>';
  }

  function down() {
    $this->dbforge->drop_column('Device', 'remark');
    echo '<p>Migration Dropped : 20170408050400_add_remark_to_device_table</p>';
  }

}