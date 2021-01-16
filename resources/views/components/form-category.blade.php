@props([ 
  'action' => '',
  'name' => '',
  'id' => null,
])

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
  @if($id)
    @method('PUT')
  @endif
  @csrf

  <x-input
    name="name"
    label="Category Name"
    :value="$name"
  />

  @if($id)
    <x-button>
      Update Category
    </x-button>
  @else
    <x-button>
      Create Category
    </x-button>
  @endif
</form>