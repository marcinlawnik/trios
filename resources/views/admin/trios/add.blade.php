<form action='/admin/trios/add' method='post'>
    {{ csrf_field() }}
    sentence1: <input name='sentence1' type='text'><br>
    sentence2: <input name='sentence2' type='text'><br>
    sentence3: <input name='sentence3' type='text'><br>
    explanation1: <input name='explanation1' type='text'><br>
    explanation2: <input name='explanation2' type='text'><br>
    explanation3: <input name='explanation3' type='text'><br>
    answer: <input name='answer' type='text'><br>
    <input type="submit">
</form>