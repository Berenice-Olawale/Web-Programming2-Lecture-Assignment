<label for="manufacturer">Manufacturer</label>
<input type="text" id="manufacturer" name="manufacturer" value="{{ old('manufacturer', $notebook?->manufacturer) }}">
@error('manufacturer')
    <span class="field-error">{{ $message }}</span>
@enderror

<label for="type">Model</label>
<input type="text" id="type" name="type" value="{{ old('type', $notebook?->type) }}">
@error('type')
    <span class="field-error">{{ $message }}</span>
@enderror

<label for="display">Display (inch)</label>
<input type="text" id="display" name="display" value="{{ old('display', $notebook?->display) }}">
@error('display')
    <span class="field-error">{{ $message }}</span>
@enderror

<label for="memory">Memory (MB)</label>
<input type="number" id="memory" name="memory" value="{{ old('memory', $notebook?->memory) }}">
@error('memory')
    <span class="field-error">{{ $message }}</span>
@enderror

<label for="harddisk">Storage (GB)</label>
<input type="number" id="harddisk" name="harddisk" value="{{ old('harddisk', $notebook?->harddisk) }}">
@error('harddisk')
    <span class="field-error">{{ $message }}</span>
@enderror

<label for="videocontroller">Video controller</label>
<input type="text" id="videocontroller" name="videocontroller" value="{{ old('videocontroller', $notebook?->videocontroller) }}">
@error('videocontroller')
    <span class="field-error">{{ $message }}</span>
@enderror

<label for="processorid">Processor</label>
<select id="processorid" name="processorid">
    <option value="">-- Choose a processor --</option>
    @foreach ($processors as $processor)
        <option value="{{ $processor->id }}" @selected(old('processorid', $notebook?->processorid) == $processor->id)>
            {{ $processor->manufacturer }} {{ $processor->type }}
        </option>
    @endforeach
</select>
@error('processorid')
    <span class="field-error">{{ $message }}</span>
@enderror

<label for="opsystemid">Operating system</label>
<select id="opsystemid" name="opsystemid">
    <option value="">-- Choose an operating system --</option>
    @foreach ($operatingSystems as $operatingSystem)
        <option value="{{ $operatingSystem->id }}" @selected(old('opsystemid', $notebook?->opsystemid) == $operatingSystem->id)>
            {{ $operatingSystem->name }}
        </option>
    @endforeach
</select>
@error('opsystemid')
    <span class="field-error">{{ $message }}</span>
@enderror

<label for="price">Price (Ft)</label>
<input type="number" step="0.01" id="price" name="price" value="{{ old('price', $notebook?->price) }}">
@error('price')
    <span class="field-error">{{ $message }}</span>
@enderror

<label for="pieces">Pieces in stock</label>
<input type="number" id="pieces" name="pieces" value="{{ old('pieces', $notebook?->pieces ?? 0) }}">
@error('pieces')
    <span class="field-error">{{ $message }}</span>
@enderror

<div class="form-actions">
    <button type="submit" class="btn">Save</button>
    <a href="{{ route('notebooks.index') }}" class="cancel-link">Cancel</a>
</div>

@push('styles')
<style>
    .eyebrow {
        color: var(--accent);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.7px;
        margin-bottom: 8px;
    }

    .crud-form-card {
        max-width: 720px;
    }

    .crud-form-card label {
        display: block;
        margin-top: 16px;
        font-weight: 600;
    }

    .crud-form-card input,
    .crud-form-card select {
        width: 100%;
        padding: 10px 12px;
        font: inherit;
        border: 1px solid var(--border);
        border-radius: 8px;
        background: #ffffff;
    }

    .form-actions {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-top: 24px;
    }

    .btn {
        display: inline-block;
        padding: 10px 22px;
        font: inherit;
        color: #ffffff;
        background: var(--primary);
        border: 0;
        border-radius: 8px;
        cursor: pointer;
    }

    .btn:hover {
        background: var(--primary-hover);
    }

    .cancel-link {
        color: var(--muted);
    }

    .field-error {
        color: #b42318;
        font-size: 14px;
    }
</style>
@endpush