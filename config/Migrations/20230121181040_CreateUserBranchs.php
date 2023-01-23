<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUserBranchs extends AbstractMigration
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
        $table = $this->table('user_branchs');

        // branch_id
        $table->addColumn("branch_id", "integer", [
            "null" => false
        ]);

        // user_id
        $table->addColumn("user_id", "integer", [
            "null" => false
        ]);

        // role_id
        $table->addColumn("role_id", "integer", [
            "null" => false
        ]);

        // status
        $table->addColumn("status", "enum", [
            "values" => ["0", "1", "2"], // 0 disable, 1 enable, 2 delete
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
