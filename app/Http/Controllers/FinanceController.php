<?php

namespace App\Http\Controllers;

use App\Models\Finance as FinanceModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $finance = FinanceModel::whereHas('pencatat', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
            ->orWhereHas('finance', function ($query) use ($search) {
                $query->where('kategori', 'like', "%$search%");
            })
            ->orWhereHas('subkat2finance', function ($query) use ($search) {
                $query->where('sub_kategori', 'like', "%$search%");
            })
            ->orWhere('detail', 'like', "%$search%")
            ->get();

        } else {
            $finance = FinanceModel::with('pencatat')->get(); 
        }

        $total_pemasukan = FinanceModel::where('id_kategori', 1)->sum('jumlah_rupiah');
        $total_pengeluaran = FinanceModel::where('id_kategori', 2)->sum('jumlah_rupiah');
        $balance_now = $total_pemasukan - $total_pengeluaran;

        $users = User::select('id', 'name')->orderBy('name', 'asc')->get();
        
        $kategoriTransaksi = DB::table('finance')
                            ->join('sub_kategori', 'finance.id_sub_kategori', '=', 'sub_kategori.id')
                            ->distinct()
                            ->pluck('sub_kategori.sub_kategori');
        
        return view('finance.finance_index', compact('finance', 'total_pemasukan', 'total_pengeluaran', 'users', 'balance_now', 'kategoriTransaksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'tanggal_proses' => 'required|string|max:255',
                'waktu' => 'required|string|max:255',
                'detail' => 'required|string|max:255',
                'pencatat' => ['required', 'integer', 'exists:users,id'], // contoh: harus ada di tabel `users`
                'jumlah_rupiah' => ['required', 'regex:/^\d{1,3}(\.\d{3})*$/'],
                'tipe_transaksi' => 'required|string|max:255',
                'kategori_transaksi' => 'required|string|max:255',
            ]);

            $finance = new FinanceModel();
            $finance->tgl_proses = $validated['tanggal_proses'] . ' ' . $validated['waktu'];
            $finance->id_pencatat = (int) $validated['pencatat'];
            $finance->jumlah_rupiah = (int) str_replace('.', '', $validated['jumlah_rupiah']);
            $finance->kategori = $validated['tipe_transaksi'];
            $finance->sub_kategori = $validated['kategori_transaksi'];
            $finance->detail = $validated['detail'];
            $finance->save();

            return redirect()->route('finance.index')->with('success', 'Data transaksi berhasil disimpan!');
        } catch (\Throwable $e) {
            return redirect()->route('finance.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $finance = FinanceModel::findOrFail($id);
        $date = Carbon::parse($finance->tgl_proses);
        $tanggalProses = $date->format('Y-m-d');
        $waktuProses = $date->format('H:i:s');

        $users = User::all();
        $user = User::find($finance->id_pencatat);
        $id_user = User::find($finance->id);

        $kategoriTransaksi = DB::table('finance')
                    ->join('sub_kategori', 'finance.id_sub_kategori', '=', 'sub_kategori.id')
                    ->distinct()
                    ->whereNull('deleted_at')
                    ->pluck('sub_kategori.sub_kategori');
        return view('finance.finance_detail', compact('finance', 'tanggalProses', 'waktuProses', 'user', 'users', 'id_user', 'kategoriTransaksi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'tanggal_proses' => 'required|string|max:255',
                'waktu' => 'required|string|max:255',
                'detail' => 'required|string|max:255',
                'pencatat' => ['required', 'integer', 'exists:users,id'], 
                'jumlah_rupiah' => 'required|string|max:255',
                'tipe_transaksi' => 'required|string|max:255',
                'kategori' => 'required|string|max:255',
            ]);

            $id_pencatat = (int) $validated['pencatat'];
            $waktu_proses = $validated['tanggal_proses'] . ' ' . $validated['waktu'];
            $detail = $validated['detail'];

            $formatted = $validated['jumlah_rupiah']; 
            $jml_rp_clean = str_replace(['Rp', '.', ' '], '', $formatted);
            $jml_rp_push = (int) $jml_rp_clean;

            $tipe = $validated['tipe_transaksi'];
            $kategori = $validated['kategori'];

            $dataUpdate = [
                'tgl_proses' => $waktu_proses,
                'id_pencatat' => $id_pencatat,
                'jumlah_rupiah' => $jml_rp_push,
                'kategori' => $tipe,
                'sub_kategori' => $kategori,
                'detail' => $detail,
            ];
            $idFinance = (int) $request->id;

            FinanceModel::where('id', $idFinance)->update($dataUpdate);
            return redirect()->route('finance.index')->with('success', 'Data transaksi berhasil diubah!');
        } catch (QueryException $e) {
            return redirect()->route('finance.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            FinanceModel::findOrFail($id)->delete();

            return redirect()->route('finance.index')->with('success', 'User deleted successfully!');
        } catch (QueryException $e) {
            $message = $e->getMessage();
            dd($message);
            return redirect()->route('finance.index')->with('error', $message);
        }
    }
}
