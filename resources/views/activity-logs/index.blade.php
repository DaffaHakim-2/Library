
<x-app-layout>

    <div class="space-y-6">

        {{-- Judul halaman --}}
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Activity Log
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Riwayat aktivitas pengguna dalam sistem perpustakaan.
            </p>
        </div>

        {{-- Filter aktivitas --}}
        <div class="bg-white rounded-xl shadow-sm p-5">

            <form method="GET"
                  action="{{ route('activity-logs.index') }}"
                  class="flex flex-wrap items-end gap-4">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Jenis Aktivitas
                    </label>

                    <select name="action_type"
                            class="rounded-lg border-gray-300 text-sm">

                        <option value="">Semua Aktivitas</option>

                        <option value="tambah"
                            {{ request('action_type') === 'tambah' ? 'selected' : '' }}>
                            Tambah
                        </option>

                        <option value="edit"
                            {{ request('action_type') === 'edit' ? 'selected' : '' }}>
                            Edit
                        </option>

                        <option value="hapus"
                            {{ request('action_type') === 'hapus' ? 'selected' : '' }}>
                            Hapus
                        </option>

                    </select>
                </div>

                <button type="submit"
                        class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Filter
                </button>

                <a href="{{ route('activity-logs.index') }}"
                   class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                    Reset
                </a>

            </form>
        </div>

        {{-- Tabel Activity Log --}}
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">
                    Riwayat Aktivitas
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Daftar aktivitas yang berhasil direkam sistem.
                </p>
            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50">

                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                No
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                Pengguna
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                Aktivitas
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                Deskripsi
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                Waktu
                            </th>
                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @forelse ($activities as $activity)

                            <tr class="hover:bg-gray-50">

                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $activities->firstItem() + $loop->index }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-800">
                                    {{ $activity->user->name ?? 'Pengguna dihapus' }}
                                </td>

                                <td class="px-6 py-4">

                                    @if ($activity->action_type === 'tambah')
                                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                            Tambah
                                        </span>

                                    @elseif ($activity->action_type === 'edit')
                                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                                            Edit
                                        </span>

                                    @elseif ($activity->action_type === 'hapus')
                                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                            Hapus
                                        </span>
                                    @endif

                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $activity->description }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-600 whitespace-nowrap">
                                    {{ $activity->created_at->format('d-m-Y H:i:s') }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5"
                                    class="px-6 py-10 text-center text-sm text-gray-500">
                                    Belum ada aktivitas yang tercatat.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- Pagination --}}
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $activities->links() }}
            </div>

        </div>

    </div>

</x-app-layout>
