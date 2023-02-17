<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateAccess extends AbstractMigration
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
        $table = $this->table('access');

        // title
        $table->addColumn("title", "string", [
            "limit" => 255,
            "null" => false
        ]);

        // middleware
        $table->addColumn("middleware", "string", [
            "null" => false,
            "limit" => 255
        ]);

        // apiroute
        $table->addColumn("apiroute", "string", [
            "null" => false,
            "limit" => 255
        ]);

        // description
        $table->addColumn("description", "string", [
            "limit" => 255,
            "null" => true
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
