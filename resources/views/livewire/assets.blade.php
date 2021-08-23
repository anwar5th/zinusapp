<x-slot name="header">
    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex object-center">
        <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
        </x-jet-nav-link>
        <!-- Dropdown menu -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        {{ __('Input Data') }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Input Data') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('assets') }}" :active="request()->routeIs('assets')">
                                {{ __('Assets') }}
                            </x-jet-dropdown-link>

                            
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>
    </div>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <button wire:click="create()" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded my-3">Tambah Asset</button>
            
            @if($isModal)
                @include('livewire.create')
            @endif

            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">Asset ID</th>
                        <th class="px-4 py-2">Type</th>
                        <th class="px-4 py-2">Location</th>
                        <th class="px-4 py-2">Department</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Manufacture</th>
                        <th class="px-4 py-2">Atribut</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($assets as $row)
                        <tr>
                            <td class="border px-4 py-2">{{ $row->asset_id }}</td>
                            <td class="border px-4 py-2">{!! $row->type !!}</td>
                            <td class="border px-4 py-2">{{ $row->location }}</td>
                            <td class="border px-4 py-2">{{ $row->department }}</td>
                            <td class="border px-4 py-2">{{ $row->name }}</td>
                            <td class="border px-4 py-2">{{ $row->manufacture }}</td>
                            <td class="border px-4 py-2">{{ $row->atribut }}</td>
                            <td class="border px-4 py-2">
                                <button wire:click="edit({{ $row->id }})" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                                <button wire:click="delete({{ $row->id }})" class="bg-red-500 hover:bg-red-500 text-white font-bold py-2 px-4 rounded">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="border px-4 py-2 text-center" colspan="5">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>