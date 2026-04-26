@extends('template-admin.layout')

@section('content')
<section class="pc-container">
    <div class="pc-content">
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard-superadmin">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0)">Master Materi</a></li>
                <li class="breadcrumb-item" aria-current="page">Form Tambah Materi</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Form Tambah Materi</h2>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5>Form Tambah Materi</h5>
            </div>
            <div class="card-body">
              <form action="{{ route('materi.store') }}" method="POST">
                @csrf
                <div class="form-group">
                  <label class="form-label">Mata Pelajaran</label>
                  <select name="mapel_id" class="form-control" required>
                      <option value="">Pilih Mata Pelajaran & Kelas</option>
                      @foreach($mapels as $mapel)
                          <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }} - Kelas {{ $mapel->kelas }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label class="form-label">Bab</label>
                  <input type="text" name="bab" class="form-control" placeholder="Bab" required>
                </div>
                <div class="form-group">
                  <label class="form-label">Judul Materi</label>
                  <input type="text" name="judul" class="form-control" placeholder="Judul Materi" required>
                </div>
                <div class="form-group">
                  <label class="form-label">Deskripsi</label>
                  <input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi Singkat" required>
                </div>
                <div class="form-group">
                  <label class="form-label">Isi Materi</label>
                  <textarea name="isi_materi" id="tinymce-editor" class="form-control" rows="5" placeholder="Isi Materi"></textarea>
                </div>
                <div class="card-footer text-end">
                  <button type="submit" class="btn btn-primary me-2">Submit</button>
                  <a href="{{ route('materi.index') }}" class="btn btn-light">Kembali</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('script')
<!-- TinyMCE js -->
<script src="{{ asset('admin') }}/assets/js/plugins/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        height: '400',
        selector: '#tinymce-editor',
        content_style: 'body { font-family: "Inter", sans-serif; }',
        menubar: false,
        toolbar: [
            'styleselect fontselect fontsizeselect',
            'undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify',
            'bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview | code'
        ],
        plugins: 'advlist autolink link image lists charmap print preview code',
        images_upload_handler: function (blobInfo, success, failure) {
            return new Promise((resolve, reject) => {
                var xhr, formData;
                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '{{ route('materi.upload.image') }}');
                var token = '{{ csrf_token() }}';
                xhr.setRequestHeader("X-CSRF-TOKEN", token);

                xhr.onload = function() {
                    var json;
                    if (xhr.status != 200) {
                        if (typeof failure === 'function') failure('HTTP Error: ' + xhr.status);
                        reject('HTTP Error: ' + xhr.status);
                        return;
                    }
                    json = JSON.parse(xhr.responseText);
                    if (!json || typeof json.location != 'string') {
                        if (typeof failure === 'function') failure('Invalid JSON: ' + xhr.responseText);
                        reject('Invalid JSON: ' + xhr.responseText);
                        return;
                    }
                    if (typeof success === 'function') success(json.location);
                    resolve(json.location);
                };
                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            });
        }
    });
</script>
@endsection