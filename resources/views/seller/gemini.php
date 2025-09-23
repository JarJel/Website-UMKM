<h1>Gemini BTC/USD Ticker</h1>

@if($ticker)
    <p>Bid: {{ $ticker['bid'] }}</p>
    <p>Ask: {{ $ticker['ask'] }}</p>
    <p>Last: {{ $ticker['last'] }}</p>
@else
    <p>Tidak ada data.</p>
@endif
