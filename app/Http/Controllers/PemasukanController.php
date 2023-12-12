<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Exports\PemasukanExport;
use App\Imports\PemasukanImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PemasukanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('page.admin.keuangan.pemasukan.index');
    }

    public function dataTable(Request $request)
    {
        if ($request->ajax()) {
            $data = Pemasukan::where('user_id', auth()->id())->select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $urlEdit = route('pemasukan.edit', ['id' => $row->id]);
                    $urlDelete = route('pemasukan.delete', ['id' => $row->id]);

                    $btn = "<a href='{$urlEdit}' class='btn btn-primary btn-sm'>Edit</a>";
                    $btn .= "<button class='btn btn-danger btn-sm hapusData' data-id='{$row->id}' data-url='{$urlDelete}'>Delete</button>";

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function tambahPemasukan(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'nama_kategori' => 'required|string',
                'rekening' => 'required|string',
                'jumlah_pemasukan' => 'required|numeric',
                'catatan_pemasukan' => 'string',
                'tanggal' => 'required|date',
                'jam' => 'required',
            ]);

            Pemasukan::create([
                'nama_kategori' => $request->nama_kategori === 'Lainnya' ? $request->custom_notes : $request->nama_kategori,
                'rekening' => $request->rekening === 'Lainnya' ? $request->custom_notes2 : $request->rekening,
                'jumlah_pemasukan' => $request->jumlah_pemasukan,
                'catatan_pemasukan' => $request->catatan_pemasukan,
                'tanggal' => $request->tanggal,
                'jam' => $request->jam,
                'user_id' => auth()->id(),
            ]);

            return redirect()->route('pemasukan.add')->with('status', 'Data telah tersimpan di database');
        }

        return view('page.admin.keuangan.pemasukan.addPemasukan');
    }

    public function ubahPemasukan($id, Request $request)
    {
        $pemasukan = Pemasukan::where('user_id', auth()->id())->findOrFail($id);

        if ($request->isMethod('post')) {
            $this->validate($request, [
                'nama_kategori' => 'required|string',
                'rekening' => 'required|string',
                'jumlah_pemasukan' => 'required|numeric',
                'catatan_pemasukan' => 'string',
                'tanggal' => 'required|date',
                'jam' => 'required',
            ]);

            $pemasukan->update([
                'nama_kategori' => $request->nama_kategori === 'Lainnya' ? $request->custom_notes : $request->nama_kategori,
                'rekening' => $request->rekening === 'Lainnya' ? $request->custom_notes2 : $request->rekening,
                'jumlah_pemasukan' => $request->jumlah_pemasukan,
                'catatan_pemasukan' => $request->catatan_pemasukan,
                'tanggal' => $request->tanggal,
                'jam' => $request->jam,
            ]);

            return redirect()->route('pemasukan.index')->with('status', 'Data telah tersimpan di database');
        }

        return view('page.admin.keuangan.pemasukan.ubahPemasukan', [
            'pemasukan' => $pemasukan
        ]);
    }

    public function hapusPemasukan($id)
    {
        $pemasukan = Pemasukan::where('user_id', auth()->id())->findOrFail($id);
        $pemasukan->delete();

        return response()->json([
            'msg' => 'Data yang dipilih telah dihapus'
        ]);
    }

    public function exportPdf() 
    {
        $user_id = auth()->id();
        return (new PemasukanExport)->forUserId($user_id)->download('pemasukan.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function export() 
    {
        $user_id = auth()->id();
        return (new PemasukanExport)->forUserId($user_id)->download('pemasukan.xlsx');
    }  

    public function jumlahPemasukan()
    {
        $sumOfJumlahPemasukan = Pemasukan::where('user_id', auth()->id())->sum('jumlah_pemasukan');
        $formattedPemasukan = 'Rp' . number_format($sumOfJumlahPemasukan, 2, ',', '.');

        return $sumOfJumlahPemasukan;
    }
    public function totalKategoriPemasukan()
    {
        $categoryTotals = Pemasukan::select('nama_kategori', \DB::raw('SUM(jumlah_pemasukan) as total'))
            ->where('user_id', auth()->id())
            ->groupBy('nama_kategori')
            ->get();

        $formattedData = json_encode($categoryTotals);

        return $formattedData;
    }
}
