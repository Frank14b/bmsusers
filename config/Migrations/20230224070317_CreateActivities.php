<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateActivities extends AbstractMigration
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
        $table = $this->table('activities');

        // title
        $table->addColumn("name", "string", [
            "limit" => 255,
            "null" => false
        ]);

        // description
        $table->addColumn("description", "string", [
            "limit" => 255,
            "null" => true
        ]);

        // reference
        $table->addColumn("reference", "string", [
            "limit" => 255,
            "null" => true
        ]);

        // activity type_id
        $table->addColumn("activity_type_id", "integer", [
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

        $table->addIndex(['name', 'reference'], [ 'unique' => true ]);

        $table->create();
    }
}
