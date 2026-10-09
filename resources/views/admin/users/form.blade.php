@extends('layouts.admin')

@section('title', $user->exists ? __('Edit User') : __('New User'))

@section('content')
<nav class="flex items-center gap-2 text-xs text-slate-500">
  <a href="{{ route('admin.dashboard') }}" class="hover:underline">Dashboard</a>
  <span>/</span>
  <a href="{{ route('admin.users.index') }}" class="hover:underline">Users</a>
  <span>/</span>
  <span class="text-slate-800 font-semibold">{{ $user->exists ? $user->name : 'New' }}</span>
</nav>

<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-soft max-w-2xl">
  <form method="POST" action="{{ $user->exists ? route('admin.users.update', $user) : route('admin.users.store') }}" class="space-y-4 text-sm">
    @csrf
    @if ($user->exists)
      @method('PUT')
    @endif

    <div>
      <label class="block text-xs font-semibold text-slate-700 mb-1">Name *</label>
      <input type="text" name="name" required value="{{ old('name', $user->name) }}" class="w-full rounded-xl border-slate-200 bg-slate-50">
    </div>

    <div>
      <label class="block text-xs font-semibold text-slate-700 mb-1">Email *</label>
      <input type="email" name="email" required value="{{ old('email', $user->email) }}" class="w-full rounded-xl border-slate-200 bg-slate-50">
    </div>

    <div>
      <label class="block text-xs font-semibold text-slate-700 mb-1">Phone</label>
      <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full rounded-xl border-slate-200 bg-slate-50">
    </div>

    <div class="grid sm:grid-cols-2 gap-4">
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1">Password {{ $user->exists ? '(leave blank to keep)' : '*' }}</label>
        <input type="password" name="password" {{ $user->exists ? '' : 'required' }} autocomplete="new-password" class="w-full rounded-xl border-slate-200 bg-slate-50">
      </div>
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1">Confirm Password {{ $user->exists ? '' : '*' }}</label>
        <input type="password" name="password_confirmation" {{ $user->exists ? '' : 'required' }} autocomplete="new-password" class="w-full rounded-xl border-slate-200 bg-slate-50">
      </div>
    </div>

    <div>
      <label class="block text-xs font-semibold text-slate-700 mb-1">Role *</label>
      <select name="role" required class="w-full rounded-xl border-slate-200 bg-slate-50">
        @foreach ($roles as $value => $label)
          <option value="{{ $value }}" @selected($selectedRole === $value)>{{ ucfirst($label) }}</option>
        @endforeach
      </select>
    </div>

    <label class="flex items-center gap-2 text-xs cursor-pointer">
      <input type="hidden" name="is_active" value="0">
      <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $user->is_active ?? true)) class="rounded border-slate-300 text-primary-600">
      <span>Active account</span>
    </label>

    <div class="flex items-center gap-2 pt-2">
      <button class="rounded-xl bg-primary-700 px-4 py-2 text-xs font-bold text-white hover:bg-primary-800">{{ $user->exists ? 'Update User' : 'Create User' }}</button>
      <a href="{{ route('admin.users.index') }}" class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50">Cancel</a>
    </div>
  </form>
</div>
@endsection
