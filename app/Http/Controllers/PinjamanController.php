<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use App\Exports\pinjamanExport;
use App\Imports\pinjamanImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use App\Http\Controllers\RiwayatController;

class PinjamanController extends Controller
{
    private $riwayatController;
    public function __construct(RiwayatController $riwayatController)
    {
        $this->middleware('auth');
        $this->riwayatController = $riwayatController;
    }
    public function index()
    {
        return view('page.admin.keuangan.pinjaman.index');
    }

    public function dataTable(Request $request)
    {
        if ($request->ajax()) {
            $data = Pinjaman::where('user_id', auth()->id())->select('rekening', 'jumlah_pinjaman', 'nama_diberi_pinjaman', 'catatan_pinjaman', 'tanggal_pinjaman', 'jam_pinjaman', 'tanggal_jatuh_tempo', 'jam_jatuh_tempo', 'status', 'id');

            return DataTables::of($data)
                ->addColumn('options', function ($row) {
                    $url = route('pinjaman.edit', ['id' => $row->id]);
                    $urlHapus = route('pinjaman.delete', $row->id);

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

    public function tambahPinjaman(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'rekening' => 'required|string',
                'jumlah_pinjaman' => 'required|numeric',
                'nama_diberi_pinjaman' => 'required|string',
                'catatan_pinjaman' => 'required|string',
                'tanggal_pinjaman' => 'required|date',
                'jam_pinjaman' => 'required',
                'tanggal_jatuh_tempo' => 'required|date',
                'jam_jatuh_tempo' => 'required',
                'status' => 'required|in:Belum Lunas,Sudah Lunas',
            ]);

            $pinjaman = Pinjaman::create([
                'rekening' => $request->rekening === 'Lainnya' ? $request->custom_notes2 : $request->rekening,
                'jumlah_pinjaman' => $request->jumlah_pinjaman,
                'nama_diberi_pinjaman' => $request->nama_diberi_pinjaman,
                'catatan_pinjaman' => $request->catatan_pinjaman,
                'tanggal_pinjaman' => $request->tanggal_pinjaman,
                'jam_pinjaman' => $request->jam_pinjaman,
                'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
                'jam_jatuh_tempo' => $request->jam_jatuh_tempo,
                'status' => $request->status,
                'user_id' => auth()->id(),
            ]);

            // Create Riwayat entry
            $this->riwayatController->tambahRiwayat('PNJ', $pinjaman->id, $pinjaman->tanggal_pinjaman, $pinjaman->jam_pinjaman, $pinjaman->user_id);

            return redirect()->route('pinjaman.add')->with('status', 'Data telah tersimpan di database');
        }

        return view('page.admin.keuangan.pinjaman.addPinjaman');
    }

    public function ubahPinjaman($id, Request $request)
    {
        $pinjaman = Pinjaman::where('user_id', auth()->id())->findOrFail($id);

        if ($request->isMethod('post')) {
            $this->validate($request, [
                'rekening' => 'required|string',
                'jumlah_pinjaman' => 'required|numeric',
                'nama_diberi_pinjaman' => 'required|string',
                'catatan_pinjaman' => 'required|string',
                'tanggal_pinjaman' => 'required|date',
                'jam_pinjaman' => 'required',
                'tanggal_jatuh_tempo' => 'required|date',
                'jam_jatuh_tempo' => 'required',
                'status' => 'required|in:Belum Lunas,Sudah Lunas',
            ]);

            $pinjaman->update([
                'rekening' => $request->rekening === 'Lainnya' ? $request->custom_notes2 : $request->rekening,
                'jumlah_pinjaman' => $request->jumlah_pinjaman,
                'nama_diberi_pinjaman' => $request->nama_diberi_pinjaman,
                'catatan_pinjaman' => $request->catatan_pinjaman,
                'tanggal_pinjaman' => $request->tanggal_pinjaman,
                'jam_pinjaman' => $request->jam_pinjaman,
                'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
                'jam_jatuh_tempo' => $request->jam_jatuh_tempo,
                'status' => $request->status,
            ]);

            return redirect()->route('pinjaman.index', ['id' => $pinjaman->id])->with('status', 'Data telah tersimpan di database');
        }

        return view('page.admin.keuangan.pinjaman.ubahPinjaman', [
            'pinjaman' => $pinjaman
        ]);
    }

    public function hapusPinjaman($id)
    {
        $pinjaman = Pinjaman::where('user_id', auth()->id())->findOrFail($id);
        $pinjaman->delete();

        return response()->json([
            'msg' => 'Data yang dipilih telah dihapus'
        ]);
    }

    public function exportPdf()
    {
        $user_id = auth()->id();
        return (new PinjamanExport)->forUserId($user_id)->download('pinjaman.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function export()
    {
        $user_id = auth()->id();
        return (new PinjamanExport)->forUserId($user_id)->download('pinjaman.xlsx');
    }


    public function getBelumLunasValue(){
        $result = Pinjaman::where('user_id', auth()->id())
                ->where('status', 'Belum Lunas')
                ->sum('jumlah_pinjaman');

        return $result;
    }

    public function getSudahLunasValue(){
        $result = Pinjaman::where('user_id', auth()->id())
                ->where('status', 'Sudah Lunas')
                ->sum('jumlah_pinjaman');
                
        return $result;
    }   

    public function totalKategoriPinjaman()
    {
        $categoryTotals = Pinjaman::select('status', \DB::raw('SUM(CAST(jumlah_pinjaman AS NUMERIC)) as total'))
            ->where('user_id', auth()->id())
            ->groupBy('status')
            ->get();

            $formattedData = json_encode($categoryTotals);

            return $formattedData;
    }    

}
