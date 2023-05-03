<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateCurrencies extends AbstractMigration
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
        $table = $this->table('currencies');

        // shortname
        $table->addColumn("shortname", "string", [
            "limit" => 255,
            "null" => false
        ]);

        // longname
        $table->addColumn("longname", "string", [
            "limit" => 255,
            "null" => false
        ]);

        // symbol
        $table->addColumn("symbol", "string", [
            "limit" => 255,
            "null" => false
        ]);

        // icon
        $table->addColumn("icon", "string", [
            "limit" => 1000,
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

        $table->addIndex(['shortname', 'longname', 'symbol'], [ 'unique' => true ]);

        $table->create();
    }
}
