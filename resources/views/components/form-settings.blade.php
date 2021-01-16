@props([ 
  'action' => '',
  'notificationdefaultimage' => '',
  'vouchercreationthreshold' => '',
  'scanwaittimeminute' => '',
  'voucherdefaulttitle' => '',
  'voucherdefaultdescription' => '',
  'voucherdefaultimage' => '',
  'voucherdefaultcodetemplate' => '',
  'hometexttitle' => '',
  'hometextdescription' => '',
  'voucherdefaultexpireddate' => '',
  'postshowlimit' => '',
  'bannershowlimit' => '',
  'privacypolicyhtml' => '',
  // 'termsandconditions' => '',
  'lotterywaittime' => '',
  'startdate' => '',
  'enddate' => '',
  'id' => null,
])

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
  @if($id)
    @method('PUT')
  @endif
  @csrf

  <!-- <x-input
    name="home_text_title"
    label="Home Judul"
    :value="$hometexttitle"
  />
  
  <x-textarea
    name="home_text_description"
    label="Home Deskripsi"
    :value="$hometextdescription"
  /> -->

  <x-input
    name="voucher_creation_threshold"
    label="Voucher Creation Threshold"
    :value="$vouchercreationthreshold"
    type="number"
  />

  <x-input
    name="scan_wait_time_minute"
    label="Scan Wait Time Minute"
    :value="$scanwaittimeminute"
    type="number"
/>

  <!-- <x-input
    name="voucher_default_title"
    label="Voucher Default Title"
    :value="$voucherdefaulttitle"
  />

  <x-input
    name="voucher_default_description"
    label="Voucher Default Description"
    :value="$voucherdefaultdescription"
  />

  <x-input
    type="file"
    name="voucher_default_image"
    label="Voucher Default Image"
  />

  <div class="form-group">
      @if($voucherdefaultimage)
        <img src="{{ $voucherdefaultimage }}" width="200"/>
      @endif
  </div> -->

  <x-input
    name="voucher_default_code_template"
    label="Voucher Default Code Template"
    :value="$voucherdefaultcodetemplate"
  />

<x-input
  name="event_start_date"
  label="Start Date"
  :value="$startdate"
  type="date"
/>

<x-input
  name="event_end_date"
  label="End Date"
  :value="$enddate"
  type="date"
/>

<x-input
  name="voucher_default_expired_date"
  label="Voucher Default Expired Date"
  :value="$voucherdefaultexpireddate"
  type="date"
/>

<x-input
  name="post_show_limit"
  label="Post Show Limit"
  :value="$postshowlimit"
  type="number"
/>

<x-input
  name="banner_show_limit"
  label="Banner Show Limit"
  :value="$bannershowlimit"
  type="number"
/>

{{-- <x-editor
  name="terms_and_conditions"
  label="Terms and Conditions"
  :value="$termsandconditions"
/> --}}

  <x-input
    name="lottery_wait_time"
    label="Waktu Tunggu Pengundian (Milidetik)"
    :value="$lotterywaittime"
    type="number"
  />

  <x-input
    type="file"
    name="notification_default_image"
    label="Gambar Notifikasi" 
  />

  <div class="form-group">
      @if($notificationdefaultimage)
          <img src="{{ $notificationdefaultimage }}" width="200"/>
      @endif
  </div>

  <x-textarea
    id="privacy_policy_html"
    name="privacy_policy_html"
    label="Privacy Policy"
    :value="$privacypolicyhtml"
  />

  @if($id)
    <x-button>
      Ubah
    </x-button>
  @else
    <x-button>
      Tambah
    </x-button>
  @endif
</form>

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
  <script>
      $(document).ready(function() {
      $('#privacy_policy_html').summernote();
        });
  </script>
@endpush