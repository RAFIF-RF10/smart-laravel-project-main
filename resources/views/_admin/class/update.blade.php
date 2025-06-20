<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-body">
                @include('_admin._layout.components.form-header', ['type' => "Edit"])

                <div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <b>Terjadi kesalahan pada proses input data</b> <br>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ base_url($page['route'] . '/update/' . $data->id) }}" navigate-form>
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="class_name" id="name"
                                value="{{ $data->class_name }}">
                        </div>



                        <button type="submit" class="btn btn-primary bg-gradient"><b>Simpan Perubahan</b></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
