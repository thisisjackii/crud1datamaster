<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Hutang;
use App\Models\Pinjaman;
use App\Models\TransferSaldo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use Yajra\DataTables\DataTables;

class RiwayatController extends Controller
{
    // ...
    public function index()
    {
        return view('page.admin.keuangan.riwayat');
    }

    public function tambahRiwayat($codename, $id, $tanggal, $jam, $user_id)
    {
        Riwayat::create([
            'reference_id' => $codename . $id,
            'tanggal' => $tanggal,
            'jam' => $jam,
            'user_id' => $user_id,
            // Add any additional attributes you want to include in Riwayat
        ]);
    }

    public function dataTable(Request $request)
    {
        if ($request->ajax()) {
            $data = Riwayat::where('user_id', auth()->id())->select('id', 'reference_id', 'tanggal', 'jam');

            return DataTables::of($data)
                ->addColumn('type', function ($row) {
                    return $this->getTransactionType($row->reference_id);
                })
                ->addColumn('description', function ($row) {
                    return $this->getTransactionDescription($row->reference_id);
                })
                ->addColumn('amount', function ($row) {
                    return $this->getTransactionAmount($row->reference_id);
                })
                ->addColumn('date', function ($row) {
                    return $row->tanggal;
                })
                ->addColumn('time', function ($row) {
                    return $row->jam;
                })
                ->rawColumns(['options'])
                ->make(true);
        }
    }

    protected function getTransactionType($reference_id)
    {
        $codename = substr($reference_id, 0, 3);

        switch ($codename) {
            case 'PMS':
                return Pemasukan::find(substr($reference_id, 3))->nama_kategori;
            case 'PNG':
                return Pengeluaran::find(substr($reference_id, 3))->nama_kategori;
            case 'HTG':
                return 'Hutang';
            case 'PNJ':
                return 'Pinjaman';
            case 'TSF':
                return 'Transfer Saldo';
            default:
                return 'Unknown';
        }
    }

    protected function getTransactionDescription($reference_id)
    {
        $codename = substr($reference_id, 0, 3);

        switch ($codename) {
            case 'PMS':
                return Pemasukan::find(substr($reference_id, 3))->catatan_pemasukan;
            case 'PNG':
                return Pengeluaran::find(substr($reference_id, 3))->nama_pengeluaran;
            case 'HTG':
                return Hutang::find(substr($reference_id, 3))->catatan_hutang;
            case 'PNJ':
                return Pinjaman::find(substr($reference_id, 3))->catatan_pinjaman;
            case 'TSF':
                return TransferSaldo::find(substr($reference_id, 3))->tujuan_transfer;
            default:
                return 'Unknown';
        }
    }

    protected function getTransactionAmount($reference_id)
    {
        $codename = substr($reference_id, 0, 3);

        switch ($codename) {
            case 'PMS':
                return Pemasukan::find(substr($reference_id, 3))->jumlah_pemasukan;
            case 'PNG':
                $pengeluaran = Pengeluaran::find(substr($reference_id, 3));
                return $pengeluaran->harga_peritem * $pengeluaran->kuantitas;
            case 'HTG':
                return Hutang::find(substr($reference_id, 3))->jumlah_hutang;
            case 'PNJ':
                return Pinjaman::find(substr($reference_id, 3))->jumlah_pinjaman;
            case 'TSF':
                $transferSaldo = TransferSaldo::find(substr($reference_id, 3));
                return $transferSaldo->jumlah_transfer + $transferSaldo->biaya_admin;
            default:
                return 'Unknown';
        }
    }

    // ...
}
