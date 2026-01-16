<html>
    <head>
    </head>
    <body style="margin:80px;">
        <img src="data:image/svg+xml;base64,{{ base64_encode($svg) }}">
        <p>Novaclick<br />
        Onderdeel van S Media Works B.V.<br />
        Weegschaalstraat 3<br />
        632CW Eindhoven<br />
        Netherlands<br />
        BTW Nummer: NLxxxxxxxxxB01</p>

        <p><strong>{{$client -> company_name}}</strong><br />
        {{$client -> address}} {{ $client -> house_number}}<br />
        {{$client -> postalcode}} {{$client -> city}}<br />
        {{\App\Models\User::convertCountryName($client -> country)}}</p>

        <h2>Factuur #{{$invoice -> id()}}</h2>
        <p>Datum: {{$invoice -> date()->format('d-m-Y')}}</p>
        <table class="invoice-items" style="width:100%;border-collapse:collapse;">
            @foreach($invoice -> items() as $item)
                <tr>
                    <td style="padding-right:20px;">{{$item -> description}}</td>
                    <td style="text-align:right;">€ {{number_format($item -> unit_price / 100, 2, ',', '.')}}</td>
                </tr>
                <tr>
                    <td colspan="2" style="color:#666666;">{{ __($item -> description_extra_lines[0]) }}</td>
                </tr>
            @endforeach
            <tr>
                <td style="border-top:1px solid #000000;padding-top:10px;">Totaal exclusief BTW</td>
                <td style="border-top:1px solid #000000;padding-top:10px;text-align:right;">€ {{number_format(($total_order -> total - $total_order -> tax) / 100, 2, ',', '.')}}</td>
            </tr>
            <tr>
                <td style="">VAT</td>
                <td style="text-align:right;">€ {{number_format($total_order -> tax / 100, 2, ',', '.')}}</td>
            </tr>
            <tr>
                <td style="border-top:1px solid #000000;padding-top:10px;font-weight:bold;">Totaal</td>
                <td style="border-top:1px solid #000000;padding-top:10px;text-align:right;font-weight:bold;">€ {{number_format($total_order -> total / 100, 2, ',', '.')}}</td>
            </tr>
        </table>
    </body>
</html>
