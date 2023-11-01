<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PengeluaranController extends Controller
{
    public function index()
    {
        return view('page.admin.keuangan.pengeluaran.index');
    }
    public function dataTable(Request $request)
    {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
            0 => 'nama_kategori',
            1 => 'nama_pengeluaran',
            2 => 'tujuan_transaksi',
            3 => 'kuantitas',
            4 => 'harga_peritem',
            5 => 'tanggal',
            6 => 'jam',
        );

        $totalDataRecord = Pengeluaran::count();

        $totalFilteredRecord = $totalDataRecord;

        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $pengeluaran_data = Pengeluaran::where('id','!=',Pengeluaran::id())
            ->offset($start_val)
            ->limit($limit_val)
            ->orderBy($order_val,$dir_val)
            ->get();
        } else {
            $search_text = $request->input('search.value');

            $pengeluaran_data =  Pengeluaran::where('id','!=',Pengeluaran::id())
            ->where('id','LIKE',"%{$search_text}%")
            ->orWhere('nama_kategori', 'LIKE',"%{$search_text}%")
            ->orWhere('nama_pengeluaran', 'LIKE',"%{$search_text}%")
            ->orWhere('tujuan_transaksi', 'LIKE',"%{$search_text}%")
            ->orWhere('kuantitas', 'LIKE',"%{$search_text}%")
            ->orWhere('harga_peritem', 'LIKE',"%{$search_text}%")
            ->orWhere('tanggal', 'LIKE',"%{$search_text}%")
            ->orWhere('jam', 'LIKE',"%{$search_text}%")
            ->offset($start_val)
            ->limit($limit_val)
            ->orderBy($order_val,$dir_val)
            ->get();

            $totalFilteredRecord = Pengeluaran::where('id','!=',Pengeluaran::id())
            ->where('id','LIKE',"%{$search_text}%")
            ->orWhere('nama_kategori', 'LIKE',"%{$search_text}%")
            ->orWhere('nama_pengeluaran', 'LIKE',"%{$search_text}%")
            ->orWhere('tujuan_transaksi', 'LIKE',"%{$search_text}%")
            ->orWhere('kuantitas', 'LIKE',"%{$search_text}%")
            ->orWhere('harga_peritem', 'LIKE',"%{$search_text}%")
            ->orWhere('tanggal', 'LIKE',"%{$search_text}%")
            ->orWhere('jam', 'LIKE',"%{$search_text}%")
            ->count();
        }

        $data_val = array();
        if(!empty($pengeluaran_data))
        {
            foreach ($pengeluaran_data as $pengeluaran_val)
            {
                $url = route('pengeluaran.edit',['id' => $pengeluaran_val->id]);
                $urlHapus = route('pengeluaran.delete',$pengeluaran_val->id);
                $pengeluarannestedData['nama_kategori'] = $pengeluaran_val->nama_kategori;
                $pengeluarannestedData['nama_pengeluaran'] = $pengeluaran_val->nama_pengeluaran;
                $pengeluarannestedData['tujuan_transaksi'] = $pengeluaran_val->tujuan_transaksi;
                $pengeluarannestedData['kuantitas'] = $pengeluaran_val->kuantitas;
                $pengeluarannestedData['harga_peritem'] = $pengeluaran_val->harga_peritem;
                $pengeluarannestedData['tanggal'] = $pengeluaran_val->tanggal;
                $pengeluarannestedData['jam'] = $pengeluaran_val->jam;
                $pengeluarannestedData['options'] = "<a href='$url'><i class='fas fa-edit fa-lg'></i></a> <a style='border: none; background-color:transparent;' class='hapusData' data-id='$pengeluaran_val->id' data-url='$urlHapus'><i class='fas fa-trash fa-lg text-danger'></i></a>";
                $data_val[] = $pengeluarannestedData;
            }
        }
        $draw_val = $request->input('draw');
        $get_json_data = array(
        "draw"            => intval($draw_val),
        "recordsTotal"    => intval($totalDataRecord),
        "recordsFiltered" => intval($totalFilteredRecord),
        "data"            => $data_val
        );

        echo json_encode($get_json_data);
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
                'frekuensi' => 'required|numeric',
                'harga_peritem' => 'required|numeric',
                'tanggal' => 'required|date',
                'jam' => 'required',
            ]);

            $pengeluaran->update([
                'nama_kategori' => $request->nama_kategori,
                'nama_pengeluaran' => $request->nama_pengeluaran,
                'tujuan_transaksi' => $request->tujuan_transaksi,
                'frekuensi' => $request->frekuensi,
                'harga_peritem' => $request->harga_peritem,
                'tanggal' => $request->tanggal,
                'jam' => $request->jam,
            ]);

            return redirect()->route('pengeluaran.edit', ['id' => $pengeluaran->id])->with('status', 'Data telah tersimpan di database');
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

