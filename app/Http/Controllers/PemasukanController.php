<?php

namespace App\Http\Controllers;

// use App\Models\User;
use App\Models\Pemasukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use Yajra\DataTables\DataTables;

class PemasukanController extends Controller
{

    public function index()
    {
        return view('page.admin.keuangan.pemasukan.index');
    }

    public function dataTable(Request $request)
    {
        if ($request->ajax()) {
            $data = Pemasukan::select('*');
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

        // return view('page.admin.keuangan.pemasukan.index');
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
            ]);

            return redirect()->route('pemasukan.add')->with('status', 'Data telah tersimpan di database');
        }

        return view('page.admin.keuangan.pemasukan.addPemasukan');
    }

    public function ubahPemasukan($id, Request $request)
    {
        $pemasukan = Pemasukan::findOrFail($id);

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
        $pemasukan = Pemasukan::findOrFail($id);
        $pemasukan->delete();

        return response()->json([
            'msg' => 'Data yang dipilih telah dihapus'
        ]);
    }
}
