<?php

namespace App\Http\Controllers;

use App\Models\Finance as FinanceModel;
use App\Models\User;
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
            ->orWhere('kategori', 'like', "%$search%")
            ->orWhere('sub_kategori', 'like', "%$search%")
            ->orWhere('detail', 'like', "%$search%")
            ->get();

            $total_pemasukan = FinanceModel::where('kategori', 'Pemasukan')->sum('jumlah_rupiah');
            $total_pengeluaran = FinanceModel::where('kategori', 'Pengeluaran')->sum('jumlah_rupiah');
            $balance_now = $total_pemasukan - $total_pengeluaran;
        } else {
            $finance = FinanceModel::with('pencatat')->get(); 
            $total_pemasukan = FinanceModel::where('kategori', 'Pemasukan')->sum('jumlah_rupiah');
            $total_pengeluaran = FinanceModel::where('kategori', 'Pengeluaran')->sum('jumlah_rupiah');
            $balance_now = $total_pemasukan - $total_pengeluaran;
        }
        $users = User::select('id', 'name')->orderBy('name', 'asc')->get();
        $kategoriTransaksi = DB::table('finance')
                            ->distinct()
                            ->pluck('sub_kategori');
        
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
                'detail' => 'required|string|max:255',
                'pencatat' => ['required', 'integer', 'exists:users,id'], // contoh: harus ada di tabel `users`
                'jumlah_rupiah' => ['required', 'regex:/^\d{1,3}(\.\d{3})*$/'],
                'tipe_transaksi' => 'required|string|max:255',
                'kategori_transaksi' => 'required|string|max:255',
            ]);

            $finance = new FinanceModel();
            $finance->tgl_proses = convertDate($validated['tanggal_proses']);
            $finance->id_pencatat = (int) $validated['pencatat'];
            $finance->jumlah_rupiah = (int) str_replace('.', '', $validated['jumlah_rupiah']);
            $finance->kategori = $validated['tipe_transaksi'];
            $finance->sub_kategori = $validated['kategori_transaksi'];
            $finance->detail = $validated['detail'];
            $finance->save();

            return redirect()->route('finance.index')->with('success', 'Data transaksi berhasil disimpan!');
        } catch (\Throwable $e) {
            return redirect()->route('user.index')->with('error', $e->getMessage());
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
