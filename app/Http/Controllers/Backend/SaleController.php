<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Imports\SalesReportImport;
use App\Models\SalesReport;
use App\Traits\Common;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class SaleController extends Controller
{
    use Common;
    function sales()
    {
        return view('backend.salesreport');
    }

    public function exampleSheet()
    {
        $file_path = public_path('template/sample_sheet.xlsx');
        return response()->download($file_path);
    }

    function getSalesReport(Request $request)
    {
        $salesreport = SalesReport::with('branch') // eager load relationship
            ->orderBy('invoice_date', 'ASC');

        return DataTables::of($salesreport)
            ->addColumn('branch_name', function ($row) {
                return $row->branch->branch_name ?? '-';
            })
            ->addColumn('customer_id', function ($row) {
                return $row->customer->customer_id ?? '-';
            })
            ->toJson();
    }

    public function import(Request $request)
    {
        try {
            $this->validate($request, [
                'file' => 'required|mimes:xlsx,xls,csv'
            ]);

            $file = $request->file('file');

            // Ensure the extension is used to infer type
            Excel::import(new SalesReportImport, $file->getRealPath(), null, \Maatwebsite\Excel\Excel::XLSX);

            return redirect()->back()->with('success', 'Sales report imported successfully.');
        } catch (\Exception $e) {
            $this->Log(
                __FUNCTION__,
                "POST",
                $e->getMessage(),
                Auth::user()->id ?? null,
                request()->ip(),
                gethostname()
            );

            return redirect()->back()->with([
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            ]);
        }
    }
}
