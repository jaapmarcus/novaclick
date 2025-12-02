<div>
     <flux:heading size="xl" level="2">Rekeningen</flux:heading>
        <flux:text class="mt-2">Hieronder vind je een overzicht van al je facturen. Je kunt ze downloaden door op de knop "Downloaden" te klikken.</flux:text>
    <flux:separator variant="subtle" class="mb-6" />

    <flux:table>
        <flux:table.columns>
            <flux:table.column>
                Factuurnummer
            </flux:table.column>
            <flux:table.column>
                Datum
            </flux:table.column>
            <flux:table.column>
                Bedrag
            </flux:table.column>
            <flux:table.column>
                Status
            </flux:table.column>
            <flux:table.column></flux:table.column>
        </flux:table.columns>
        <flux:table.rows>
            @foreach($this -> orders as $order)
            <flux:table.row>
                <flux:table.cell>
                    {{ $order -> number }}
                </flux:table.cell>
                <flux:table.cell>
                    {{ $order -> created_at->format('d-m-Y') }}
                </flux:table.cell>
                <flux:table.cell>
                    € {{ number_format($order -> total / 100, 2, ',', '.') }}
                </flux:table.cell>
                <flux:table.cell>
                    @if($order -> mollie_payment_status == 'paid')
                        {{__('Betaald')}}
                    @else
                        {{ $order -> mollie_payment_status }}
                    @endif
                </flux:table.cell>
                <flux:table.cell>
                    <flux:button size="sm" variant="outline" href="{{ route('invoice.download', $order -> number) }}" target="_blank">{{ __('Downloaden') }}</flux:button>
                </flux:table.cell>
            </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>
</ul>
</div>
