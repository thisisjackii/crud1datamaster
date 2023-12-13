<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Exports\PengeluaranExport;
use App\Imports\PengeluaranImport;
use Maatwebsite\Excel\Facades\Excel;

use App\Http\Controllers\RiwayatController;

class PengeluaranController extends Controller
{
    private $riwayatController;
    public function __construct(RiwayatController $riwayatController)
    {
        $this->middleware('auth');
        $this->riwayatController = $riwayatController;
    }
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

            $pengeluaran = Pengeluaran::create([
                'nama_kategori' => $request->nama_kategori === 'Lainnya' ? $request->custom_notes : $request->nama_kategori,
                'nama_pengeluaran' => $request->nama_pengeluaran,
                'tujuan_transaksi' => $request->tujuan_transaksi,
                'kuantitas' => $request->kuantitas,
                'harga_peritem' => $request->harga_peritem,
                'tanggal' => $request->tanggal,
                'jam' => $request->jam,
                'user_id' => auth()->id(),
            ]);

            // Create Riwayat entry
            $this->riwayatController->tambahRiwayat('PNG', $pengeluaran->id, $pengeluaran->tanggal, $pengeluaran->jam, $pengeluaran->user_id);

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
                'nama_kategori' => $request->nama_kategori === 'Lainnya' ? $request->custom_notes : $request->nama_kategori,
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
        $user_id = auth()->id();
        // return Excel::download(new PengeluaranExport, 'pengeluaran.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
        return (new PengeluaranExport)->forUserId($user_id)->download('pengeluaran.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function export()
    {
        $user_id = auth()->id();

        return (new PengeluaranExport)->forUserId($user_id)->download('pengeluaran.xlsx');
    }

    public function jumlahPengeluaran()
    {
        $sumOfJumlahPengeluaran = Pengeluaran::where('user_id', auth()->id())
            ->sum(\DB::raw('CAST(kuantitas AS NUMERIC) * CAST(harga_peritem AS NUMERIC)'));

        $formattedPengeluaran = 'Rp' . number_format($sumOfJumlahPengeluaran, 2, ',', '.');

        return $sumOfJumlahPengeluaran;
    }


    public function totalKategoriPengeluaran()
    {
        $categoryTotals = Pengeluaran::select('nama_kategori', \DB::raw('SUM(CAST(kuantitas AS NUMERIC) * CAST(harga_peritem AS NUMERIC)) as total'))
            ->where('user_id', auth()->id())
            ->groupBy('nama_kategori')
            ->get();

            $formattedData = json_encode($categoryTotals);

            return $formattedData;
    }
}
