<form action='/admin/trios/add' method='post'>
    {{ csrf_field() }}
    @if(isset($trio))
        <p>Nie wypełnileś wszystkich pól</p>
    @endif
    sentence1: <input name='sentence1' type='text' value="{{ $trio['sentence1'] or '' }}"><br>
    sentence2: <input name='sentence2' type='text' value="{{ $trio['sentence2'] or '' }}"><br>
    sentence3: <input name='sentence3' type='text' value="{{ $trio['sentence3'] or '' }}"><br>
    explanation1: <input name='explanation1' type='text' value="{{ $trio['explanation1'] or '' }}"><br>
    explanation2: <input name='explanation2' type='text' value="{{ $trio['explanation2'] or '' }}"><br>
    explanation3: <input name='explanation3' type='text' value="{{ $trio['explanation3'] or '' }}"><br>
    answer: <input name='answer' type='text' value="{{ $trio['answer'] or '' }}"><br>
    <input type="submit">
</form>