<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateBusinessPackages extends AbstractMigration
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
        $table = $this->table('business_packages');

        // business_id
        $table->addColumn("busines_id", "integer", [
            "null" => false
        ]);

        // packages_id
        $table->addColumn("package_id", "integer", [
            "null" => false
        ]);

        // user_id
        $table->addColumn("user_id", "integer", [
            "null" => false
        ]);

        // price
        $table->addColumn("price", "integer", [
            "null" => false,
            "default" => 0
        ]);

         // validity
         $table->addColumn("validity", "integer", [
            "null" => false,
            "default" => 1
        ]);

        // period
        $table->addColumn("period", "enum", [
            "values" => ["days", "weeks", "months", "years"],
            "null" => false,
            "default" => "months"
        ]);

        // cloudstorage
        $table->addColumn("cloudstorage", "integer", [
            "null" => false,
            "default" => 5
        ]);

        // cloudunit
        $table->addColumn("cloudunit", "enum", [
            "values" => ["mb", "gb"],
            "null" => false,
            "default" => "gb"
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
