<?php

namespace Database\Seeders;

use App\Models\ProviderDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stripe = new \Stripe\StripeClient(config('stripe.TEST_SECRET_KEY'));

        // Customer 1
        $customer = $stripe->customers->create([
            'name' => 'John Customer',
            'email' => 'customer@example.com',
        ]);

        $user1 = \App\Models\User::create([
            'first_name' => 'John',
            'last_name' => 'Customer',
            'email' => 'customer@example.com',
            'password' => Hash::make('123456'),
            'phone_number' => '+923225542270',
            'type' => 'customer',
            'lat' => '40.730610',
            'lng' => '-73.935242',
            'last_login_device' => 'web',
            'status' => '1',
            'customer_id' => $customer->id ?? null,
            'referral_link' => "/referral-link/". Str::random(16),
            'phone_number_verified_at' => now(),
            'email_verified_at' => now(),
        ]);

        \App\Models\Wallet::create(['user_id' => $user1->id]);

        // Customer 2
        $customer = $stripe->customers->create([
            'name' => 'Doe Customer',
            'email' => 'customer1@example.com',
        ]);

        $user2 = \App\Models\User::create([
            'first_name' => 'Doe',
            'last_name' => 'Customer',
            'email' => 'customer1@example.com',
            'password' => Hash::make('123456'),
            'phone_number' => '+923225542272',
            'type' => 'customer',
            'lat' => '40.730610',
            'lng' => '-73.935242',
            'last_login_device' => 'web',
            'status' => '1',
            'customer_id' => $customer->id ?? null,
            'referral_link' => "/referral-link/". Str::random(16),
            'phone_number_verified_at' => now(),
            'email_verified_at' => now(),
        ]);

        \App\Models\Wallet::create(['user_id' => $user2->id]);

        $provider1 = \App\Models\User::create([
            'first_name' => 'John',
            'last_name' => 'Provider',
            'email' => 'provider1@example.com',
            'password' => Hash::make('123456'),
            'phone_number' => '+923225542273',
            'lat' => '40.730610',
            'lng' => '-73.935242',
            'type' => 'provider',
            'lat' => '37.730610',
            'lng' => '-17.935242',
            'last_login_device' => 'mobile',
            'status' => '1',
            'phone_number_verified_at' => now(),
            'email_verified_at' => now(),
        ]);

        ProviderDetail::create([
            'provider_id' => $provider1->id,
            'last_known_lat' => '40.730610',
            'last_known_lng' => '-73.935242',
            'industry_type' => 1,
        ]);

        $provider2 = \App\Models\User::create([
            'first_name' => 'Walter',
            'last_name' => 'Provider',
            'email' => 'provider2@example.com',
            'password' => Hash::make('123456'),
            'phone_number' => '+923225542274',
            'lat' => '40.730610',
            'lng' => '-73.935242',
            'type' => 'provider',
            'lat' => '37.730610',
            'lng' => '-17.935242',
            'last_login_device' => 'mobile',
            'status' => '1',
            'phone_number_verified_at' => now(),
            'email_verified_at' => now(),
        ]);

        ProviderDetail::create([
            'provider_id' => $provider2->id,
            'last_known_lat' => '40.730610',
            'last_known_lng' => '-73.935242',
            'industry_type' => 1,
        ]);

        $provider3 = \App\Models\User::create([
            'first_name' => 'Mark',
            'last_name' => 'Provider',
            'email' => 'provider3@example.com',
            'password' => Hash::make('123456'),
            'phone_number' => '+923225542275',
            'lat' => '40.730610',
            'lng' => '-73.935242',
            'type' => 'provider',
            'lat' => '37.730610',
            'lng' => '-17.935242',
            'last_login_device' => 'mobile',
            'status' => '1',
            'phone_number_verified_at' => now(),
            'email_verified_at' => now(),
        ]);

        ProviderDetail::create([
            'provider_id' => $provider3->id,
            'last_known_lat' => '40.730610',
            'last_known_lng' => '-73.935242',
            'industry_type' => 2,
        ]);

        $provider4 = \App\Models\User::create([
            'first_name' => 'Walliam',
            'last_name' => 'Provider',
            'email' => 'provider4@example.com',
            'password' => Hash::make('123456'),
            'phone_number' => '+923225542276',
            'lat' => '40.730610',
            'lng' => '-73.935242',
            'type' => 'provider',
            'lat' => '37.730610',
            'lng' => '-17.935242',
            'last_login_device' => 'mobile',
            'status' => '1',
            'phone_number_verified_at' => now(),
            'email_verified_at' => now(),
        ]);

        ProviderDetail::create([
            'provider_id' => $provider4->id,
            'last_known_lat' => '40.730610',
            'last_known_lng' => '-73.935242',
            'industry_type' => 3,
        ]);

        \App\Models\FavoriteProvider::create(['user_id' => $user1->id, 'provider_id' => $provider1->id]);
    }
}
