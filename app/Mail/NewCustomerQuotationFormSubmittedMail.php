<?php

namespace App\Mail;

use App\Models\Customer;
use App\Models\CustomerQuotationForm;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewCustomerQuotationFormSubmittedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $customer;
    public $quotation;

    /**
     * Create a new message instance.
     */
    public function __construct(Customer $customer, CustomerQuotationForm $quotation)
    {
        $this->customer = $customer;
        $this->quotation = $quotation;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Customer Quotation Submission Received',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.new-customer-quotation-submitted',
            with: [
                'customer' => $this->customer,
                'quotation' => $this->quotation,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
