<?php

namespace App\Services\Contact;

use App\Repositories\Contact\ContactRepositoryInterface;
use App\Services\Contact\ContactServiceInterface;

class ContactService implements ContactServiceInterface
{
    public function __construct(protected ContactRepositoryInterface $contactRepository) {}
}
