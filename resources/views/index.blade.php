<!-- resources/views/users/index.blade.php -->

<h1>Daftar Pengguna</h1>

<ul>
    @foreach ($users as $user)
        <li>{{ $user->name }} - {{ $user->email }}</li>
    @endforeach
</ul>
