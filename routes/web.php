<?php

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    try {
        $spkQuery = DB::table('spks');

        if ($request->filled('status')) {
            $spkQuery->where('status', $request->input('status'));
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $spkQuery->where(function ($query) use ($search) {
                $query->where('no_spk', 'like', "%{$search}%")
                    ->orWhere('customer', 'like', "%{$search}%")
                    ->orWhere('item_code', 'like', "%{$search}%")
                    ->orWhere('part_no', 'like', "%{$search}%")
                    ->orWhere('model', 'like', "%{$search}%");
            });
        }

        $spks = $spkQuery->paginate(10)->withQueryString();

        $statusCounts = DB::table('spks')
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $statusCounts = array_merge([
            'Finished' => 0,
            'On Going' => 0,
            'Pending' => 0,
        ], $statusCounts);

        $totalCount = array_sum($statusCounts);
    } catch (\Throwable $e) {
        $spks = new LengthAwarePaginator([], 0, 10, 1, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        $statusCounts = [
            'Finished' => 0,
            'On Going' => 0,
            'Pending' => 0,
        ];

        $totalCount = 0;
    }

    return view('dashboard', compact('spks', 'statusCounts', 'totalCount'));
})->name('dashboard');

Route::post('/spk', function (Request $request) {
    $data = $request->only([
        'no_spk', 'customer', 'item_code', 'part_no', 'model', 'po_number',
        'size', 'color', 'order_quantity', 'stock_quantity', 'production',
        'material', 'diameter_core', 'packing', 'spk_date', 'order_date',
        'keterangan', 'status',
    ]);

    $data['status'] = $data['status'] ?? 'Pending';

    DB::table('spks')->insert($data);

    return redirect()->route('dashboard')->with('success', 'SPK berhasil disimpan.');
})->name('spk.store');

Route::get('/spk/{id}/edit', function ($id) {
    $spk = DB::table('spks')->where('id', $id)->first();

    if (! $spk) {
        return redirect()->route('dashboard')->with('success', 'Data SPK tidak ditemukan.');
    }

    return view('add-data', ['spk' => $spk]);
})->name('spk.edit');

Route::put('/spk/{id}', function (Request $request, $id) {
    $data = $request->only([
        'no_spk', 'customer', 'item_code', 'part_no', 'model', 'po_number',
        'size', 'color', 'order_quantity', 'stock_quantity', 'production',
        'material', 'diameter_core', 'packing', 'spk_date', 'order_date',
        'keterangan', 'status',
    ]);

    DB::table('spks')->where('id', $id)->update($data);

    return redirect()->route('dashboard')->with('success', 'SPK berhasil diperbarui.');
})->name('spk.update');

Route::delete('/spk/{id}', function ($id) {
    DB::table('spks')->where('id', $id)->delete();

    return redirect()->route('dashboard')->with('success', 'SPK berhasil dihapus.');
})->name('spk.destroy');

Route::get('/spk/{id}/print', function ($id) {
    $spk = DB::table('spks')->where('id', $id)->first();

    if (! $spk) {
        return redirect()->route('dashboard')->with('success', 'Data SPK tidak ditemukan.');
    }

    return view('spk.print', ['spk' => $spk]);
})->name('spk.print');

Route::get('/add-data', function () {
    return view('add-data');
})->name('add-data');