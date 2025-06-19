<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h4 class="fw-bolder mb-4">{{ $page['title'] }}</h4>
                    </div>
                    <div class="col-md-6 text-end">
                        <div class="text-md-end text-start">
                            <a href="{{ base_url($page['route'] . '/add') }}" class="btn btn-primary btn fw-bold bg-gradient"
                                navigate>
                                @include('_admin._layout.icons.plus')
                                <b>Tambah Siswa</b>
                            </a>

                        </div>
                    </div>
                </div>

                {{-- FORM FILTER --}}
                <div class="card rounded-3 border-1 border-primary-subtle shadow-sm">
                    <div class="card-body p-3">
                        <p class="text-gray-md letter-spacing-2 fs-1 mb-2">PENCARIAN DATA SISWA</p>
                        <form action="{{ base_url($page['route']) }}" method="GET"
                            class="row gy-2 gx-3 align-items-center">
                            <input type="hidden" name="filter_on" value="true">
                            <div class="col-md mb-2">
                                <label class="visually-hidden" for="filter_name">Nama Siswa</label>
                                <input type="text" class="form-control" id="filter_name" autofocus name="filter_name"
                                    value="{{ $filter['filter_name'] ?? '' }}"
                                    placeholder="Cari berdasarkan nama siswa">
                            </div>

                            {{-- OPSIONAL: Filter Kelas --}}
                            @if (!empty($classList))
                                <div class="col-md-auto mb-2">
                                    <label class="visually-hidden" for="filter_class_id">Kelas</label>
                                    <select class="form-select" id="filter_class_id" name="filter_class_id">
                                        <option value="">Semua Kelas</option>
                                        @foreach ($classList as $cls)
                                            <option value="{{ $cls->id }}" @selected($cls->id == ($filter['filter_class_id'] ?? ''))>
                                                {{ $cls->class_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            <div class="mb-0">
                                <button type="submit" class="btn btn-primary bg-gradient"><b>Pencarian</b></button>
                                @if (!empty($filter['filter_on']))
                                    <a href="{{ base_url($page['route']) }}" class="btn btn-outline-warning ms-1"
                                        navigate>Reset Filter</a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive-sm">
                    <table class="table table-bordered table-hover mt-3 table-sm">
                        <thead class="table-light">
                            <tr>
                                <th class="table-header" style="--width: 80%">SISWA</th>
                                <th class="table-header text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                                <tr>
                                    <td>
                                        <div>
                                            <h5 class="mb-1 mt-2">
                                                <strong>{{ $d->name }}</strong>
                                            </h5>
                                            <p class="mb-0">Gender: {{ ucfirst($d->gender) }}</p>
                                            <p class="mb-0">Kelas: {{ $d->class_name }}</p>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button
                                                class="btn btn-light btn-sm shadow-sm border-1 border-primary-subtle"
                                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-dots">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M5 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                    <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                    <path d="M19 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                </svg>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item"
                                                        href="{{ base_url($page['route'] . "/update/{$d->id}") }}"
                                                        navigate>Edit</a></li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <a class="dropdown-item text-danger"
                                                    href="{{ base_url($page['route'] . "/delete/{$d->id}") }}"
                                                    confirm-message="Apakah kamu yakin menghapus {{ $d->name }}?"
                                                    navigate-api-confirm>Hapus</a>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- KOSONG --}}
                @if (!count($data))
                    @include('_admin._layout.components.empty-data', ['title' => $page['title']])
                @endif

                {{-- PAGINATION --}}
                <div>
                    {{ !empty($data) ? $data->links() : '' }}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ url('admin-ui') }}/assets/js/paginate.js"></script>
