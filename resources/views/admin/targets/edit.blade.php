@extends('template-admin.layout')
@section('title', 'Edit Target Qurban')

@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('targets.index') }}">Target Qurban</a></li>
                        <li class="breadcrumb-item active">Edit Program</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <h2 class="mb-0" style="color: #064e3b; font-weight: 800;"><i class="fa fa-edit me-1"></i> Edit Target Qurban Peserta</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Formulir Perubahan Keikutsertaan Qurban</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('targets.update', $target) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label class="form-label" for="participant_id">Pilih Peserta</label>
                            <select name="participant_id" id="participant_id" class="form-select @error('participant_id') is-invalid @enderror" required>
                                @foreach($participants as $participant)
                                    <option value="{{ $participant->id }}" {{ old('participant_id', $target->participant_id) == $participant->id ? 'selected' : '' }}>
                                        {{ $participant->nama }} (NIK: {{ $participant->nik }})
                                    </option>
                                @endforeach
                            </select>
                            @error('participant_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="category_id">Pilih Kategori Qurban</label>
                            <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" data-target="{{ (int)$category->target_dana }}" {{ old('category_id', $target->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->nama_kategori }} (Target: Rp {{ number_format($category->target_dana, 0, ',', '.') }})
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="target_dana">Target Dana (Rp)</label>
                            <input type="number" name="target_dana" id="target_dana" class="form-control @error('target_dana') is-invalid @enderror" value="{{ old('target_dana', $target->target_dana) }}" placeholder="Target dana program" required min="0">
                            @error('target_dana')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="tahun_qurban">Tahun Qurban (Masehi)</label>
                            <input type="number" name="tahun_qurban" id="tahun_qurban" class="form-control @error('tahun_qurban') is-invalid @enderror" value="{{ old('tahun_qurban', $target->tahun_qurban) }}" placeholder="Contoh: 2026" required min="2020" max="2100">
                            @error('tahun_qurban')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{ route('targets.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#category_id').change(function() {
            var selectedOption = $(this).find('option:selected');
            var target = selectedOption.data('target');
            if(target !== undefined) {
                $('#target_dana').val(target);
            }
        });
    });
</script>
@endsection
