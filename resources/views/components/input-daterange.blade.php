@props([
  'weekStartDate',
  'weekEndDate',
])

<form method="GET" action="">
  <div class="row">      
      <div class="col-4">        
          <x-input
            label="Date range"
            name="date-range"
          />
      </div>
      <div class="col-4 d-flex flex-row align-items-center">        
        <x-button>
          Filter
        </x-button>
      </div>
  </div>
</form>

@push('styles')
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

@push('scripts')
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <script>
    $(document).ready(function() {
      const option = {
        timePicker: false,
        startDate: "{{ $weekStartDate }}",
        endDate: "{{ $weekEndDate }}",
        locale: {
          format: 'YYYY-MM-DD'
        },
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
      };
      $('#date-range').daterangepicker(option);
    })
  </script>
@endpush