<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
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
        $table = $this->table('users');

        // name
        $table->addColumn("firstname", "string", [
            "limit" => 255,
            "null" => false
        ]);

        // name
        $table->addColumn("lastname", "string", [
            "limit" => 255,
            "null" => true
        ]);

        // name
        $table->addColumn("username", "string", [
            "limit" => 255,
            "null" => false,
        ]);

        // email
        $table->addColumn("email", "string", [
            "limit" => 255,
            "null" => false,
        ]);

        // password
        $table->addColumn("password", "string", [
            "limit" => 255,
            "null" => false,
        ]);

        // picture
        $table->addColumn("picture", "string", [
            "limit" => 255,
            "null" => true,
        ]);

        // status
        $table->addColumn("status", "enum", [
            "values" => ["0", "1", "2"], // 0 disable, 1 enable, 2 delete
            "default" => "1"
        ]);

        // super user role
        $table->addColumn("role", "enum", [
            "values" => ["1", "2"], // 1 super-user, 2 user
            "default" => "2"
        ]);

        // created_at
        $table->addColumn("created_at", "timestamp", [
            "default" => 'CURRENT_TIMESTAMP'
        ]);

        // updated_at
        $table->addColumn("updated_at", "timestamp", [
            "default" => 'CURRENT_TIMESTAMP'
        ]);

        $table->addIndex(['username', 'email'], [ 'unique' => true ]);

        $table->create();
    }
}
