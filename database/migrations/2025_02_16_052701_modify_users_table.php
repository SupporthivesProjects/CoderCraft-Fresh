<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('referred_by')->nullable()->after('id');
            $table->string('provider_id', 50)->nullable()->after('referred_by');
            $table->string('user_type', 10)->default('customer')->after('provider_id');
            $table->string('lname', 50)->nullable()->after('name');
            $table->string('avatar', 256)->nullable()->after('remember_token');
            $table->string('avatar_original', 256)->nullable()->after('avatar');
            $table->string('address', 300)->nullable()->after('avatar_original');
            $table->string('addressL2', 150)->nullable()->after('address');
            $table->string('country', 30)->nullable()->after('addressL2');
            $table->string('city', 30)->nullable()->after('country');
            $table->string('postal_code', 20)->nullable()->after('city');
            $table->string('stateProvince', 20)->nullable()->after('postal_code');
            $table->date('dob')->nullable()->after('stateProvince');
            $table->string('phone', 20)->nullable()->after('dob');
            $table->double('balance', 8, 2)->default(0.00)->after('phone');
            $table->string('referral_code')->nullable()->after('balance');
            $table->integer('customer_package_id')->nullable()->after('referral_code');
            $table->integer('remaining_uploads')->default(0)->after('customer_package_id');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'referred_by', 'provider_id', 'user_type', 'lname', 'avatar',
                'avatar_original', 'address', 'addressL2', 'country', 'city',
                'postal_code', 'stateProvince', 'dob', 'phone', 'balance',
                'referral_code', 'customer_package_id', 'remaining_uploads'
            ]);
        });
    }
}
