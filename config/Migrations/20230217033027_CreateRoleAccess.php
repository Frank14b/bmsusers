<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateRoleAccess extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('roleaccess');

        // role_id
        $table->addColumn("role_id", "integer", [
            "null" => false
        ]);

        // acces_id
        $table->addColumn("acces_id", "integer", [
            "null" => false
        ]);

        // status
        $table->addColumn("status", "enum", [
            "values" => ["0", "1"], // 0 disable, 1 enable
            "default" => "1"
        ]);

        // created_at
        $table->addColumn("created_at", "timestamp", [
            "default" => 'CURRENT_TIMESTAMP'
        ]);

        // updated_at
        $table->addColumn("updated_at", "timestamp", [
            "default" => 'CURRENT_TIMESTAMP'
        ]);

        $table->create();
    }
}
