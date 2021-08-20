<?php

namespace app\components;

class MailSender
{
    private $to;
    private $subject;
    private $message;
    private $headers;

    public function __construct($to, string $subject = 'Title', string $message = 'Message', string $headers = '')
    {
        $this->to = $to;
        $this->subject = $subject;
        $this->message = wordwrap($message, 70, "\r\n");
        $this->headers = $headers;
    }

    public function sendMail($all_in_one = false): int
    {
        $counter = 0;
        if($all_in_one && is_array($this->to)) {
            $this->to = implode(', ', $this->to);
            return $this->sendSingleMail();
        }
        if(is_string($this->to)) {
            $tos = explode(', ', $this->to);

            foreach ($tos as $email) {
                $this->to = $email;
                $counter += (int) $this->sendSingleMail();
            }
        }
        return $counter;
    }

    private function sendSingleMail(): bool
    {
        return mail($this->to, $this->subject, $this->message, $this->headers);
    }
}