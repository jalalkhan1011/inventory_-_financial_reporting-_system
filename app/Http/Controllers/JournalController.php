<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $start = $request->start_date ?: now()->startOfMonth()->toDateString();
        $end = $request->end_date ?: now()->endOfMonth()->toDateString();

        $journalInfo = Journal::whereBetween('created_at', [Carbon::parse($start)->startOfDay(),
        Carbon::parse($end)->endOfDay()])->get();

        $financialReport = [
            'sale' => $journalInfo->where('j_type', 'sale')->sum('j_total'),
            'discount' => $journalInfo->where('j_type', 'discount')->sum('j_total'),
            'vat' => $journalInfo->where('j_type', 'vat')->sum('j_total'),
            'paid' => $journalInfo->where('j_type', 'paid')->sum('j_total'),
            'due' => $journalInfo->where('j_type', 'due')->sum('j_total'),
            'profit' => $journalInfo->where('j_type', 'sale')->sum('j_total') - $this->getJournalTotal($journalInfo),
        ];


        return view('admin.journal.index', compact('start', 'end', 'financialReport', 'journalInfo'));
    }

    protected function getJournalTotal($journalInfo)
    {
        $saleInfos = $journalInfo->pluck('sale_id')->unique();
        return Sale::with('product')->whereIn('id', $saleInfos)->get()->sum(function ($sale) {
            return $sale->product->p_p_price * $sale->qty;
        });
    }
}
