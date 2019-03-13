<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailContent extends \Eloquent
{
    protected $table = 'email_contents';

    protected $fillable = ['content'];

    public function customers()
    {
        return $this->belongsToMany('App\Models\Customer', 'mail_customer', 'email_content_id', 'customer_id')
            ->withTimestamps();
    }
}
