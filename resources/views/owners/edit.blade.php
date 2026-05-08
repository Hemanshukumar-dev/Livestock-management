@extends('layouts.app')

@section('title', 'Edit Owner')

@section('content')
    <div class="mb-8 max-w-3xl">
        <p class="text-sm font-semibold uppercase tracking-[0.25em] text-sky-600">Update Record</p>
        <h2 class="mt-2 text-3xl font-semibold tracking-tight text-slate-900">Edit owner and livestock</h2>
        <p class="mt-2 text-sm leading-6 text-slate-600">Update the owner profile and manage all linked livestock records using the same form structure.</p>
    </div>

    <form method="POST" action="{{ route('owners.update', $owner->id) }}" class="max-w-4xl space-y-8 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
        @csrf
        @method('PUT')

        <div class="grid gap-8 lg:grid-cols-2">
            <section>
                <div class="mb-5 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-slate-900">Owner details</h3>
                    <span class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Required</span>
                </div>

                <div class="space-y-5">
                    <div>
                        <label for="owner_name" class="mb-2 block text-sm font-medium text-slate-700">Name</label>
                        <input id="owner_name" name="owner[name]" type="text" value="{{ old('owner.name', $owner->name) }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-sky-500 focus:ring-4 focus:ring-sky-100">
                        @error('owner.name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="owner_phone" class="mb-2 block text-sm font-medium text-slate-700">Phone</label>
                        <input id="owner_phone" name="owner[phone]" type="text" value="{{ old('owner.phone', $owner->phone) }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-sky-500 focus:ring-4 focus:ring-sky-100">
                        @error('owner.phone')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="owner_address" class="mb-2 block text-sm font-medium text-slate-700">Address</label>
                        <textarea id="owner_address" name="owner[address]" rows="4" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-sky-500 focus:ring-4 focus:ring-sky-100">{{ old('owner.address', $owner->address) }}</textarea>
                        @error('owner.address')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            <section>
                <div class="mb-5 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-slate-900">Livestock</h3>
                    <span class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Multiple entries</span>
                </div>

                <div id="livestock-container" class="space-y-4">
                    @forelse ($livestockList as $index => $animal)
                        <div class="livestockEntry rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <div class="mb-4 flex items-center justify-between">
                                <p class="text-sm font-medium text-slate-700">Livestock #<span class="livestockNumber">{{ $index + 1 }}</span></p>
                                <button type="button" class="removeBtn {{ count($livestockList) === 1 ? 'hidden' : '' }} text-xs font-semibold text-red-600 transition hover:text-red-700">Remove</button>
                            </div>

                            <div class="space-y-3">
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Type</label>
                                    <select name="livestock[{{ $index }}][type]" class="typeSelect w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20">
                                        <option value="">Select type</option>
                                        <option value="Cow" @selected(old("livestock.$index.type", $animal->type) === 'Cow')>Cow</option>
                                        <option value="Buffalo" @selected(old("livestock.$index.type", $animal->type) === 'Buffalo')>Buffalo</option>
                                        <option value="Goat" @selected(old("livestock.$index.type", $animal->type) === 'Goat')>Goat</option>
                                        <option value="Sheep" @selected(old("livestock.$index.type", $animal->type) === 'Sheep')>Sheep</option>
                                        <option value="Poultry" @selected(old("livestock.$index.type", $animal->type) === 'Poultry')>Poultry</option>
                                    </select>
                                    @error("livestock.$index.type")
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid gap-3 sm:grid-cols-2">
                                    <div>
                                        <label class="mb-2 block text-sm font-medium text-slate-700">Breed</label>
                                        <select name="livestock[{{ $index }}][breed]" data-selected="{{ old("livestock.$index.breed", $animal->breed) }}" class="breedSelect w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20">
                                            <option value="">Select breed</option>
                                        </select>
                                        @error("livestock.$index.breed")
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                        <div>
                                            <label class="mb-2 block text-sm font-medium text-slate-700">Age</label>
                                            <input name="livestock[{{ $index }}][age]" type="number" min="0" value="{{ old("livestock.$index.age", $animal->age) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20">
                                            @error("livestock.$index.age")
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                </div>
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Tag Number</label>
                                    <input name="livestock[{{ $index }}][tag_number]" type="text" value="{{ old("livestock.$index.tag_number", $animal->tag_number) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20">
                                    @error("livestock.$index.tag_number")
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Health Status</label>
                                    <select name="livestock[{{ $index }}][health_status]" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20">
                                        <option value="">Select status</option>
                                        <option value="Healthy" @selected(old("livestock.$index.health_status", $animal->health_status) === 'Healthy')>Healthy</option>
                                        <option value="Sick" @selected(old("livestock.$index.health_status", $animal->health_status) === 'Sick')>Sick</option>
                                        <option value="Under Treatment" @selected(old("livestock.$index.health_status", $animal->health_status) === 'Under Treatment')>Under Treatment</option>
                                        <option value="Hospitalized" @selected(old("livestock.$index.health_status", $animal->health_status) === 'Hospitalized')>Hospitalized</option>
                                        <option value="Injured" @selected(old("livestock.$index.health_status", $animal->health_status) === 'Injured')>Injured</option>
                                    </select>
                                    @error("livestock.$index.health_status")
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid gap-3 sm:grid-cols-2">
                                    <div>
                                        <label class="mb-2 block text-sm font-medium text-slate-700">Source</label>
                                        <select name="livestock[{{ $index }}][source]" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20">
                                            <option value="Born" @selected(old("livestock.$index.source", $animal->source) === 'Born')>Born</option>
                                            <option value="Purchased" @selected(old("livestock.$index.source", $animal->source) === 'Purchased')>Purchased</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="mb-2 block text-sm font-medium text-slate-700">Date Added</label>
                                        <input name="livestock[{{ $index }}][date_added]" type="date" value="{{ old("livestock.$index.date_added", optional($animal->date_added)->format('Y-m-d')) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="livestockEntry rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <div class="mb-4 flex items-center justify-between">
                                <p class="text-sm font-medium text-slate-700">Livestock #<span class="livestockNumber">1</span></p>
                                <button type="button" class="removeBtn hidden text-xs font-semibold text-red-600 transition hover:text-red-700">Remove</button>
                            </div>

                            <div class="space-y-3">
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Type</label>
                                    <select name="livestock[0][type]" class="typeSelect w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20">
                                        <option value="">Select type</option>
                                        <option value="Cow">Cow</option>
                                        <option value="Buffalo">Buffalo</option>
                                        <option value="Goat">Goat</option>
                                        <option value="Sheep">Sheep</option>
                                        <option value="Poultry">Poultry</option>
                                    </select>
                                </div>

                                <div class="grid gap-3 sm:grid-cols-2">
                                    <div>
                                        <label class="mb-2 block text-sm font-medium text-slate-700">Breed</label>
                                        <select name="livestock[0][breed]" class="breedSelect w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20">
                                            <option value="">Select breed</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="mb-2 block text-sm font-medium text-slate-700">Age</label>
                                        <input name="livestock[0][age]" type="number" min="0" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20">
                                    </div>
                                </div>

                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Tag Number</label>
                                    <input name="livestock[0][tag_number]" type="text" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20">
                                </div>

                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Health Status</label>
                                    <select name="livestock[0][health_status]" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20">
                                        <option value="">Select status</option>
                                        <option value="Healthy">Healthy</option>
                                        <option value="Sick">Sick</option>
                                        <option value="Under Treatment">Under Treatment</option>
                                        <option value="Hospitalized">Hospitalized</option>
                                        <option value="Injured">Injured</option>
                                    </select>
                                </div>

                                <div class="grid gap-3 sm:grid-cols-2">
                                    <div>
                                        <label class="mb-2 block text-sm font-medium text-slate-700">Source</label>
                                        <select name="livestock[0][source]" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20">
                                            <option value="Born">Born</option>
                                            <option value="Purchased">Purchased</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="mb-2 block text-sm font-medium text-slate-700">Date Added</label>
                                        <input name="livestock[0][date_added]" type="date" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>

                <button type="button" id="addLivestockBtn" class="mt-4 w-full rounded-lg border border-sky-300 bg-sky-50 px-4 py-3 text-sm font-semibold text-sky-700 transition hover:bg-sky-100">
                    + Add Livestock
                </button>

                @error('livestock')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </section>
        </div>

        @if ($errors->any())
            <div class="rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                Please fix the highlighted fields and submit again.
            </div>
        @endif

        <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
            <a href="{{ route('owners.index') }}" class="inline-flex items-center justify-center rounded-full border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:bg-slate-50">Cancel</a>
            <button type="submit" class="inline-flex items-center justify-center rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-slate-900/15 transition hover:bg-slate-700">
                Update Owner and Livestock
            </button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('livestock-container');
            const addBtn = document.getElementById('addLivestockBtn');
            const healthStatusOptions = `
                <option value="">Select status</option>
                <option value="Healthy">Healthy</option>
                <option value="Sick">Sick</option>
                <option value="Under Treatment">Under Treatment</option>
                <option value="Hospitalized">Hospitalized</option>
                <option value="Injured">Injured</option>
            `;

            const breedMap = {
                'Cow': ['Gir','Sahiwal','Red Sindhi','Tharparkar','Holstein Friesian','Jersey'],
                'Buffalo': ['Murrah','Nili-Ravi','Jaffarabadi','Surti','Mehsana'],
                'Goat': ['Jamunapari','Boer','Beetal','Barbari','Sirohi'],
                'Sheep': ['Merino','Suffolk','Dorper','Rambouillet','Deccani'],
                'Poultry': ['Broiler','Layer','Desi Chicken','Kadaknath','Rhode Island Red']
            };

            function populateBreedSelect(select, type, selected) {
                select.innerHTML = '<option value="">Select breed</option>';
                if (!type || !breedMap[type]) return;
                breedMap[type].forEach(b => {
                    const opt = document.createElement('option');
                    opt.value = b;
                    opt.textContent = b;
                    if (selected && selected === b) opt.selected = true;
                    select.appendChild(opt);
                });
            }

            function updateLivestockNumbers() {
                const entries = container.querySelectorAll('.livestockEntry');
                entries.forEach((entry, index) => {
                    entry.querySelector('.livestockNumber').textContent = index + 1;
                    entry.querySelectorAll('input, select').forEach(field => {
                        const currentName = field.name;
                        const newName = currentName.replace(/livestock\[\d+\]/, `livestock[${index}]`);
                        field.name = newName;
                    });

                    const removeBtn = entry.querySelector('.removeBtn');
                    if (entries.length > 1) {
                        removeBtn.classList.remove('hidden');
                    } else {
                        removeBtn.classList.add('hidden');
                    }
                });
            }

            function attachTypeListener(entry) {
                const typeSelect = entry.querySelector('.typeSelect');
                const breedSelect = entry.querySelector('.breedSelect');
                typeSelect.addEventListener('change', function() {
                    populateBreedSelect(breedSelect, this.value, null);
                });
                const selected = breedSelect ? breedSelect.getAttribute('data-selected') : null;
                populateBreedSelect(breedSelect, typeSelect.value, selected);
            }

            addBtn.addEventListener('click', function() {
                const index = container.querySelectorAll('.livestockEntry').length;
                const newEntry = document.createElement('div');
                newEntry.classList.add('livestockEntry', 'rounded-2xl', 'border', 'border-slate-200', 'bg-slate-50', 'p-4');
                newEntry.innerHTML = `
                    <div class="mb-4 flex items-center justify-between">
                        <p class="text-sm font-medium text-slate-700">Livestock #<span class="livestockNumber">${index + 1}</span></p>
                        <button type="button" class="removeBtn text-xs font-semibold text-red-600 transition hover:text-red-700">Remove</button>
                    </div>

                    <div class="space-y-3">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">Type</label>
                            <select name="livestock[${index}][type]" class="typeSelect w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20">
                                <option value="">Select type</option>
                                <option value="Cow">Cow</option>
                                <option value="Buffalo">Buffalo</option>
                                <option value="Goat">Goat</option>
                                <option value="Sheep">Sheep</option>
                                <option value="Poultry">Poultry</option>
                            </select>
                        </div>

                        <div class="grid gap-3 sm:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">Breed</label>
                                <select name="livestock[${index}][breed]" class="breedSelect w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20">
                                    <option value="">Select breed</option>
                                </select>
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">Age</label>
                                <input name="livestock[${index}][age]" type="number" min="0" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20">
                            </div>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">Tag Number</label>
                            <input name="livestock[${index}][tag_number]" type="text" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20">
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">Health Status</label>
                            <select name="livestock[${index}][health_status]" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20">
                                ${healthStatusOptions}
                            </select>
                        </div>

                        <div class="grid gap-3 sm:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">Source</label>
                                <select name="livestock[${index}][source]" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20">
                                    <option value="Born">Born</option>
                                    <option value="Purchased">Purchased</option>
                                </select>
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">Date Added</label>
                                <input name="livestock[${index}][date_added]" type="date" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20">
                            </div>
                        </div>
                    </div>
                `;

                container.appendChild(newEntry);

                newEntry.querySelector('.removeBtn').addEventListener('click', function(e) {
                    e.preventDefault();
                    newEntry.remove();
                    updateLivestockNumbers();
                });

                attachTypeListener(newEntry);
                updateLivestockNumbers();
            });

            // Attach remove listener to existing entries and attach type listeners
            document.querySelectorAll('.livestockEntry').forEach(entry => {
                const btn = entry.querySelector('.removeBtn');
                if (btn) {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        this.closest('.livestockEntry').remove();
                        updateLivestockNumbers();
                    });
                }
                if (entry.querySelector('.typeSelect')) {
                    attachTypeListener(entry);
                }
            });

            updateLivestockNumbers();
        });
    </script>
@endsection