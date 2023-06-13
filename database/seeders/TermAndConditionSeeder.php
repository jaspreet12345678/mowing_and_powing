<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermAndConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\TermAndCondition::create([
            'description' => '<p>These client terms of service ("the client terms") describe your rights and responsibilities when using our online client portal or other platforms (the "services").
            If you area client or an authorized user (defined below), these client terms govern your access and use of the services.
            "Client" is the organization that you represent in agreeing to the contract (e.g. your employer). These client terms form a building "contract" between client and us.
             If you personally use our services, you acknowledge your understanding of the contract and agree to the contract on behalf of client.</p>'
        ]);
    }
}
