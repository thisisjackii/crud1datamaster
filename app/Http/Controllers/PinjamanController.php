<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PinjamanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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

            Pinjaman::create([
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
}
