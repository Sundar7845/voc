<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Imports\SalesReportImport;
use App\Models\SalesReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class SaleController extends Controller
{
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
            ->toJson();
    }

    function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        $file = $request->file('file');

        // Import the file using the SalesReportImport class
        Excel::import(new SalesReportImport, $file);

        return redirect()->back()->with('success', 'Sales report imported successfully.');
    }
}
