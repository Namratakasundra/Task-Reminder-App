
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/lib/feather-icons/feather.min.js"></script>
<script src="/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="/assets/js/dashforge.js"></script>
  <script>
    $(function(){
      'use strict'
    });
  </script>

<!-- toaster scripts -->
<script src="{{ asset('/js/toastr.min.js')}}"></script>
{!! Toastr::message() !!}

{{-- For coppie Library --}}
<script src="{{ asset('/js/croppie.js') }}"></script>
<script src="{{ asset('/assets/js/croppie.js') }}"></script>

{{-- For Select2 dropdown --}}
<script src="{{ asset('/js/select2.min.js')}}"></script>
<script src="/assets/js/select2.js"></script>

{{-- For Yajra filtering --}}
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="/assets/js/filter.js"></script>

{{-- For Show password --}}
<script src="/assets/js/show-password.js"></script>