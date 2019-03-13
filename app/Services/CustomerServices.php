<?php

namespace App\Services;


use App\Mail\SendPromotion;
use App\Models\Customer;
use App\Models\MailContent;
use Illuminate\Support\Facades\Mail;

class CustomerServices
{
    public function getAllCustomer()
    {
        return Customer::all();
    }

    public function sendMailPromotion($dataRequest)
    {
        $customers = $this->getCustomerByIds($dataRequest['ids_customer']);

        $contentMail = $this->storeContentMail($dataRequest['mail_subject'],$dataRequest['mail_content']);

        if ($customers) {
            foreach ($customers as $customer) {
                Mail::to($customer->email)
                    ->queue(new SendPromotion($contentMail));
            }
        }

        return 'Successful';
    }

    public function getCustomerByIds($idsCustomer)
    {
        return Customer::getCustomersByIds($idsCustomer);
    }

    public function storeContentMail($subject, $content)
    {
        return MailContent::create([
            'subject' => $subject,
            'content' => $content
        ]);
    }
}