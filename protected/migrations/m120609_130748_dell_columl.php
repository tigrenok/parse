<?php

class m120609_130748_dell_columl extends CDbMigration {

  public function safeUp() {
    $this->dropColumn('{{post_site}}', 'rpc_script');
    $this->dropTable('{{upload}}');
    $this->dropTable('{{upload_type}}');
  }
}