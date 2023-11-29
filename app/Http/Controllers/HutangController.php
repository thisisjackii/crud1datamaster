<?php

namespace App\Http\Controllers;

use App\Models\Hutang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class HutangController extends Controller
{
    public function index()
    {
        return view('page.admin.keuangan.hutang.index');
    }

    public function dataTable(Request $request)
    {
        if ($request->ajax()) {
            $columns = [
                'rekening',
                'jumlah_hutang',
                'nama_pemberi_hutang',
                'catatan_hutang',
                'tanggal_hutang',
                'jam_hutang',
                'tanggal_jatuh_tempo',
                'jam_jatuh_tempo',
                'status',
                'id',
            ];

            $data = Hutang::select($columns);

            return DataTables::of($data)
                ->addColumn('options', function ($row) {
                    $url = route('hutang.edit', ['id' => $row->id]);
                    $urlHapus = route('hutang.delete', $row->id);

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

    public function tambahHutang(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'rekening' => 'required|string',
                'jumlah_hutang' => 'required|numeric',
                'nama_pemberi_hutang' => 'required|string',
                'catatan_hutang' => 'required|string',
                'tanggal_hutang' => 'required|date',
                'jam_hutang' => 'required',
                'tanggal_jatuh_tempo' => 'required|date',
                'jam_jatuh_tempo' => 'required',
                'status' => 'required|in:Belum Lunas,Sudah Lunas',
            ]);

            Hutang::create([
                'rekening' => $request->rekening,
                'jumlah_hutang' => $request->jumlah_hutang,
                'nama_pemberi_hutang' => $request->nama_pemberi_hutang,
                'catatan_hutang' => $request->catatan_hutang,
                'tanggal_hutang' => $request->tanggal_hutang,
                'jam_hutang' => $request->jam_hutang,
                'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
                'jam_jatuh_tempo' => $request->jam_jatuh_tempo,
                'status' => $request->status,
            ]);

            return redirect()->route('hutang.add')->with('status', 'Data telah tersimpan di database');
        }

        return view('page.admin.keuangan.hutang.addHutang');
    }

    public function ubahHutang($id, Request $request)
    {
        $hutang = Hutang::findOrFail($id);

        if ($request->isMethod('post')) {
            $this->validate($request, [
                'rekening' => 'required|string',
                'jumlah_hutang' => 'required|numeric',
                'nama_pemberi_hutang' => 'required|string',
                'catatan_hutang' => 'required|string',
                'tanggal_hutang' => 'required|date',
                'jam_hutang' => 'required',
                'tanggal_jatuh_tempo' => 'required|date',
                'jam_jatuh_tempo' => 'required',
                'status' => 'required|in:Belum Lunas,Sudah Lunas',
            ]);

            $hutang->update([
                'rekening' => $request->rekening,
                'jumlah_hutang' => $request->jumlah_hutang,
                'nama_pemberi_hutang' => $request->nama_pemberi_hutang,
                'catatan_hutang' => $request->catatan_hutang,
                'tanggal_hutang' => $request->tanggal_hutang,
                'jam_hutang' => $request->jam_hutang,
                'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
                'jam_jatuh_tempo' => $request->jam_jatuh_tempo,
                'status' => $request->status,
            ]);

            return redirect()->route('hutang.index', ['id' => $hutang->id])->with('status', 'Data telah tersimpan di database');
        }

        return view('page.admin.keuangan.hutang.ubahHutang', [
            'hutang' => $hutang
        ]);
    }

    public function hapusHutang($id)
    {
        $hutang = Hutang::findOrFail($id);
        $hutang->delete();

        return response()->json([
            'msg' => 'Data yang dipilih telah dihapus'
        ]);
    }
}
