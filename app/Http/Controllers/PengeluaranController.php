<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Exports\PengeluaranExport;
use App\Imports\PengeluaranImport;
use Maatwebsite\Excel\Facades\Excel;

class PengeluaranController extends Controller
{
    public function index()
    {
        return view('page.admin.keuangan.pengeluaran.index');
    }

    public function dataTable(Request $request)
    {
        if ($request->ajax()) {
            $data = Pengeluaran::where('user_id', auth()->id())->select('nama_kategori', 'nama_pengeluaran', 'tujuan_transaksi', 'kuantitas', 'harga_peritem', 'tanggal', 'jam', 'id');

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
                'user_id' => auth()->id(),
            ]);

            return redirect()->route('pengeluaran.add')->with('status', 'Data telah tersimpan di database');
        }

        return view('page.admin.keuangan.pengeluaran.addPengeluaran');
    }

    public function ubahPengeluaran($id, Request $request)
    {
        $pengeluaran = Pengeluaran::where('user_id', auth()->id())->findOrFail($id);

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

            return redirect()->route('pengeluaran.index')->with('status', 'Data telah tersimpan di database');
        }

        return view('page.admin.keuangan.pengeluaran.ubahPengeluaran', [
            'pengeluaran' => $pengeluaran
        ]);
    }

    public function hapusPengeluaran($id)
    {
        $pengeluaran = Pengeluaran::where('user_id', auth()->id())->findOrFail($id);
        $pengeluaran->delete();

        return response()->json([
            'msg' => 'Data yang dipilih telah dihapus'
        ]);
    }

    public function exportPdf() 
    {
        return Excel::download(new PengeluaranExport, 'pengeluaran.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function export() 
    {
        return Excel::download(new PengeluaranExport, 'pengeluaran.xlsx');
    }
}
