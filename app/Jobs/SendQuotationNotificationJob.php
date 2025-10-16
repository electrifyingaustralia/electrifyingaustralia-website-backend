<?php

namespace App\Jobs;

use App\Mail\QuotationSubmittedMail;
use App\Models\Customer;
use App\Models\SettingOption;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendQuotationNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $customer;
    /**
     * Create a new job instance.
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $adminEmail = SettingOption::getValue("admin_email", "example@gmail.com");
        $bcc = SettingOption::getValue("admin_bcc", "");
        $cc = SettingOption::getValue("admin_cc", "");

        Mail::to($adminEmail)
            ->cc(explode(",", $cc))
            ->bcc(explode(",", $bcc))
            ->send(new QuotationSubmittedMail($this->customer));
    }
}
