<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FAQsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Faq::create([
            'question' => 'How Mowing and Plowing Cash works?',
            'answer' => '<p>M&amp;P Cash is an additional payment method you can add to your account.<br />
            You can check your balance through the payment tab in the Mowing and<br />
            Plowing app.</p>',
        ]);

        \App\Models\Faq::create([
            'question' => 'How it works?',
            'answer' => '<p>You can set M&amp;P cash as your default payment method, or use it on a per<br />
            service basis. Just load money into your wallet and it will be available for<br />
            immediate use.</p>

            Default Payment Method ?

            <p>Once you add cash to your M&amp;P account, lift cash will be set as your default<br />
            payment method.<br />
            If your M&amp;P Cash does not cover the total charges of a service, we&#39;ll charge<br />
            your default payment method instead.</p>',
        ]);

        \App\Models\Faq::create([
            'question' => 'Auto refills',
            'answer' => '<p>You can set up auto refill to refill your M&amp;P Cash balance when it falls below<br />
            the certain amount.&nbsp;</p>

            <p>To turn Auto Refills on or off:</p>

            <p>1. &nbsp;Tap &quot;Payment&quot; in the app&#39;s menu</p>

            <p>2. &nbsp;Tap &quot;Auto Refill&quot; under M&amp;P Cash</p>',
        ]);

        \App\Models\Faq::create([
            'question' => 'M&P cash did not apply to services',
            'answer' => '<p>M&amp;P Cash is an additional payment method you can add to your account.<br />
            You can check your balance through the payment tab in the Mowing and<br />
            Plowing app.</p>',
        ]);
    }
}
