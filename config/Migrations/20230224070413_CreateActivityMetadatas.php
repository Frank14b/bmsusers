<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateActivityMetadatas extends AbstractMigration
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
        $table = $this->table('activity_metadatas');

        // activity_id
        $table->addColumn("activity_id", "integer", [
            "null" => false
        ]);

        // metakey
        $table->addColumn("metakey", "string", [
            "limit" => 255,
            "null" => false
        ]);

        // metavalue
        $table->addColumn("metavalue", "string", [
            "limit" => 1000,
            "null" => false
        ]);

        // extra data
        $table->addColumn("extra", "string", [
            "limit" => 1000,
            "null" => true
        ]);

        // unicity
        $table->addColumn("unicity", "enum", [
            "values" => ["0", "1"], // 0 multiple type key,  1 unique key
            "default" => "1"
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
