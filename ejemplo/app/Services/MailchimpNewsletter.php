<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class MailchimpNewsletter implements Newsletter
{

    public function __construct(protected ApiClient $client){

    }

    public function subscribe(string $email, string $list = null){
        // ??= significa que si list es nulo que lo iguale a lo de la derecha

        //ddd($list);
        $list ??=config('services.mailchimp.lists.subscribers');

        //ddd($list);
        $response = $this->client->lists->addListMember($list, [
            'email_address'=> $email,
            'status'=> 'subscribed',
        ]);
    }

}
