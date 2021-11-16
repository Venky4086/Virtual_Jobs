<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;
use App\Mail\SendResume;

class QueueJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $name;
    protected $msg;
    protected $count;
    protected $key;
    protected $email;
    public $timeout = 7200; // 2 hours
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($name, $msg, $count, $key, $email)
    {
        $this->name=$name;
        $this->msg =$msg;
        $this->count=$count;
        $this->key=$key;
        $this->email = $email;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $name=$this->name;
        $msg=$this->msg;
        $count=$this->count;
        $key=$this->key;
        $mail=$this->email;
        \Mail::send('Backend.pages.Sendmail', ['name' =>$name, 'msg'=>$msg, 'count'=>$count, 'key'=>$key] , function ($message) use ($mail) {
            $message->to($mail, 'Hiring Alert from Job Search')
                ->subject('Hiring Alert from Job Search');
              
        });
    }
}
