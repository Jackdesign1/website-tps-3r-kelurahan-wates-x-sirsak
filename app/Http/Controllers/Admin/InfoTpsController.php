<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InfoTps;
use App\Http\Requests\Admin\UpdateInfoTpsRequest;

class InfoTpsController extends Controller
{
    public function edit()
    {
        $info = InfoTps::getInstance();
        return view('admin.info-tps.edit', compact('info'));
    }

    public function update(UpdateInfoTpsRequest $request)
    {
        $info = InfoTps::getInstance();
        $validated = $request->validated();
        $validated['deskripsi'] = strip_tags($validated['deskripsi'] ?? '');
        $info->update($validated);
        session()->flash('success', 'Informasi TPS berhasil diperbarui.');
        return redirect()->route('admin.info-tps.edit');
    }
}
