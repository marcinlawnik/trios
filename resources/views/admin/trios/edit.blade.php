<form action='/admin/trios/{{ $trio->id }}/edit' method='post'>
    {{ csrf_field() }}
    sentence1: <input name='sentence1' type='text' value='{{ $trio->sentence1 }}'><br>
    sentence2: <input name='sentence2' type='text' value='{{ $trio->sentence2 }}'><br>
    sentence3: <input name='sentence3' type='text' value='{{ $trio->sentence3 }}'><br>
    explanation1: <input name='explanation1' type='text' value='{{ $trio->explanation1 }}'><br>
    explanation2: <input name='explanation2' type='text' value='{{ $trio->explanation2 }}'><br>
    explanation3: <input name='explanation3' type='text' value='{{ $trio->explanation3 }}'><br>
    answer: <input name='answer' type='text' value='{{ $trio->answer }}'><br>
    <input type="submit">
</form>