

<form action="{{ route('admin.setting.update.password.action') }}" method="POST" enctype="multipart/form-data">
  @method('PUT')

  @csrf

  <x-input
    name="old_password"
    label="Password Lama"
    type="password"
  />

  <x-input
    name="new_password"
    label="Password Baru"
    type="password"
  />
  
  <x-button>
    Update Password
  </x-button>
</form>