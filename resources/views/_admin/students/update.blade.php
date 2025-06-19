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
                            <input type="text" class="form-control" name="name" id="name"
                                value="{{ $data->name }}">
                        </div>

                        <div class="mb-3">
                            <label for="gender" class="form-label">Jenis Kelamin</label>
                            <select name="gender" id="gender" class="form-select">
                                <option value="">- Pilih Jenis Kelamin -</option>
                                <option value="L" @selected($data->gender == "L")>Laki-laki</option>
                                <option value="P" @selected($data->gender == "P")>Perempuan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="class_id" class="form-label">Kelas</label>
                            <select name="class_id" id="class_id" class="form-select">
                                <option value="">- Pilih Kelas -</option>
                                @foreach ($classList as $kelas)
                                    <option value="{{ $kelas->id }}" @selected($data->class_id == $kelas->id)>
                                        {{ $kelas->class_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary bg-gradient"><b>Simpan Perubahan</b></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
