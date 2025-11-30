@section('content')
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <input type="email" name="email" placeholder="Masukkan email" required>
        <button type="submit">Kirim Link Reset</button>
    </form>
@endsection('content')
