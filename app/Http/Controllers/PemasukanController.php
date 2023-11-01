<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PemasukanController extends Controller
{
    public function index()
    {
        return view('page.admin.keuangan.pemasukan.index');
    }

    public function dataTable(Request $request)
    {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
            0 => 'nama_kategori',
            1 => 'rekening',
            2 => 'jumlah_pemasukan',
            3 => 'catatan_pemasukan',
            4 => 'tanggal',
            5 => 'jam',
        );

        $totalDataRecord = Pemasukan::count();

        $totalFilteredRecord = $totalDataRecord;

        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $pemasukan_data = Pemasukan::where('id','!=',Pemasukan::id())
            ->offset($start_val)
            ->limit($limit_val)
            ->orderBy($order_val,$dir_val)
            ->get();
        } else {
            $search_text = $request->input('search.value');

            $pemasukan_data =  Pemasukan::where('id','!=',Pemasukan::id())
            ->where('id','LIKE',"%{$search_text}%")
            ->orWhere('nama_kategori', 'LIKE',"%{$search_text}%")
            ->orWhere('rekening', 'LIKE',"%{$search_text}%")
            ->orWhere('jumlah_pemasukan', 'LIKE',"%{$search_text}%")
            ->orWhere('catatan_pemasukan', 'LIKE',"%{$search_text}%")
            ->orWhere('tanggal', 'LIKE',"%{$search_text}%")
            ->orWhere('jam', 'LIKE',"%{$search_text}%")
            ->offset($start_val)
            ->limit($limit_val)
            ->orderBy($order_val,$dir_val)
            ->get();

            $totalFilteredRecord = Pemasukan::where('id','!=',Pemasukan::id())
            ->where('id','LIKE',"%{$search_text}%")
            ->orWhere('nama_kategori', 'LIKE',"%{$search_text}%")
            ->orWhere('rekening', 'LIKE',"%{$search_text}%")
            ->orWhere('jumlah_pemasukan', 'LIKE',"%{$search_text}%")
            ->orWhere('catatan_pemasukan', 'LIKE',"%{$search_text}%")
            ->orWhere('tanggal', 'LIKE',"%{$search_text}%")
            ->orWhere('jam', 'LIKE',"%{$search_text}%")
            ->count();
        }

        $data_val = array();
        if(!empty($pemasukan_data))
        {
            foreach ($pemasukan_data as $pemasukan_val)
            {
                $url = route('pemasukan.edit',['id' => $pemasukan_val->id]);
                $urlHapus = route('pemasukan.delete',$pemasukan_val->id);
                $pemasukannestedData['nama_kategori'] = $pemasukan_val->nama_kategori;
                $pemasukannestedData['rekening'] = $pemasukan_val->rekening;
                $pemasukannestedData['jumlah_pemasukan'] = $pemasukan_val->jumlah_pemasukan;
                $pemasukannestedData['catatan_pemasukan'] = $pemasukan_val->catatan_pemasukan;
                $pemasukannestedData['tanggal'] = $pemasukan_val->tanggal;
                $pemasukannestedData['jam'] = $pemasukan_val->jam;
                $pemasukannestedData['options'] = "<a href='$url'><i class='fas fa-edit fa-lg'></i></a> <a style='border: none; background-color:transparent;' class='hapusData' data-id='$pemasukan_val->id' data-url='$urlHapus'><i class='fas fa-trash fa-lg text-danger'></i></a>";
                $data_val[] = $pemasukannestedData;
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
                'nama_kategori' => $request->nama_kategori,
                'rekening' => $request->rekening,
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
                'nama_kategori' => $request->nama_kategori,
                'rekening' => $request->rekening,
                'jumlah_pemasukan' => $request->jumlah_pemasukan,
                'catatan_pemasukan' => $request->catatan_pemasukan,
                'tanggal' => $request->tanggal,
                'jam' => $request->jam,
            ]);

            return redirect()->route('pemasukan.edit', ['id' => $pemasukan->id])->with('status', 'Data telah tersimpan di database');
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
