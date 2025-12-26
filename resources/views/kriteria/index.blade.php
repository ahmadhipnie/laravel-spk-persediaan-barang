@extends('layouts.app')
@section('title', 'Data Kriteria')
@section('subtitle', 'Master Data')

@section('content')


        <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-4 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
            <div class="flex justify-between items-center">
                <div>
                    <h6>Data Kriteria</h6>
                    <p class="text-sm text-slate-500">Kelola kriteria untuk perhitungan SAW</p>
                </div>
                <a href="{{ route('kriteria.create') }}"
                    class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
                    <i class="fas fa-plus"></i> Tambah Kriteria
                </a>
            </div>
        </div>

        @if(session('success'))
        <div class="mx-6 mt-4 px-4 py-3 text-sm rounded-lg bg-green-50 text-green-700">{{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="mx-6 mt-4 px-4 py-3 text-sm rounded-lg bg-red-50 text-red-700">{{ session('error') }}</div>
        @endif
        @if($errors->any())
        <div class="mx-6 mt-4 px-4 py-3 text-sm rounded-lg bg-red-50 text-red-700">
            <ul class="list-disc pl-5 mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="flex-auto p-4">
            <div class="overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                        <tr>
                            <th class="px-6 py-4 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">No</th>
                            <th class="px-6 py-4 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Kode</th>
                            <th class="px-6 py-4 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama Kriteria</th>
                            <th class="px-6 py-4 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Atribut</th>
                            <th class="px-6 py-4 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Bobot</th>
                            <th class="px-6 py-4 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kriteria as $i => $k)
                        <tr>
                            <td class="px-6 py-4 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent"><p class="mb-0 font-semibold leading-tight text-sm">{{ $i + 1 }}</p></td>
                            <td class="px-6 py-4 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent"><p class="mb-0 font-semibold leading-tight text-sm">{{ $k->kode_kriteria }}</p></td>
                            <td class="px-6 py-4 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent"><p class="mb-0 font-semibold leading-tight text-sm">{{ $k->nama_kriteria }}</p></td>
                            <td class="px-6 py-4 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent"><p class="mb-0 text-sm">{{ ucfirst($k->atribut) }}</p></td>
                            <td class="px-6 py-4 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent"><p class="mb-0 text-sm font-semibold">{{ $k->bobot }}</p></td>
                            <td class="px-6 py-4 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <a href="{{ route('kriteria.edit', $k->id) }}" class="inline-block px-3 py-2 mb-0 mr-2 font-bold text-center uppercase align-middle transition-all rounded-lg cursor-pointer leading-pro text-xs ease-soft-in hover:scale-105 active:opacity-85 text-white bg-blue-500 hover:bg-blue-600 shadow-md"><i class="fas fa-edit"></i></a>

                                <form action="{{ route('kriteria.destroy', $k->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Hapus kriteria? Data yang dihapus tidak dapat dikembalikan!')" class="px-3 py-2 mb-0 font-bold text-center uppercase align-middle transition-all rounded-lg cursor-pointer leading-pro text-xs ease-soft-in hover:scale-105 active:opacity-85 text-white bg-red-500 hover:bg-red-600 shadow-md"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-6 text-center">
                                <i class="fas fa-inbox text-4xl text-gray-300 mb-2"></i>
                                <p class="text-sm text-gray-500">Belum ada data kriteria</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        </div>
    </div>
</div>

    <div id="kriteriaModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-10 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="kriteriaModalTitle">Tambah Kriteria</h3>
            <form id="kriteriaForm" method="POST" action="{{ route('kriteria.store') }}">
                @csrf
                <input type="hidden" name="_method" id="kriteriaFormMethod" value="POST">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Kode Kriteria *</label>
                        <input type="text" name="kode_kriteria" id="kode_kriteria" required class="w-full rounded-lg border p-2" placeholder="K001">
                    </div>

                    <div>
                        <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Nama Kriteria *</label>
                        <input type="text" name="nama_kriteria" id="nama_kriteria" required class="w-full rounded-lg border p-2" placeholder="Nama kriteria">
                    </div>

                    <div>
                        <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Atribut *</label>
                        <select name="atribut" id="atribut" class="w-full rounded-lg border p-2" required>
                            <option value="benefit">Benefit</option>
                            <option value="cost">Cost</option>
                        </select>
                    </div>

                    <div>
                        <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Bobot (0-1) *</label>
                        <input type="number" step="0.01" min="0" max="1" name="bobot" id="bobot" required class="w-full rounded-lg border p-2" placeholder="0.25">
                    </div>
                </div>

                <div class="flex gap-2 mt-6">
                    <button type="submit" class="inline-block px-6 py-3 font-bold text-center text-white rounded-lg bg-gradient-to-tl from-gray-900 to-slate-800">Simpan</button>
                    <button type="button" onclick="closeKriteriaModal()" class="inline-block px-6 py-3 font-bold text-center text-slate-700 rounded-lg border">Batal</button>
                </div>
            </form>
        </div>
        </div>


<script>
function openKriteriaModal(){
    document.getElementById('kriteriaModalTitle').textContent = 'Tambah Kriteria';
    document.getElementById('kriteriaForm').action = '{{ route('kriteria.store') }}';
    document.getElementById('kriteriaFormMethod').value = 'POST';
    document.getElementById('kode_kriteria').value = '';
    document.getElementById('nama_kriteria').value = '';
    document.getElementById('atribut').value = 'benefit';
    document.getElementById('bobot').value = '';
    const modal = document.getElementById('kriteriaModal');
    modal.classList.remove('hidden');
    modal.style.display = 'block';
}

function editKriteriaModal(item){
    document.getElementById('kriteriaModalTitle').textContent = 'Edit Kriteria';
    document.getElementById('kriteriaForm').action = '/kriteria/' + item.id;
    document.getElementById('kriteriaFormMethod').value = 'PUT';
    document.getElementById('kode_kriteria').value = item.kode_kriteria;
    document.getElementById('nama_kriteria').value = item.nama_kriteria;
    document.getElementById('atribut').value = item.atribut;
    document.getElementById('bobot').value = item.bobot;
    const modal = document.getElementById('kriteriaModal');
    modal.classList.remove('hidden');
    modal.style.display = 'block';
}

function closeKriteriaModal(){
    const modal = document.getElementById('kriteriaModal');
    modal.classList.add('hidden');
    modal.style.display = 'none';
}

function confirmDelete(id){
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: 'Hapus kriteria?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-kriteria-' + id).submit();
            }
        })
    } else {
        if (confirm('Hapus kriteria? Data yang dihapus tidak dapat dikembalikan!')) {
            document.getElementById('delete-kriteria-' + id).submit();
        }
    }
}

const kriteriaModalEl = document.getElementById('kriteriaModal');
if (kriteriaModalEl) {
    kriteriaModalEl.addEventListener('click', function(e){ if(e.target === this) closeKriteriaModal(); });
}
</script>

@endsection
