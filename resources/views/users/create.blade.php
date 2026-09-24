@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-900 to-slate-950 shadow-[0_0_30px_-8px_rgba(148,163,184,0.4)] ring-1 ring-slate-700/50 p-6 max-w-lg">
        <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Nama</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full bg-slate-800/60 border border-slate-700 text-gray-100 placeholder-gray-500 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                       class="w-full bg-slate-800/60 border border-slate-700 text-gray-100 placeholder-gray-500 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                <input type="password" name="password" required
                       class="w-full bg-slate-800/60 border border-slate-700 text-gray-100 placeholder-gray-500 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Role</label>
                <select name="role" required
                        class="w-full bg-slate-800/60 border border-slate-700 text-gray-100 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50">
                    <option value="">-- Pilih Role --</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="petugas" {{ old('role') === 'petugas' ? 'selected' : '' }}>Petugas</option>
                    <option value="owner" {{ old('role') === 'owner' ? 'selected' : '' }}>Owner</option>
                </select>
            </div>
            <div class="flex gap-2 pt-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white text-sm px-4 py-2 rounded-md shadow-[0_0_15px_-3px_rgba(59,130,246,0.7)] transition-colors">
                    Simpan
                </button>
                <a href="{{ route('users.index') }}" class="bg-slate-800 hover:bg-slate-700 text-gray-200 text-sm px-4 py-2 rounded-md border border-slate-700 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection