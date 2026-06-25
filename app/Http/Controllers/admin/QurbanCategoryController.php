<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\QurbanCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class QurbanCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role !== 'admin') {
                abort(403, 'Akses Ditolak');
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $query = QurbanCategory::query();

        if ($request->search) {
            $query->where('nama_kategori', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_kategori', 'like', '%' . $request->search . '%');
        }

        $categories = $query->orderBy('kode_kategori')->paginate(10)->withQueryString();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_kategori' => 'required|string|max:50|unique:qurban_categories,kode_kategori',
            'nama_kategori' => 'required|string|max:255',
            'target_dana' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
        ], [
            'kode_kategori.required' => 'Kode kategori wajib diisi.',
            'kode_kategori.unique' => 'Kode kategori sudah digunakan.',
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'target_dana.required' => 'Target dana wajib diisi.',
            'target_dana.numeric' => 'Target dana harus berupa angka.',
        ]);

        QurbanCategory::create($request->all());
        Alert::success('Berhasil', 'Kategori qurban berhasil ditambahkan.');
        return redirect()->route('categories.index');
    }

    public function edit(QurbanCategory $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, QurbanCategory $category)
    {
        $request->validate([
            'kode_kategori' => 'required|string|max:50|unique:qurban_categories,kode_kategori,' . $category->id,
            'nama_kategori' => 'required|string|max:255',
            'target_dana' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
        ], [
            'kode_kategori.required' => 'Kode kategori wajib diisi.',
            'kode_kategori.unique' => 'Kode kategori sudah digunakan.',
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'target_dana.required' => 'Target dana wajib diisi.',
            'target_dana.numeric' => 'Target dana harus berupa angka.',
        ]);

        $category->update($request->all());
        Alert::success('Berhasil', 'Kategori qurban berhasil diperbarui.');
        return redirect()->route('categories.index');
    }

    public function destroy(QurbanCategory $category)
    {
        // Cek apakah kategori sedang digunakan di targets
        if ($category->targets()->exists()) {
            Alert::error('Gagal', 'Kategori ini tidak dapat dihapus karena memiliki peserta terdaftar.');
            return back();
        }

        $category->delete();
        Alert::success('Berhasil', 'Kategori qurban berhasil dihapus.');
        return redirect()->route('categories.index');
    }
}
