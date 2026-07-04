@props(['register'])


@if(!empty($register->checkin_date) && !empty($register->checkout_date))
<span class="badge bg-orange text-orange-fg px-2 mt-1">
    Checkout Realizado
</span>
@endif

@if(empty($register->checkin_date) && empty($register->checkout_date))
<span class="badge bg-secondary text-secondary-fg px-2 mt-1">
    Não Compareceu
</span>
@endif

@if(!empty($register->checkin_date) && empty($register->checkout_date))
<span class="badge bg-success text-success-fg px-2 mt-1">
    No Evento
</span>
@endif

