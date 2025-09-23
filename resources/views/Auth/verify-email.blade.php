@if(session('resent'))
    <div>Link verifikasi email terkirim!</div>
@endif

<p>Silakan cek email Anda dan klik link untuk verifikasi akun.</p>

<form method="POST" action="{{ route('verification.send') }}">
  @csrf
  <button type="submit">Kirim ulang link verifikasi</button>
</form>
