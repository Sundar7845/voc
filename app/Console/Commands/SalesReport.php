<?php

namespace App\Console\Commands;

use App\Models\Branches;
use App\Models\Customer;
use App\Models\SalesReport as ModelsSalesReport;
use App\Traits\Common;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class SalesReport extends Command
{
    use Common;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sales:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sales Report Updated Successfully!';

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

            $sales = DB::connection('mysql2')->select("SELECT * FROM `sales_warehouse` ORDER BY id ASC;");
            $this->output->progressStart(count($sales));
            foreach ($sales as $item) {

                $branch = Branches::where('slug', $item->branch_id)->value('id');
                $customer = Customer::where('customer_id', $item->customer_id)->value('id');
                ModelsSalesReport::Updateorcreate([
                    'branch_id' => $branch,
                    'invoice_date' => $item->invoice_date,
                    'purchase_location' => $item->purchase_location,
                    'article_code' => $item->article_code,
                    'name' => $item->name,
                    'sku_number' => $item->sku_number,
                    'sales_id' => $item->sales_id,
                    'sales_person' => $item->sales_person,
                    'invoice_id' => $item->invoice_id,
                    'grweight' => $item->grweight,
                    'pcs' => $item->pcs,
                    'net_chargeable' => $item->net_chargeable,
                    'sales_qty' => $item->sales_qty,
                    'ct_wght' => $item->ct_wght,
                    'textbox_33' => $item->textbox_33,
                    'customer_id' => $customer,
                    'cust_name' => $item->cust_name,
                    'cust_phone' => $item->cust_phone,
                    'delivery_name' => $item->delivery_name,
                    'sales_price' => $item->sales_price,
                    'cvalue' => $item->cvalue,
                    'stud_value' => $item->stud_value,
                    'mk_code' => $item->mk_code,
                    'sale_calc_type' => $item->sale_calc_type,
                    'amt_1' => $item->amt_1,
                    'mk_rate' => $item->mk_rate,
                    'mk_value' => $item->mk_value,
                    'makingdisper' => $item->makingdisper,
                    'makingdisc' => $item->makingdisc,
                    'scheme_discount' => $item->scheme_discount,
                    'textbox_89' => $item->textbox_89,
                    'tax_item_group' => $item->tax_item_group,
                    'tax_per' => $item->tax_per,
                    'tax_amount' => $item->tax_amount,
                    'total_amount' => $item->total_amount,
                    'line_amount' => $item->line_amount,
                    'invoice_amount' => $item->invoice_amount,
                    'buyer_tin' => $item->buyer_tin
                ]);
                $this->output->progressAdvance();
            }
            // Commit the transaction
            DB::commit();
            $this->info('Sales report updated successfully');
        } catch (QueryException $e) {
            // Rollback the transaction on exception
            DB::rollBack();
            $this->info('Sales report update failed: ' . $e->getMessage());
            $this->Log(__FUNCTION__, "POST", $e->getMessage(), 1, request()->ip(), gethostname());
        } catch (Exception $e) {
            // Catch more generic exceptions
            DB::rollBack();
            $this->info('Sales report update failed: ' . $e->getMessage());
            $this->Log(__FUNCTION__, "POST", $e->getMessage(), 1, request()->ip(), gethostname());
        }
    }
}
