<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->enum('role', ['super_admin', 'admin'])->default('admin');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->date('date_of_birth')->nullable(true)->default(null);
            $table->string('sex', 20)->nullable(true)->default(null);
            $table->string('address', 255)->nullable(true)->default(null);
            $table->string('phone', 11)->nullable(true)->default(null);
            $table->boolean('active')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });

        $data = [
            [
                'email'      => 'khaibx.dev@gmail.com',
                'password'   => Hash::make('ad123456'),
                'role'       => 'super_admin',
                'name'       => 'Super Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'email'      => 'khaibx.test@gmail.com',
                'password'   => Hash::make('ad123456'),
                'role'       => 'admin',
                'name'       => 'Khải',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        DB::table('users')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
