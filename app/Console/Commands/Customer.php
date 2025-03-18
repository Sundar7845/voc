<?php

namespace App\Console\Commands;

use App\Models\Branches;
use App\Models\Customer as ModelsCustomer;
use App\Traits\Common;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class Customer extends Command
{
    use Common;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customer:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Customer Updated Successfully';

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
        try {
            DB::beginTransaction();

            $Customers = DB::connection('mysql2')->select("SELECT * FROM `customers` ORDER BY id ASC;");
            $this->output->progressStart(count($Customers));
            foreach ($Customers as $item) {

                ModelsCustomer::Updateorcreate([
                    'customer_id' => $item->accountnum1,
                    'name' => $item->name,
                    'phone_number'  => $item->mobile,
                    'address' => $item->address
                ]);
                $this->output->progressAdvance();
            }
            // Commit the transaction
            DB::commit();
            $this->info('Customer updated successfully');
        } catch (QueryException $e) {
            // Rollback the transaction on exception
            DB::rollBack();
            $this->info('Customer update failed: ' . $e->getMessage());
            $this->Log(__FUNCTION__, "POST", $e->getMessage(), 1, request()->ip(), gethostname());
        } catch (Exception $e) {
            // Catch more generic exceptions
            DB::rollBack();
            $this->info('Customer update failed: ' . $e->getMessage());
            $this->Log(__FUNCTION__, "POST", $e->getMessage(), 1, request()->ip(), gethostname());
        }
    }
}
