<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateBranchs extends AbstractMigration
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
        $table = $this->table('branchs');

        // title
        $table->addColumn("name", "string", [
            "limit" => 255,
            "null" => false
        ]);

        // user_id
        $table->addColumn("user_id", "integer", [
            "null" => false
        ]);

        // business_id
        $table->addColumn("busines_id", "integer", [
            "null" => false
        ]);

        // description
        $table->addColumn("description", "string", [
            "limit" => 500,
            "null" => true
        ]);

        // picture
        // $table->addColumn("picture", "string", [
        //     "limit" => 500,
        //     "null" => true,
        // ]);

        // phone
        $table->addColumn("phone", "string", [
            "limit" => 255,
            "null" => true,
        ]);

        // email
        $table->addColumn("email", "string", [
            "limit" => 255,
            "null" => true,
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

        $table->addIndex(['name'], [ 'unique' => true ]);


        $table->create();
    }
}
