<?php

namespace App\Console\Commands;

use App\Mail\WalkinMail;
use App\Models\WalkinCustomer;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendWalkinEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send-walkin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send walk-in email every minute';


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
        file_put_contents(storage_path('logs/cron-test.log'), now() . " - Cron ran\n", FILE_APPEND);
        $data = WalkinCustomer::select('walkin_customers.*', 'branches.branch_name')
            ->join('branches', 'branches.id', 'walkin_customers.branch_id')
            ->whereDate('walkin_customers.customer_enter_time', Carbon::today())
            ->where('walkin_customers.branch_id', 5)
            ->get();

        // Mail::to('manager.trichy@ejindia.com')
        //     ->cc(['dhiaan@ejindia.com', 'vivinrajkumar.r@ejindia.com', 'sathiskumar.p@ejindia.com', 'srinivasan.m@ejindia.com', 'sundaram@brightbridgeinfotech.com'])
        //     ->send(new WalkinMail($data));
        Mail::to('sundaram@brightbridgeinfotech.com')
            ->send(new WalkinMail($data));

        $this->info('Email sent successfully!');
    }
}
