@extends('layouts.app')

@section('title', $livestock->tag_number . ' — Livestock Profile')

@section('content')
    @php $currentUser = auth()->user(); @endphp

    {{-- Success Flash --}}
    @if (session('success'))
        <div class="mb-8 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-800 shadow-sm">
            <span class="mr-2">✅</span>{{ session('success') }}
        </div>
    @endif

    {{-- Breadcrumb --}}
    <nav class="mb-6 flex items-center gap-2 text-sm text-txt-200">
        <a href="{{ route('livestock.index') }}" class="transition hover:text-sky-700">Livestock</a>
        <span>/</span>
        <span class="font-medium text-txt-100">{{ $livestock->tag_number }}</span>
    </nav>

    {{-- Main Profile Card --}}
    <div class="rounded-2xl border border-bg-300 bg-bg-100 shadow-sm overflow-hidden">

        {{-- Header Banner --}}
        <div class="relative bg-gradient-to-r from-sky-700 via-sky-600 to-blue-600 px-8 py-8 text-white">
            <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 80 80%22><circle cx=%2240%22 cy=%2240%22 r=%222%22 fill=%22white%22/></svg>'); background-size: 20px 20px;"></div>
            <div class="relative flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <div class="flex items-center gap-3 flex-wrap">
                        <?php
                            $typeIcon = (function($t) { $m = ['cow'=>'🐄', 'cattle'=>'🐄', 'goat'=>'🐐', 'sheep'=>'🐑', 'pig'=>'🐖', 'horse'=>'🐴', 'chicken'=>'🐔', 'poultry'=>'🐔', 'duck'=>'🦆']; return $m[$t] ?? '🐾'; })(strtolower($livestock->type));
                        ?>
                        <span class="text-4xl">{{ $typeIcon }}</span>
                        <div>
                            <h2 class="text-2xl font-bold">{{ $livestock->type }}</h2>
                            <p class="mt-0.5 text-sky-100 font-mono text-sm">{{ $livestock->tag_number }}</p>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-3 flex-wrap">
                    <?php
                        $statusClasses = [
'Healthy' => 'bg-emerald-400/20 text-emerald-100 border-emerald-400/40',
                            'Sick' => 'bg-red-400/20 text-red-100 border-red-400/40',
                            'Under Treatment' => 'bg-yellow-400/20 text-yellow-100 border-yellow-400/40',
                            'Hospitalized' => 'bg-slate-400/20 text-slate-100 border-slate-400/40',
                            'Injured' => 'bg-amber-400/20 text-amber-100 border-amber-400/40',
                            ][$livestock->health_status] ?? 'bg-bg-100 text-txt-200 border-bg-300';
                        $statusDot = [
'Healthy' => 'bg-emerald-300',
                            'Sick' => 'bg-red-300',
                            'Under Treatment' => 'bg-yellow-300',
                            'Hospitalized' => 'bg-slate-300',
                            'Injured' => 'bg-amber-300',
                            ][$livestock->health_status] ?? 'bg-bg-100';
                    ?>
                    <span class="inline-flex items-center gap-2 rounded-full border px-4 py-2 text-sm font-semibold {{ $statusClasses }}">
                        <span class="h-2 w-2 rounded-full {{ $statusDot }} animate-pulse"></span>
                        {{ $livestock->health_status }}
                    </span>
                    @if ($currentUser?->isAdmin() || ($currentUser?->isOwner() && $livestock->owner?->user_id === $currentUser->id))
                        <a href="{{ route('livestock.edit', $livestock->id) }}" class="rounded-full bg-bg-100 border border-white/30 px-4 py-2 text-sm font-semibold text-white transition hover:bg-bg-100">
                            ✏️ Edit
                        </a>
                    @endif
                    @if ($currentUser?->isAdmin())
                        <form method="POST" action="{{ route('livestock.destroy', $livestock->id) }}" class="inline" onsubmit="return false;">
                            @csrf
                            @method('DELETE')
                            <button
                                type="button"
                                onclick="openDeleteModal(this.closest('form'))"
                                class="rounded-full bg-red-500/20 border border-red-400/30 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-500/40"
                            >
                                🗑 Delete
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        {{-- Details Grid --}}
        <div class="px-8 py-8">
            <div class="grid gap-8 lg:grid-cols-2">

                {{-- Livestock Details --}}
                <div>
                    <h3 class="flex items-center gap-2 text-sm font-semibold uppercase tracking-[0.2em] text-sky-700 mb-5">
                        <span>📋</span> Animal Details
                    </h3>
                    <div class="rounded-2xl border border-bg-300 bg-bg-200/50 divide-y divide-slate-200">
                        <div class="flex justify-between items-center px-5 py-4">
                            <span class="text-sm font-medium text-txt-200">Type</span>
                            <span class="text-sm font-semibold text-txt-100">{{ $livestock->type }}</span>
                        </div>
                        <div class="flex justify-between items-center px-5 py-4">
                            <span class="text-sm font-medium text-txt-200">Breed</span>
                            <span class="text-sm font-semibold text-txt-100">{{ $livestock->breed ?? '—' }}</span>
                        </div>
                        <div class="flex justify-between items-center px-5 py-4">
                            <span class="text-sm font-medium text-txt-200">Age</span>
                            <span class="text-sm font-semibold text-txt-100">
                                @if ($livestock->age !== null)
                                    {{ $livestock->age }} {{ $livestock->age == 1 ? 'year' : 'years' }}
                                @else
                                    —
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between items-center px-5 py-4">
                            <span class="text-sm font-medium text-txt-200">Health Status</span>
                            <span class="text-sm font-semibold text-txt-100">{{ $livestock->health_status }}</span>
                        </div>
                        <div class="flex justify-between items-center px-5 py-4">
                            <span class="text-sm font-medium text-txt-200">Tag Number</span>
                            <span class="text-sm font-mono font-semibold text-txt-100">{{ $livestock->tag_number }}</span>
                        </div>
                        <div class="flex justify-between items-center px-5 py-4">
                            <span class="text-sm font-medium text-txt-200">Source</span>
                            <span class="inline-flex items-center gap-1.5 text-sm font-semibold text-txt-100">
                                @if ($livestock->source === 'Born')
                                    🏠 Born on farm
                                @elseif ($livestock->source === 'Purchased')
                                    🛒 Purchased
                                @else
                                    {{ $livestock->source ?? '—' }}
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between items-center px-5 py-4">
                            <span class="text-sm font-medium text-txt-200">Date Added</span>
                            <span class="text-sm font-semibold text-txt-100">
                                {{ $livestock->date_added ? \Illuminate\Support\Carbon::parse($livestock->date_added)->format('d M Y') : '—' }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center px-5 py-4">
                            <span class="text-sm font-medium text-txt-200">Record Created</span>
                            <span class="text-sm text-slate-700">{{ $livestock->created_at->format('d M Y, h:i A') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Owner Information --}}
                <div>
                    <h3 class="flex items-center gap-2 text-sm font-semibold uppercase tracking-[0.2em] text-sky-700 mb-5">
                        <span>👤</span> Owner Information
                    </h3>
                    @if ($livestock->owner)
                        <div class="rounded-2xl border border-bg-300 bg-bg-200/50 p-6">
                            <div class="flex items-center gap-4 mb-5">
                                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-sky-100 text-xl font-bold text-sky-700">
                                    {{ strtoupper(substr($livestock->owner->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h4 class="text-lg font-semibold text-txt-100">{{ $livestock->owner->name }}</h4>
                                    <span class="rounded-full bg-sky-50 border border-sky-200 px-2.5 py-0.5 text-xs font-semibold text-sky-700">{{ $livestock->owner->owner_code }}</span>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-center gap-3 text-sm">
                                    <span class="text-slate-400">📞</span>
                                    <span class="text-slate-700">{{ $livestock->owner->phone ?? 'No phone on file' }}</span>
                                </div>
                                <div class="flex items-start gap-3 text-sm">
                                    <span class="text-slate-400 mt-0.5">📍</span>
                                    <span class="text-slate-700">{{ $livestock->owner->address ?? 'No address on file' }}</span>
                                </div>
                                <div class="flex items-center gap-3 text-sm">
                                    <span class="text-slate-400">🐄</span>
                                    <span class="text-slate-700">
                                        @php $ownerLivestockCount = $livestock->owner->livestock()->count(); @endphp
                                        {{ $ownerLivestockCount }} livestock record{{ $ownerLivestockCount === 1 ? '' : 's' }} total
                                    </span>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="rounded-2xl border border-dashed border-bg-300 bg-bg-200 p-6 text-center text-sm text-txt-200">
                            No owner information available
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Health & Event History Timeline --}}
    <div class="mt-8 rounded-2xl border border-bg-300 bg-bg-100 p-8 shadow-sm">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-8">
            <h3 class="flex items-center gap-2 text-sm font-semibold uppercase tracking-[0.2em] text-sky-700">
                <span>🩺</span> Health & Event History
            </h3>
            <span class="rounded-full bg-bg-200 px-3 py-1 text-xs font-semibold text-txt-200">
                {{ $livestock->histories->count() }} record{{ $livestock->histories->count() === 1 ? '' : 's' }}
            </span>
        </div>

        @if ($livestock->histories->isEmpty())
            <div class="rounded-2xl border border-dashed border-bg-300 bg-bg-200 px-6 py-12 text-center">
                <div class="text-4xl mb-3">📋</div>
                <p class="text-base font-semibold text-txt-100">No history records yet</p>
                <p class="mt-1 text-sm text-txt-200">Health events, vaccinations, and treatments will appear here as they are recorded.</p>
            </div>
        @else
            {{-- Timeline --}}
            <div class="relative">
                {{-- Vertical line --}}
                <div class="absolute left-6 top-0 bottom-0 w-px bg-gradient-to-b from-sky-300 via-sky-200 to-transparent hidden sm:block"></div>

                <div class="space-y-6">
                    @foreach ($livestock->histories as $history)
                        <?php
                            $eventColorMap = [
                                'Vaccination' => ['bg-blue-100 text-blue-700 border-blue-200', 'bg-blue-500', '💉'],
                                'Treatment' => ['bg-purple-100 text-purple-700 border-purple-200', 'bg-purple-500', '💊'],
                                'Checkup' => ['bg-green-100 text-green-700 border-green-200', 'bg-green-500', '🩺'],
                                'Illness' => ['bg-red-100 text-red-700 border-red-200', 'bg-red-500', '🤒'],
                                'Deworming' => ['bg-teal-100 text-teal-700 border-teal-200', 'bg-teal-500', '🧪'],
                                'Surgery' => ['bg-orange-100 text-orange-700 border-orange-200', 'bg-orange-500', '🔬'],
                            ];
                            $eventColor = $eventColorMap[$history->event_type] ?? ['bg-bg-200 text-txt-200 border-bg-300', 'bg-slate-400', '📝'];
                        ?>
                        <div class="relative flex gap-5 sm:pl-14">
                            {{-- Timeline dot --}}
                            <div class="absolute left-4 top-4 hidden sm:flex h-5 w-5 items-center justify-center rounded-full {{ $eventColor[1] }} ring-4 ring-white">
                                <span class="h-2 w-2 rounded-full bg-bg-100"></span>
                            </div>

                            {{-- Event card --}}
                            <div class="flex-1 rounded-2xl border border-bg-300 bg-bg-100 p-5 shadow-sm transition hover:shadow-md">
                                <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                                    <div class="flex items-center gap-3">
                                        <span class="text-2xl">{{ $eventColor[2] }}</span>
                                        <div>
                                            <h4 class="font-semibold text-txt-100">{{ $history->event_type }}</h4>
                                            <p class="mt-0.5 text-xs text-txt-200">
                                                {{ \Illuminate\Support\Carbon::parse($history->event_date)->format('l, d F Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    <span class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-medium {{ $eventColor[0] }}">
                                        {{ $history->event_type }}
                                    </span>
                                </div>
                                @if ($history->description)
                                    <p class="mt-3 text-sm leading-relaxed text-txt-200 bg-bg-200 rounded-xl px-4 py-3">
                                        {{ $history->description }}
                                    </p>
                                @endif
                                <div class="mt-3 flex items-center justify-between">
                                    <p class="text-xs text-slate-400">
                                        {{ \Illuminate\Support\Carbon::parse($history->event_date)->diffForHumans() }}
                                    </p>
                                    @if ($currentUser?->isAdmin() || ($currentUser?->isOwner() && $livestock->owner?->user_id === $currentUser->id))
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('livestock.histories.edit', $history->id) }}" class="rounded-lg border border-bg-300 px-3 py-1.5 text-xs font-medium text-txt-200 hover:bg-bg-200 transition">✏️ Edit</a>
                                            <form method="POST" action="{{ route('livestock.histories.destroy', $history->id) }}" class="inline" onsubmit="return false;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="openDeleteHistoryModal(this.closest('form'), '{{ $history->event_type }}')" class="rounded-lg border border-red-200 text-red-600 px-3 py-1.5 text-xs font-medium hover:bg-red-50 transition">🗑 Delete</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Add History Form --}}
        <div class="mt-8 rounded-2xl border border-sky-200 bg-sky-50/50 p-6">
            <h4 class="flex items-center gap-2 text-sm font-semibold text-sky-800 mb-4">
                <span>➕</span> Add New History Record
            </h4>
            <form method="POST" action="{{ route('livestock.histories.store', $livestock->id) }}" class="space-y-4">
                @csrf
                <div class="grid gap-4 sm:grid-cols-3">
                    <div>
                        <label class="mb-1 block text-xs font-medium uppercase tracking-[0.15em] text-txt-200">Event Type</label>
                        <select name="event_type" required class="w-full rounded-lg border border-bg-300 bg-bg-100 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20">
                            <option value="">Select type</option>
                            <option value="Vaccination">💉 Vaccination</option>
                            <option value="Treatment">💊 Treatment</option>
                            <option value="Checkup">🩺 Checkup</option>
                            <option value="Illness">🤒 Illness</option>
                            <option value="Deworming">🧪 Deworming</option>
                            <option value="Surgery">🔬 Surgery</option>
                        </select>
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-medium uppercase tracking-[0.15em] text-txt-200">Event Date</label>
                        <input type="date" name="event_date" required class="w-full rounded-lg border border-bg-300 bg-bg-100 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20">
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-medium uppercase tracking-[0.15em] text-txt-200">Description</label>
                        <textarea name="description" rows="1" placeholder="Short details (optional)" class="w-full rounded-lg border border-bg-300 bg-bg-100 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20"></textarea>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-sky-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-sky-500">
                        Save Record
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Back Link --}}
    <div class="mt-6">
        <a href="{{ route('livestock.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-txt-200 transition hover:text-sky-700">
            ← Back to all livestock
        </a>
    </div>

    {{-- Delete Confirmation Modal --}}
    <div id="delete-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-bg-100/40 backdrop-blur-sm">
        <div class="mx-4 w-full max-w-sm rounded-2xl border border-bg-300 bg-bg-100 p-6 shadow-2xl">
            <div class="text-center">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-100 text-2xl">⚠️</div>
                <h3 class="mt-4 text-lg font-bold text-txt-100">Delete Livestock</h3>
                <p class="mt-1 text-sm text-txt-200">Are you sure you want to delete <strong>{{ $livestock->tag_number }}</strong>? This action cannot be undone. All health history for this animal will also be removed.</p>
            </div>
            <div class="mt-6 flex gap-3">
                <button
                    type="button"
                    onclick="closeDeleteModal()"
                    class="flex-1 rounded-xl border border-bg-300 bg-bg-100 px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-bg-200"
                >
                    Cancel
                </button>
                <button
                    type="button"
                    id="confirm-delete-btn"
                    class="flex-1 rounded-xl bg-red-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-red-500"
                >
                    Yes, Delete
                </button>
            </div>
        </div>
    </div>

    <div id="delete-history-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-bg-100/40 backdrop-blur-sm">
        <div class="mx-4 w-full max-w-sm rounded-2xl border border-bg-300 bg-bg-100 p-6 shadow-2xl">
            <div class="text-center">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-100 text-2xl">⚠️</div>
                <h3 class="mt-4 text-lg font-bold text-txt-100">Delete History Record</h3>
                <p class="mt-1 text-sm text-txt-200">Are you sure you want to delete the <strong id="delete-history-type"></strong> record? This action cannot be undone.</p>
            </div>
            <div class="mt-6 flex gap-3">
                <button
                    type="button"
                    onclick="closeDeleteHistoryModal()"
                    class="flex-1 rounded-xl border border-bg-300 bg-bg-100 px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-bg-200"
                >
                    Cancel
                </button>
                <button
                    type="button"
                    id="confirm-history-delete-btn"
                    class="flex-1 rounded-xl bg-red-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-red-500"
                >
                    Yes, Delete
                </button>
            </div>
        </div>
    </div>

    <script>
        let activeDeleteForm = null;
        let activeHistoryDeleteForm = null;

        function openDeleteModal(form) {
            activeDeleteForm = form;
            const modal = document.getElementById('delete-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteModal() {
            activeDeleteForm = null;
            const modal = document.getElementById('delete-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function openDeleteHistoryModal(form, eventType) {
            activeHistoryDeleteForm = form;
            document.getElementById('delete-history-type').textContent = eventType;
            const modal = document.getElementById('delete-history-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteHistoryModal() {
            activeHistoryDeleteForm = null;
            const modal = document.getElementById('delete-history-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.getElementById('confirm-delete-btn')?.addEventListener('click', function () {
            if (activeDeleteForm) activeDeleteForm.submit();
        });

        document.getElementById('confirm-history-delete-btn')?.addEventListener('click', function () {
            if (activeHistoryDeleteForm) activeHistoryDeleteForm.submit();
        });

        document.getElementById('delete-modal')?.addEventListener('click', function (e) {
            if (e.target === this) closeDeleteModal();
        });

        document.getElementById('delete-history-modal')?.addEventListener('click', function (e) {
            if (e.target === this) closeDeleteHistoryModal();
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeDeleteModal();
                closeDeleteHistoryModal();
            }
        });
    </script>
@endsection
