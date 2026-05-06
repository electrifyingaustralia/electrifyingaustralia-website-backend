<?php

namespace App\Jobs;

use App\Mail\NewCustomerQuotationFormSubmittedMail;
use App\Models\Customer;
use App\Models\CustomerQuotationForm;
use App\Models\SettingOption;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendNewCustomerQuotationEmailJob implements ShouldQueue
{
    use Queueable;

    protected $customer;
    protected $data;

    /**
     * Create a new job instance.
     */
    public function __construct(Customer $customer, CustomerQuotationForm $data)
    {
        $this->customer = $customer;
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $adminEmail = SettingOption::getValue("admin_email", "example@gmail.com");
        $bcc = SettingOption::getValue("admin_bcc", "");
        $cc = SettingOption::getValue("admin_cc", "");

        $mail = Mail::to($adminEmail);

        if ($cc != "") $mail =  $mail->cc(explode(",", $cc));

        if ($bcc != "")  $mail =  $mail->bcc(explode(",", $bcc));

        $mail->send(new NewCustomerQuotationFormSubmittedMail($this->customer, $this->data));
    }
}
