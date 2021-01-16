@props([ 
  'action' => '',
  'code' => null,
  'name' => '',
  // 'phone' => '',
  'address' => '',
  'city_id' => '',
  'frenchise_id' => '',
  'cities' => [],
  // 'frenchises' => [],
])

<form action="{{ $action }}" method="POST" >
  @if($code)
    @method('PUT')
  @endif
  @csrf

  <x-input
    name="code"
    label="Kode Outlet"
    :value="$code"
  />

  <x-input
    name="name"
    label="Nama Outlet"
    :value="$name"
  />

  {{-- <x-input
    name="phone"
    label="No. Hp"
    type="tel"
    :value="$phone"
  /> --}}

  <x-textarea
  name="address"
  label="Alamat"
  :value="$address"
/>

<div class="form-group">
    <label for="city_id">Kota</label>
    <select name="city_id" class="form-control">
      @foreach($cities as $city)          
        @if($city->id === $city_id)
          <option value="{{$city->id}}" selected>{{$city->name}}</option>
        @else
          <option value="{{$city->id}}">{{$city->name}}</option>
        @endif
      @endforeach
    </select>
  </div>

  {{-- <div class="form-group">
    <label for="frenchise_id">Frenchise</label>
    <select name="frenchise_id" class="form-control">
      @foreach($frenchises as $frenchise)          
        @if($frenchise->id === $frenchise_id)
          <option value="{{$frenchise->id}}" selected>{{$frenchise->name}}</option>
        @else
          <option value="{{$frenchise->id}}">{{$frenchise->name}}</option>
        @endif
      @endforeach
    </select>
  </div> --}}


  @if($code)
    <x-button>
      Ubah
    </x-button>
  @else
    <x-button>
      Tambah
    </x-button>
  @endif
</form>