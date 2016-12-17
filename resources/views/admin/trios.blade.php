@foreach ($trios as $trio)
    {{$trio-> sentence1}}
    ({{$trio-> explanation1}})<br>
    {{$trio-> sentence2}}
    ({{$trio-> explanation2}})<br>
    {{$trio-> sentence3}}
    ({{$trio-> explanation3}})<br>
    {{$trio-> answer}} <br>
@endforeach