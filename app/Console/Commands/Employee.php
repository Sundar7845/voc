<?php

namespace App\Console\Commands;

use App\Models\Employee as ModelsEmployee;
use App\Models\User;
use App\Traits\Common;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Employee extends Command
{

    use Common;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employee:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Employee creation completed';

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

            $employees = ModelsEmployee::get();

            $this->output->progressStart(count($employees));
            foreach ($employees as $item) {

                User::Create([
                    'name' => $item->emp_no,
                    'password' => Hash::make('123456')
                ]);
                $this->output->progressAdvance();
            }
            // Commit the transaction
            DB::commit();
            $this->info('Employees updated successfully');
        } catch (QueryException $e) {
            // Rollback the transaction on exception
            DB::rollBack();
            $this->info('Employees update failed: ' . $e->getMessage());
            $this->Log(__FUNCTION__, "POST", $e->getMessage(), 1, request()->ip(), gethostname());
        } catch (Exception $e) {
            // Catch more generic exceptions
            DB::rollBack();
            $this->info('Employees update failed: ' . $e->getMessage());
            $this->Log(__FUNCTION__, "POST", $e->getMessage(), 1, request()->ip(), gethostname());
        }
    }
}
