<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use App\Models\Deposit;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function participants(Request $request)
    {
        $participants = Participant::with(['deposits', 'withdrawals'])->orderBy('nama')->get();

        if ($request->has('print')) {
            return view('admin.reports.participants_print', compact('participants'));
        }

        return view('admin.reports.participants', compact('participants'));
    }

    public function deposits(Request $request)
    {
        $filterType = $request->get('filter_type', 'all');
        $date = $request->get('date', date('Y-m-d'));
        $month = $request->get('month', date('m'));
        $year = $request->get('year', date('Y'));

        $query = Deposit::with('participant');

        if ($filterType === 'harian') {
            $query->whereDate('tanggal', $date);
        } elseif ($filterType === 'bulanan') {
            $query->whereMonth('tanggal', $month)->whereYear('tanggal', $year);
        } elseif ($filterType === 'tahunan') {
            $query->whereYear('tanggal', $year);
        }

        $deposits = $query->orderBy('tanggal')->get();
        $total = $deposits->sum('jumlah');

        if ($request->has('print')) {
            return view('admin.reports.deposits_print', compact('deposits', 'filterType', 'date', 'month', 'year', 'total'));
        }

        return view('admin.reports.deposits', compact('deposits', 'filterType', 'date', 'month', 'year', 'total'));
    }

    public function withdrawals(Request $request)
    {
        $filterType = $request->get('filter_type', 'all');
        $date = $request->get('date', date('Y-m-d'));
        $month = $request->get('month', date('m'));
        $year = $request->get('year', date('Y'));

        $query = Withdrawal::with('participant');

        if ($filterType === 'harian') {
            $query->whereDate('tanggal', $date);
        } elseif ($filterType === 'bulanan') {
            $query->whereMonth('tanggal', $month)->whereYear('tanggal', $year);
        } elseif ($filterType === 'tahunan') {
            $query->whereYear('tanggal', $year);
        }

        $withdrawals = $query->orderBy('tanggal')->get();
        $total = $withdrawals->sum('jumlah');

        if ($request->has('print')) {
            return view('admin.reports.withdrawals_print', compact('withdrawals', 'filterType', 'date', 'month', 'year', 'total'));
        }

        return view('admin.reports.withdrawals', compact('withdrawals', 'filterType', 'date', 'month', 'year', 'total'));
    }

    public function balances(Request $request)
    {
        $participants = Participant::orderBy('nama')->get();

        if ($request->has('print')) {
            return view('admin.reports.balances_print', compact('participants'));
        }

        return view('admin.reports.balances', compact('participants'));
    }

    public function financials(Request $request)
    {
        $totalParticipants = Participant::count();
        $totalDeposits = Deposit::sum('jumlah');
        $totalWithdrawals = Withdrawal::sum('jumlah');
        $netBalance = $totalDeposits - $totalWithdrawals;

        if ($request->has('print')) {
            return view('admin.reports.financials_print', compact('totalParticipants', 'totalDeposits', 'totalWithdrawals', 'netBalance'));
        }

        return view('admin.reports.financials', compact('totalParticipants', 'totalDeposits', 'totalWithdrawals', 'netBalance'));
    }
}
