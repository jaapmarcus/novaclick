<div>
<ul class="list-unstyled">
    @foreach(auth()->user()->orders as $order)
    <li>

        <a href="{{ route('invoices.show', $order->invoice()->id()) }}">
            {{ $order->invoice()->id() }} -  {{ $order->invoice()->date() }}
        </a>
    </li>
    @endforeach
</ul>
</div>
