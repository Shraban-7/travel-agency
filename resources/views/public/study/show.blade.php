@extends('layouts.public')
@section('title', t($university->name))
@section('activePage', 'study')
@section('content')
<main id="main" class="py-8 lg:py-12">
  <div class="container max-w-5xl">
    <nav class="flex items-center gap-2 text-sm text-slate-500 mb-6" aria-label="Breadcrumb">
      <a href="{{ route('home') }}" class="hover:text-primary-700">{{ __('common.home') }}</a>
      <i data-lucide="chevron-right" class="h-4 w-4"></i>
      <a href="{{ route('study.index') }}" class="hover:text-primary-700">{{ __('study.hero.current') }}</a>
      <i data-lucide="chevron-right" class="h-4 w-4"></i>
      <span class="text-slate-800 font-medium">{{ t($university->name) }}</span>
    </nav>

    <div class="rounded-2xl border border-slate-200 bg-white p-6 sm:p-8 shadow-soft">
      <div class="flex flex-wrap items-start justify-between gap-4">
        <div class="flex items-center gap-4">
          <span class="grid h-16 w-16 place-items-center rounded-2xl bg-navy-50 font-serif text-2xl font-bold text-navy-800 border border-slate-200">{{ mb_substr(t($university->name), 0, 2) }}</span>
          <div>
            <p class="flex items-center gap-1.5 text-sm text-slate-500">
              @if($university->country?->flag_code)<img src="https://flagcdn.com/{{ $university->country->flag_code }}.svg" alt="" class="h-3 w-4 rounded-sm">@endif
              {{ $university->country ? t($university->country->name) : '' }}{{ $university->city ? ' · '.$university->city : '' }}
            </p>
            <h1 class="text-2xl sm:text-3xl font-bold">{{ t($university->name) }}</h1>
            <p class="text-sm text-slate-500 mt-1">
              @if($university->ranking) {{ __('study.show.ranking') }} #{{ $university->ranking }} · @endif
              @if($university->website)<a href="{{ $university->website }}" target="_blank" rel="noopener" class="font-en text-primary-700 hover:underline">{{ $university->website }}</a>@endif
            </p>
          </div>
        </div>
      </div>
      @if(t($university->description))
        <p class="mt-5 text-slate-600 leading-relaxed">{{ t($university->description) }}</p>
      @endif
    </div>

    <h2 class="mt-10 text-xl font-bold">{{ __('study.show.programs_count', ['count' => $university->studyPrograms->count()]) }}</h2>
    <div class="mt-4 space-y-4">
      @forelse($university->studyPrograms as $program)
        <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-soft">
          <div class="flex flex-wrap items-start justify-between gap-3">
            <div>
              <h3 class="text-lg font-bold">{{ t($program->name) }}</h3>
              <p class="text-sm text-slate-500">{{ $program->level ? ucfirst($program->level).' · ' : '' }}{{ $program->field }}{{ $program->duration ? ' · '.$program->duration : '' }}</p>
            </div>
            <div class="text-right">
              <p class="text-xs text-slate-500">{{ __('study.show.tuition') }}</p>
              <p class="font-bold text-primary-800 font-en">{{ $program->tuition_fee ? $program->currency.' '.number_format($program->tuition_fee) : '—' }}</p>
            </div>
          </div>
          @if($program->requirements)
            <p class="mt-3 text-sm text-slate-600"><span class="font-semibold">{{ __('study.show.requirements') }}</span> {{ is_array($program->requirements) ? t($program->requirements) : implode(', ', (array) $program->requirements) }}</p>
          @endif
          @if($program->scholarship_info)
            <p class="mt-2 text-sm text-success font-semibold">{{ __('study.show.scholarship') }} {{ is_array($program->scholarship_info) ? t($program->scholarship_info) : $program->scholarship_info }}</p>
          @endif
          @if($program->intakes->isNotEmpty())
            <div class="mt-4 flex flex-wrap gap-2">
              @foreach($program->intakes as $in)
                <span class="inline-flex items-center gap-1.5 rounded-full border border-primary-100 bg-primary-50 px-3 py-1 text-xs font-semibold text-primary-800">
                  {{ t($in->intake_name) }}{{ $in->start_date ? ' · '.__('study.show.starts', ['date' => $in->start_date->format('M Y')]) : '' }}{{ $in->application_deadline ? ' · '.__('study.show.ends', ['date' => $in->application_deadline->format('d M Y')]) : '' }}
                </span>
              @endforeach
            </div>
          @endif
        </article>
      @empty
        <p class="text-slate-500">{{ __('study.show.no_programs') }}</p>
      @endforelse
    </div>

    <div class="mt-8 rounded-2xl bg-gradient-to-br from-primary-700 to-navy-800 p-6 sm:p-8 text-white flex flex-wrap items-center justify-between gap-4">
      <div>
        <h3 class="text-xl font-bold">{{ __('study.show.cta_title') }}</h3>
        <p class="text-sm text-primary-100 mt-1">{{ __('study.show.cta_sub') }}</p>
      </div>
      <a href="{{ route('contact') }}#consult" class="rounded-xl bg-accent px-6 py-3 font-bold text-ink hover:bg-accent-400">{{ __('study.show.cta_button') }}</a>
    </div>
  </div>
</main>
@endsection
