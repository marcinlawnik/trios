<p>Ilość trios: {{ $trioscount }}</p>
<p>Czas generacji: {{ $time }}</p>

@foreach($exampleTrios as $trio)
    {{ $trio-> answer }}
    <br>
@endforeach