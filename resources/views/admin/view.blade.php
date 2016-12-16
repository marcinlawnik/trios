<ul>
    <li>ID: {{ $trio->id }}</li>
    <li>sentence1: {{ $trio->sentence1 }}</li>
    <li>sentence2: {{ $trio->sentence2 }}</li>
    <li>sentence3: {{ $trio->sentence3 }}</li>
    <li>explanation1: {{ $trio->explanation1 }}</li>
    <li>explanation2: {{ $trio->explanation2 }}</li>
    <li>explanation3: {{ $trio->explanation3 }}</li>
    <li>answer: {{ $trio->answer }}</li>
    <li>created at: {{ $trio->created_at }}</li>
    <li>updated at: {{ $trio->updated_at }}</li>
    <li><a href='/admin/trios/{$trio->id}/edit'>Edit trio</a></li>
</ul>