<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         
        \App\Models\EmailTemplate::create([
            'email_type' => 'test-email',
            'title' => 'test-email',
            'subject' => 'test-email',
            'content' => '<p>Hi --userName--,</p>
                <p>This is test email for testing of email<br />
                Regards,<br />
                --companyName--</p>',
        ]);

        
        \App\Models\EmailTemplate::create([
            'email_type' => 'notification-email',
            'title' => 'notification-email',
            'subject' => 'notification-email',
            'content' => '<p>Hi --userName--,</p>
                <p>This is new Notification that mowing and plowing add new featuers</p>
                <h3><strong>--otp--</strong></h3>
                <p><br />
                Regards,<br />
                --companyName--</p>',
        ]);



        \App\Models\EmailTemplate::create([
            'email_type' => 'team-invitation-email',
            'title' => 'team-invitation-email',
            'subject' => 'team-invitation-email',
            'content' => '<p>Hi --userName--,</p>
                <p>You have been invited to the &quot;--companyName--&quot; for the role of &quot;--role--&quot;. Please login at --url-- using these credentials:<br />
                <br />
                Email: --email--<br />
                Password: --password--<br />
                <br />
                Regards,<br />
                --companyName--</p>',
        ]);


        \App\Models\EmailTemplate::create([
            'email_type' => 'forgot-password-email',
            'title' => 'forgot-password-email',
            'subject' => 'forgot-password-email',
            'content' => '<p>Hi --userName--,</p>
                <p>Your password has benn reset please click on blow link for create new password<br />
                <br />
                Link: --link--<br />
                <br />
                Regards,<br />
                --companyName--</p>',
        ]);


        \App\Models\EmailTemplate::create([
            'email_type' => 'account-update-email',
            'title' => 'account-update-email',
            'subject' => 'account-update-email',
            'content' => '<p>Hi --userName--,</p>
                <p>Your account ha been update<br />
                <br />
                Email: --email--<br />
                Password: --password--<br />
                <br />
                Regards,<br />
                --companyName--</p>',
        ]);



        \App\Models\EmailTemplate::create([
            'email_type' => 'invitation-email',
            'title' => 'invitation-email',
            'subject' => 'invitation-email',
            'content' => '<p>Hi --userName--,</p>
                <p>You gave been invited to the "Mowing and Plowing" for role of manager please logi at<br />
                --app_link-- <br /> use these credentials:
                Email: --email-- <br />
                Password: --password-- <br />
                <br />
                Regards,<br />
                --companyName--</p>',
        ]);


        \App\Models\EmailTemplate::create([
            'email_type' => 'verify-email',
            'title' => 'verify-email',
            'subject' => 'verify-email',
            'content' => '<p>Hi --userName--,</p>
                <p>Thank you for joining &quot;--companyName--&quot;. Your account has been created successfully. Please verify your email address by entering this 6 digit code:</p>
                <h3><strong>--otp--</strong></h3>
                <p><br />
                Regards,<br />
                --companyName--</p>',
        ]);


        \App\Models\EmailTemplate::create([
            'email_type' => 'order-placed-email',
            'title' => 'order-placed-email',
            'subject' => 'order-placed-email',
            'content' => '<p>Hi --userName--,</p>
                <p>Your Order has been placed successfully</p>
                date: <h3><strong>--date--</strong></h3>
               Order Id: <h3><strong>--order_id--</strong></h3>
                <p><br />
                Regards,<br />
                --companyName--</p>',
        ]);


        \App\Models\EmailTemplate::create([
            'email_type' => 'invoice-send-email',
            'title' => 'invoice-send-email',
            'subject' => 'invoice-send-email',
            'content' => '<p>Hi --userName--,</p>
                <p>Your Invoice has been send successfully</p>
                date: <h3><strong>--date--</strong></h3>
               Invoice ID: <h3><strong>--invoice_id--</strong></h3>
                <p><br />
                Regards,<br />
                --companyName--</p>',
        ]);


        \App\Models\EmailTemplate::create([
            'email_type' => 'invoice-paid-email',
            'title' => 'invoice-paid-email',
            'subject' => 'invoice-paid-email',
            'content' => '<p>Hi --userName--,</p>
                <p>Your Invoice has been Paid Successfully!</p>
                date: <h3><strong>--date--</strong></h3>
                Invoice ID: <h3><strong>--invoice_idcd --</strong></h3>
                <p><br />
                Regards,<br />
                --companyName--</p>',
        ]);


        \App\Models\EmailTemplate::create([
            'email_type' => 'app_login',
            'title' => 'app_login',
            'subject' => 'app_login',
            'content' => '<p>Hi --userName--,</p>

           <p>You are invited on &quot;--companyName--&quot;. Your account has been created successfully. please click on link &quot;--url--&quot; for login :</p>
            
            Your Email --email--
            
            Password --password--
            <p><br />
            Regards,<br />

         --companyName--</p>',
        ]);
        


        

        \App\Models\SmsTemplate::create([
            'sms_type' => 'account-created',
            'title' => 'account-created',
            'content' => '<p>Hi --userName--,</p>

           <p>You are invited on &quot;--companyName--&quot;. Your account has been created successfully. please click on link &quot;--url--&quot; for login :</p>
            
            Your Email --email--
            Password --password--
            <p><br />
            Regards,<br />

         --companyName--</p>',
        ]);

        \App\Models\SmsTemplate::create([
            'sms_type' => 'login-alert',
            'title' => 'login-alert',
            'content' => '<p>Hi --userName--,</p>

           <p>You have successfully lgin at "Mowing and plowing" at --date--</p>
            <p><br />
            Regards,<br />

         --companyName--</p>',
        ]);



        \App\Models\SmsTemplate::create([
            'sms_type' => 'password-reset',
            'title' => 'password-reset',
            'content' => '<p>Hi --userName--,</p>
            <p>Your password has benn reset please click on blow link for create new password<br />
            <br />
            Link: --link--<br />
            <br />
            Regards,<br />
            --companyName--</p>',
        ]);



        \App\Models\SmsTemplate::create([
            'sms_type' => 'email-verified',
            'title' => 'email-verified',
            'content' => '<p>Hi --userName--,</p>
            <p>Thank you for joining &quot;--companyName--&quot;. Your account has been created successfully. Please verify your email address by entering this 6 digit code:</p>
            <h3><strong>--otp--</strong></h3>
            <p><br />
            Regards,<br />
            --companyName--</p>',
        ]);

     


    }
}
