<?php

namespace App\Console\Commands;

use App\Mail\DailyQuoteMail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class DailyQuote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quote:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Respectively send an exclusive quote to everyone daily via email.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('quote:daily - START');
        $users = User::all();
        foreach ($users as $user) {
            try {
                $this->info("daily:quote - SEND TO {$user->name}");
                Mail::to($user)->send(new DailyQuoteMail($user));
                $this->info("quote:daily - SENT");
            } catch (\Exception $e) {
                report($e);
                $this->error("quote:daily - NOT SENT");
            }
        }
        return 0;
    }
}
