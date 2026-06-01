<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankSampahMitra;
use App\Http\Requests\Admin\StoreBankSampahMitraRequest;
use App\Http\Requests\Admin\UpdateBankSampahMitraRequest;

class BankSampahMitraController extends Controller
{
    public function index()
    {
        $data = BankSampahMitra::withCount('rekapBankSampah')->orderBy('nama')->paginate(20);
        return view('admin.master.bank-sampah-mitra.index', compact('data'));
    }

    public function store(StoreBankSampahMitraRequest $request)
    {
        BankSampahMitra::create($request->validated());
        session()->flash('success', 'Bank sampah mitra berhasil ditambahkan.');
        return redirect()->route('admin.bank-sampah-mitra.index');
    }

    public function edit(BankSampahMitra $bankSampahMitra)
    {
        return response()->json($bankSampahMitra);
    }

    public function update(UpdateBankSampahMitraRequest $request, BankSampahMitra $bankSampahMitra)
    {
        $bankSampahMitra->update($request->validated());
        session()->flash('success', 'Bank sampah mitra berhasil diperbarui.');
        return redirect()->route('admin.bank-sampah-mitra.index');
    }

    public function destroy(BankSampahMitra $bankSampahMitra)
    {
        if ($bankSampahMitra->rekapBankSampah()->count() > 0) {
            session()->flash('error', 'Bank sampah mitra tidak dapat dihapus karena memiliki data rekap.');
            return redirect()->route('admin.bank-sampah-mitra.index');
        }
        $bankSampahMitra->delete();
        session()->flash('success', 'Bank sampah mitra berhasil dihapus.');
        return redirect()->route('admin.bank-sampah-mitra.index');
    }

    public function toggle(BankSampahMitra $bankSampahMitra)
    {
        $bankSampahMitra->update(['aktif' => !$bankSampahMitra->aktif]);
        $status = $bankSampahMitra->aktif ? 'diaktifkan' : 'dinonaktifkan';
        session()->flash('success', "Bank sampah mitra berhasil {$status}.");
        return redirect()->route('admin.bank-sampah-mitra.index');
    }
}
