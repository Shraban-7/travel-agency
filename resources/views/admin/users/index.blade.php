@extends('layouts.admin')

@section('title', __('Users & Roles'))

@section('content')
<div class="flex flex-wrap items-center justify-between gap-4">
  <div>
    <h2 class="text-2xl font-bold text-ink">{{ __('Users & Roles') }}</h2>
    <p class="text-sm text-slate-500">{{ __('Manage staff accounts and their roles.') }}</p>
  </div>
  <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-primary-700 px-4 py-2.5 text-sm font-semibold text-white shadow-soft hover:bg-primary-800 transition">
    <i data-lucide="plus" class="h-4 w-4"></i> {{ __('New User') }}
  </a>
</div>

<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-soft">
  <div class="overflow-x-auto">
    <table class="w-full text-left text-sm">
      <thead class="border-b border-slate-200 text-xs font-semibold text-slate-500 uppercase tracking-wider">
        <tr>
          <th class="pb-3 px-3">Name</th>
          <th class="pb-3 px-3">Email</th>
          <th class="pb-3 px-3">Role</th>
          <th class="pb-3 px-3">Status</th>
          <th class="pb-3 px-3 text-right">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-100">
        @forelse ($users as $u)
          <tr class="hover:bg-slate-50/70">
            <td class="py-3 px-3 font-bold text-ink">{{ $u->name }}</td>
            <td class="py-3 px-3 text-xs text-slate-600">{{ $u->email }}</td>
            <td class="py-3 px-3">
              @foreach ($u->roles as $r)
                <span class="rounded-full bg-primary-50 px-2.5 py-0.5 text-xs font-bold text-primary-800 border border-primary-200">{{ $r->name }}</span>
              @endforeach
            </td>
            <td class="py-3 px-3">
              @if ($u->is_active)
                <span class="rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-bold text-success border border-green-200">Active</span>
              @else
                <span class="rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-bold text-slate-600">Inactive</span>
              @endif
            </td>
            <td class="py-3 px-3 text-right">
              <div class="inline-flex items-center gap-2">
                <a href="{{ route('admin.users.edit', $u) }}" class="rounded-lg bg-primary-50 px-3 py-1 text-xs font-bold text-primary-800 hover:bg-primary-700 hover:text-white transition">Edit</a>
                @if ($u->id !== auth()->id())
                  <form method="POST" action="{{ route('admin.users.destroy', $u) }}" class="inline" onsubmit="return confirm('Delete this user?')">
                    @csrf
                    @method('DELETE')
                    <button class="rounded-lg bg-red-50 px-3 py-1 text-xs font-bold text-red-700 hover:bg-red-600 hover:text-white transition">Delete</button>
                  </form>
                @endif
              </div>
            </td>
          </tr>
        @empty
          <tr><td colspan="5" class="py-8 text-center text-sm text-slate-500">No users yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="mt-4">{{ $users->links() }}</div>
</div>
@endsection
