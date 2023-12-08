<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TransferSaldo;
use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;

class TransferController extends Controller
{
    public function index()
    {
        return view('page.admin.keuangan.transfer_saldo.index');
    }
    public function dataTable(Request $request)
    {
        if ($request->ajax()) {
            $columns = [
                'sumber_rekening',
                'tujuan_transfer',
                'jumlah_transfer',
                'tanggal',
                'jam',
                'biaya_admin',
                'id',
            ];

            $data = TransferSaldo::select($columns);

            return DataTables::of($data)
                ->addColumn('options', function ($row) {
                    $url = route('transfer_saldo.edit', ['id' => $row->id]);
                    $urlHapus = route('transfer_saldo.delete', $row->id);

                    $options = "<a href='$url'><i class='fas fa-edit fa-lg'></i></a>
                                <a style='border: none; background-color:transparent;' class='hapusData' data-id='$row->id' data-url='$urlHapus'>
                                    <i class='fas fa-trash fa-lg text-danger'></i>
                                </a>";

                    return $options;
                })
                ->rawColumns(['options'])
                ->make(true);
        }
    }

    public function tambahTransfer(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'sumber_rekening' => 'required|string',
                'tujuan_transfer' => 'required|string',
                'jumlah_transfer' => 'required|numeric',
                'tanggal' => 'required|date',
                'jam' => 'required',
                'biaya_admin' => 'required|numeric',
            ]);

            TransferSaldo::create([
                'sumber_rekening' => $request->sumber_rekening === 'MISC' ? $request->custom_notes : $request->sumber_rekening,
                'tujuan_transfer' => $request->tujuan_transfer === 'MISC' ? $request->custom_notes2 : $request->tujuan_transfer,
                'jumlah_transfer' => $request->jumlah_transfer,
                'tanggal' => $request->tanggal,
                'jam' => $request->jam,
                'biaya_admin' => $request->biaya_admin,
            ]);

            return redirect()->route('transfer_saldo.add')->with('status', 'Data telah tersimpan di database');
        }

        return view('page.admin.keuangan.transfer_saldo.addTransfer');
    }


    public function ubahTransfer($id, Request $request)
    {
        $transfer = TransferSaldo::findOrFail($id);

        if ($request->isMethod('post')) {
            $this->validate($request, [
                'sumber_rekening' => 'required|string',
                'tujuan_transfer' => 'required|string',
                'jumlah_transfer' => 'required|numeric',
                'tanggal' => 'required|date',
                'jam' => 'required',
                'biaya_admin' => 'required|numeric',
            ]);

            $transfer->update([
                'sumber_rekening' => $request->sumber_rekening === 'MISC' ? $request->custom_notes : $request->sumber_rekening,
                'tujuan_transfer' => $request->tujuan_transfer === 'MISC' ? $request->custom_notes2 : $request->tujuan_transfer,
                'jumlah_transfer' => $request->jumlah_transfer,
                'tanggal' => $request->tanggal,
                'jam' => $request->jam,
                'biaya_admin' => $request->biaya_admin,
            ]);

            return redirect()->route('transfer_saldo.index', ['id' => $transfer->id])->with('status', 'Data telah tersimpan di database');
        }

        return view('page.admin.keuangan.transfer_saldo.ubahTransfer', [
            'transfer' => $transfer
        ]);
    }
    public function hapusTransfer($id)
    {
        $transfer = TransferSaldo::findOrFail($id);
        $transfer->delete();

        return response()->json([
            'msg' => 'Data yang dipilih telah dihapus'
        ]);
    }
}
