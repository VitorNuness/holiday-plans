<h1>{{ $data->title }}</h1>
<p>{{ $data->description }}</p>

<hr>
<h3>Informations</h3>
<p>
    <b>Date:</b>
    {{ $data->date->format('Y-m-d') }}
</p>
<p>
    <b>Location:</b>
    {{ $data->location }}
</p>

@if (count($data->participants) > 0)
<hr>
<h3>Participants</h3>
<ul>
    @foreach ($data->participants as $participant)
    <li>{{ $participant }}</li>
    @endforeach
</ul>
@endif
