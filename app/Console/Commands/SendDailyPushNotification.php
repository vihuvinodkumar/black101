<?php

namespace App\Console\Commands;
use App\Models\Login;
use App\Notifications\PushNotification;

use Illuminate\Console\Command;

class SendDailyPushNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:push-daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send push notification to users daily at 9am EST.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        $users = Login::all();

        foreach ($users as $user) {
            $user->notify(new PushNotification);
        }

        $this->info('Push notifications sent successfully.');
    }
}
