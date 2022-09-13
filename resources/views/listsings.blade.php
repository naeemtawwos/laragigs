<h1>List of Users</h1>
<ul>

@foreach ( $users as $user )
<div class="p-4">
    <h3>{{$user->name}}</h3>
    <a href="mailto:{{$user->email}}">{{$user->email}}</a>

</div>
@endforeach

</ul>
