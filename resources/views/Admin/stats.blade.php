<p>Ilość trios: {{ $triosCount }}</p>
<p>Czas generacji: {{ $time }}</p>

@foreach($exampleTrios as $trio)
    {{ $trio-> answer }}
    <br>
@endforeach