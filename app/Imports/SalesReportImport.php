<?php

namespace App\Imports;

use App\Models\Branches;
use App\Models\Customer;
use App\Models\SalesReport;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class SalesReportImport implements ToModel, WithHeadingRow, WithBatchInserts
{
    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function model(array $row)
    {
        $branchId = Branches::where('slug', $row['branch_id'])->value('id');
        $customerId = Customer::where('customer_id', $row['customer_id'])->value('id');

        if ($customerId === null) {
            $customer = Customer::where('phone_number', $row['cust_phone'])->first();

            if ($customer) {
                $customer->update([
                    'customer_id' => $row['customer_id']
                ]);
                $customerId = $customer->id;
            }
        }

        $excelDateValue = $row['invoice_date']; // Example: 45826

        // Check if the value is numeric (Excel serial date format)
        if (is_numeric($excelDateValue)) {
            $carbonDate = Carbon::instance(Date::excelToDateTimeObject($excelDateValue));
        } else {
            $carbonDate = Carbon::parse($excelDateValue);
        }

        $formattedDate = $carbonDate->format('y-M-d');

        return new SalesReport([
            'branch_id' => $row['branch_id'],
            'invoice_date' => $formattedDate,
            'purchase_location' => $row['purchase_location'],
            'article_code' => $row['article_code'],
            'name' => $row['name'],
            'sku_number' => $row['sku_number'],
            'sales_id' => $row['sales_id'],
            'sales_person' => $row['sales_person'],
            'invoice_id' => $row['invoice_id'],
            'grweight' => $row['grweight'],
            'pcs' => $row['pcs'],
            'net_chargeable' => $row['net_chargeable'],
            'sales_qty' => $row['sales_qty'],
            'ct_wght' => $row['ct_wght'],
            'textbox_33' => $row['textbox_33'],
            'customer_id' => $customerId,
            'cust_name' => $row['cust_name'],
            'cust_phone' => $row['cust_phone'],
            'delivery_name' => $row['delivery_name'],
            'sales_price' => $row['sales_price'],
            'cvalue' => $row['cvalue'],
            'stud_value' => $row['stud_value'],
            'mk_code' => $row['mk_code'],
            'sale_calc_type' => $row['sale_calc_type'],
            'amt_1' => $row['amt_1'],
            'mk_rate' => $row['mk_rate'],
            'mk_value' => $row['mk_value'],
            'makingdisper' => $row['makingdisper'],
            'makingdisc' => $row['makingdisc'],
            'scheme_discount' => $row['scheme_discount'],
            'textbox_89' => $row['textbox_89'],
            'tax_item_group' => $row['tax_item_group'],
            'tax_per' => $row['tax_per'],
            'tax_amount' => $row['tax_amount'],
            'total_amount' => $row['total_amount'],
            'line_amount' => $row['line_amount'],
            'invoice_amount' => $row['invoice_amount'],
            'buyer_tin' => $row['buyer_tin']
        ]);
    }
}
