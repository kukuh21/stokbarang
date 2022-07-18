<?php

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    public function run()
    {
        $administrator = new \App\User;
        $administrator->username = "kukuh";
        $administrator->name = "Kukuh Aprianto";
        $administrator->email = "kaprianto@gmail.com";
        $administrator->roles = json_encode(["ADMIN"]);
        $administrator->password = \Hash::make("123456789");
        $administrator->address = "Tanjung";
        $administrator->phone = '085248036099';
        $administrator->avatar = 'kukuh.jpg';
        $administrator->status = 'ACTIVE';
        $administrator->save();

        $administrator = new \App\User;
        $administrator->username = "haruai";
        $administrator->name = "Haruai";
        $administrator->email = "haruai@gmail.com";
        $administrator->roles = json_encode(["STAFF"]);
        $administrator->password = \Hash::make("123456789");
        $administrator->address = "Tanjung";
        $administrator->phone = '085248036099';
        $administrator->avatar = 'kukuh.jpg';
        $administrator->status = 'ACTIVE';
        $administrator->save();

        $this->command->info('User Admin berhasil di insert');
    }
}
