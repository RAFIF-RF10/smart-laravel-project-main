    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    @include('_admin._layout.components.form-header', ['type' => "Tambah"])

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

                        <form method="POST" action="{{ base_url($page['route'] . '/add') }}" navigate-form>

                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="class_id" class="form-label">Kelas</label>
                        <select class="form-select" id="class_id" name="class_id" required>
                            <option value="">Pilih Kelas</option>
                            @foreach ($classList as $class)
                                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ base_url($page['route'] . '/') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
