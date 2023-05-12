<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;


class Push_notification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:push_notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification daily 9 am ';

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
        // Create a new GuzzleHttp client instance
        $client = new Client();

        // Make an API call
        $response = $client->get('http://127.0.0.1:8000/api/push_notification');

        // Get the response body as a string
        $data = $response->getBody()->getContents();

        // Process the data as needed
        // ...

        // Log the result
        Log::info('Send notification successfully...: ' . $data);
    }
}
