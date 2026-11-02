<x-mainpage title="Price calculator">
    @push('styles')
    <style>
        .calc { max-width: 420px; margin: 40px auto; }
        .calc form { display: flex; flex-direction: column; gap: 10px; }
        .calc input, .calc select, .calc button { padding: 9px; font-size: 15px; }
        .calc button { background: #1f4e79; color: #fff; border: none; border-radius: 8px; cursor: pointer; }
        .calc .success { color: #1a7f37; }
        .calc .error { color: #b42318; }
    </style>
    @endpush

    <section class="calc">
        @if ($result !== null)
            <div class="success" data-testid="result">
                <h2>Calculation result</h2>
                <p>{{ $label }}: <b>{{ $result }}</b></p>
            </div>
        @endif

        @if ($error !== null)
            <div class="error" data-testid="error">
                <h2>Error</h2>
                <p>{{ $error }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="error" data-testid="validation">
                @foreach ($errors->all() as $message)
                    <p>{{ $message }}</p>
                @endforeach
            </div>
        @endif

        <h2>Price calculator form</h2>
        <form action="{{ route('price.calculate') }}" method="POST">
            @csrf
            <label for="a">Notebook price (HUF):</label>
            <input id="a" type="number" name="a" value="{{ old('a', $a) }}" required>

            <label for="b">Second value (VAT %, discount %, months or HUF/EUR rate):</label>
            <input id="b" type="number" step="any" name="b" value="{{ old('b', $b) }}" required>

            <label for="op">Operation:</label>
            <select id="op" name="op">
                <option value="vat" @selected($op === 'vat')>Add VAT</option>
                <option value="discount" @selected($op === 'discount')>Apply discount</option>
                <option value="installment" @selected($op === 'installment')>Monthly installment</option>
                <option value="eur" @selected($op === 'eur')>Convert to EUR</option>
            </select>

            <button type="submit">Send</button>
        </form>
    </section>
</x-mainpage>