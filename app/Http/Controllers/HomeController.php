<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\HutangController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\TransferController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(PemasukanController $pemasukanController, PengeluaranController $pengeluaranController, HutangController $hutangController, PinjamanController $pinjamanController, TransferController $transferController)
    {
        $sumOfJumlahPemasukan = $pemasukanController->jumlahPemasukan();
        $sumOfJumlahPengeluaran = $pengeluaranController->jumlahPengeluaran();
        $categoryTotalsPemasukan = $pemasukanController->totalKategoriPemasukan();
        $categoryTotalsPengeluaran = $pengeluaranController->totalKategoriPengeluaran();
        $categoryTotalsTransfer = $transferController->totalKategoriTransfer();
        $categoryTotalsHutang = $hutangController->totalKategoriHutang();
        $categoryTotalsPinjaman = $pinjamanController->totalKategoriPinjaman();

        $sumOfBelumLunasValueHutang = $hutangController->getBelumLunasValue();
        $sumOfBelumLunasValuePinjaman = $pinjamanController->getBelumLunasValue();
        $sumOfSudahLunasValueHutang = $hutangController->getSudahLunasValue();
        $sumOfSudahLunasValuePinjaman = $pinjamanController->getSudahLunasValue();
        $sumOfJumlahTransfer = $transferController->jumlahTransfer();

        $totalAkhirPengeluaran = $sumOfJumlahPengeluaran + $sumOfSudahLunasValueHutang + $sumOfBelumLunasValuePinjaman + $sumOfJumlahTransfer;
        $totalAkhirPemasukan = $sumOfJumlahPemasukan + $sumOfBelumLunasValueHutang + $sumOfSudahLunasValuePinjaman;
 
        $formattedAkhirPengeluaran = 'Rp' . number_format($totalAkhirPengeluaran, 2, ',', '.');
        $formattedAkhirPemasukan = 'Rp' . number_format($totalAkhirPemasukan, 2, ',', '.'); 

        return view('home', compact('formattedAkhirPengeluaran','formattedAkhirPemasukan','categoryTotalsPemasukan','categoryTotalsPengeluaran', 'categoryTotalsTransfer', 'categoryTotalsHutang', 'categoryTotalsPinjaman'));
    }

    public function profile()
    {
        return view('page.admin.profile');
    }

    public function updateprofile(Request $request)
    {
        $usr = User::findOrFail(Auth::user()->id);
        if ($request->input('type') == 'change_profile') {
            $this->validate($request, [
                'name' => 'string|max:200|min:3',
                'email' => 'string|min:3|email',
                'user_image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1024'
            ]);
            $img_old = Auth::user()->user_image;
            if ($request->file('user_image')) {
                # delete old img
                if ($img_old && file_exists(public_path().$img_old)) {
                    unlink(public_path().$img_old);
                }
                $nama_gambar = time() . '_' . $request->file('user_image')->getClientOriginalName();
                $upload = $request->user_image->storeAs('public/admin/user_profile', $nama_gambar);
                $img_old = Storage::url($upload);
            }
            $usr->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'user_image' => $img_old
                ]);
            return redirect()->route('profile')->with('status', 'Perubahan telah tersimpan');
        } elseif ($request->input('type') == 'change_password') {
            $this->validate($request, [
                'password' => 'min:8|confirmed|required',
                'password_confirmation' => 'min:8|required',
            ]);
            $usr->update([
                'password' => Hash::make($request->password)
            ]);
            return redirect()->route('profile')->with('status', 'Perubahan telah tersimpan');
        }
    }
  
}
