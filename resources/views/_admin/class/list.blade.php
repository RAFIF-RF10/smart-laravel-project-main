<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                {{-- HEADER --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h4 class="fw-bolder mb-4">{{ $page['title'] }}</h4>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ base_url($page['route'] . '/add') }}" class="btn btn-primary fw-bold bg-gradient" navigate>
                            @include('_admin._layout.icons.plus')
                            <b>Tambah Kelas</b>
                        </a>
                    </div>
                </div>

                {{-- TABEL --}}
                <div class="table-responsive-sm">
                    <table class="table table-bordered table-hover mt-3 table-sm">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 70%">Nama Kelas & Siswa</th>
                                <th style="width: 30%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $cls)
                                <tr>
                                    <td>
                                        <span data-bs-toggle="collapse" href="#siswa-kelas-{{ $cls->id }}" role="button" aria-expanded="false" aria-controls="siswa-kelas-{{ $cls->id }}">
                                            <b>{{ $cls->class_name }}</b>
                                            <small class="text-muted">(Klik untuk lihat siswa)</small>
                                        </span>
                                        <div class="collapse mt-2" id="siswa-kelas-{{ $cls->id }}">
                                            @if (isset($cls->students) && count($cls->students))
                                                <ol class="mb-0 ps-3">
                                                    @foreach ($cls->students as $siswa)
                                                        <li>{{ $siswa->name }} ({{ ucfirst($siswa->gender) }})</li>
                                                    @endforeach
                                                </ol>
                                            @else
                                                <p class="text-muted ps-3">Belum ada siswa</p>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown">⋮</button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href="{{ base_url($page['route'] . "/update/{$cls->id}") }}" navigate>Edit</a>
                                                </li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <a class="dropdown-item text-danger"
                                                       href="{{ base_url($page['route'] . "/delete/{$cls->id}") }}"
                                                       confirm-message="Apakah kamu yakin menghapus kelas {{ $cls->class_name }}?"
                                                       navigate-api-confirm>Hapus</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                @include('_admin._layout.components.empty-data', ['title' => $page['title']])
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                <div>
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ url('admin-ui') }}/assets/js/paginate.js"></script>
