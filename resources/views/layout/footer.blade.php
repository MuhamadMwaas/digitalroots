<script src="{{ asset('Admin/assets/js/jquery-3.6.0.min.js') }}"></script>

<script src="{{ asset('Admin/assets/js/feather.min.js') }}"></script>

<script src="{{ asset('Admin/assets/js/jquery.slimscroll.min.js') }}"></script>

<script src="{{ asset('Admin/assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('Admin/assets/js/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('Admin/assets/js/bootstrap.bundle.min.js') }}"></script>

{{-- <script src="{{ asset('Admin/assets/plugins/apexchart/apexcharts.min.js') }}"></script> --}}
{{-- <script src="{{ asset('Admin/assets/plugins/apexchart/chart-data.js') }}"></script> --}}

<script src="{{ asset('Admin/assets/js/script.js') }}"></script>
<script src="{{ asset('Admin/assets/js/moment.min.js') }}"></script>

<script src="{{ asset('Admin/assets/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('Admin/assets/plugins/toastr/toastr.js') }}"></script>


<script src="{{ asset('Admin/assets/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('Admin/assets/plugins/sweetalert/sweetalerts.min.js') }}"></script>

<script src="{{ asset('Admin/assets/toasting-main/dist/js/toasting.js') }}"></script>
<script src="{{ asset('Admin/assets/js/costumjs.js') }}"></script>

@stack('scriptFirst')


<script>
    window.addEventListener('load', function() {
        @if (session('error'))
            makeTost("{{ session('error') }}", 'error', 5000);
        @endif
        @if (session('success'))
            makeTost("{{ session('success') }}", 'success', 5000);
        @endif

    });

    function sendRequest(route, data = []) {

        fetch(route, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({

            })
        }).then(response => response.json()).then(data => {
            if (data.message == 'image Removed') {
                console.log('data', data);
                makeTost('image removed', 'success');
            }

        }).catch(error => {
            console.error('Error in request (' + route + ') : ', error);
        });

    }
</script>


@stack('script')
</body>

</html>
