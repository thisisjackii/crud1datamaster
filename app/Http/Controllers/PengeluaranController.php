<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PengeluaranController extends Controller
{
    public function index()
    {
        return view('page.admin.keuangan.pengeluaran.index');
    }

    public function dataTable(Request $request)
    {
        if ($request->ajax()) {
            $columns = [
                'nama_kategori',
                'nama_pengeluaran',
                'tujuan_transaksi',
                'kuantitas',
                'harga_peritem',
                'tanggal',
                'jam',
                'id',
            ];

            $data = Pengeluaran::select($columns);

            return DataTables::of($data)
                ->addColumn('options', function ($row) {
                    $url = route('pengeluaran.edit', ['id' => $row->id]);
                    $urlHapus = route('pengeluaran.delete', $row->id);

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

    public function tambahPengeluaran(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'nama_kategori' => 'required|string',
                'nama_pengeluaran' => 'required|string',
                'tujuan_transaksi' => 'required|string',
                'kuantitas' => 'required|numeric',
                'harga_peritem' => 'required|numeric',
                'tanggal' => 'required|date',
                'jam' => 'required',
            ]);

            Pengeluaran::create([
                'nama_kategori' => $request->nama_kategori,
                'nama_pengeluaran' => $request->nama_pengeluaran,
                'tujuan_transaksi' => $request->tujuan_transaksi,
                'kuantitas' => $request->kuantitas,
                'harga_peritem' => $request->harga_peritem,
                'tanggal' => $request->tanggal,
                'jam' => $request->jam,
            ]);

            return redirect()->route('pengeluaran.add')->with('status', 'Data telah tersimpan di database');
        }

        return view('page.admin.keuangan.pengeluaran.addPengeluaran');
    }

    public function ubahPengeluaran($id, Request $request)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);

        if ($request->isMethod('post')) {
            $this->validate($request, [
                'nama_kategori' => 'required|string',
                'nama_pengeluaran' => 'required|string',
                'tujuan_transaksi' => 'required|string',
                'kuantitas' => 'required|numeric',
                'harga_peritem' => 'required|numeric',
                'tanggal' => 'required|date',
                'jam' => 'required',
            ]);

            $pengeluaran->update([
                'nama_kategori' => $request->nama_kategori,
                'nama_pengeluaran' => $request->nama_pengeluaran,
                'tujuan_transaksi' => $request->tujuan_transaksi,
                'kuantitas' => $request->kuantitas,
                'harga_peritem' => $request->harga_peritem,
                'tanggal' => $request->tanggal,
                'jam' => $request->jam,
            ]);

            return redirect()->route('pengeluaran.index', ['id' => $pengeluaran->id])->with('status', 'Data telah tersimpan di database');
        }

        return view('page.admin.keuangan.pengeluaran.ubahPengeluaran', [
            'pengeluaran' => $pengeluaran
        ]);
    }

    public function hapusPengeluaran($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->delete();

        return response()->json([
            'msg' => 'Data yang dipilih telah dihapus'
        ]);
    }
}

