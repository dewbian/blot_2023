<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

 

class BlotCustomMail extends Mailable
{
    use Queueable, SerializesModels;


    Protected $user;
    Protected $method;
    Protected $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */    
    public function __construct($content,$method)
    {
        //$this->user     = $user;
        $this->method   = $method;
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    { 
        $method = $this->method; 
        $content = $this->content; 
        if($method == "AnswerToContact"){
            $return_view    = "emails.AnswerToContact";
            $return_subject = "프로젝트 문의에 대한 답변입니다.";
        }  

        return $this->view($return_view, compact('content'))
            ->subject($return_subject);

    }
}
