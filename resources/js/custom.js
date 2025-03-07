
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    $(document).ready(function() {
        $('#status').change(function() {
            var status = $(this).val(); 
            var mejaId = $(this).data('id');
           
            $.ajax({
                url: '/meja/' + '/Swap' + '/Status' + mejaId,
                type: 'PATCH',
                data: {
                    _token: $('input[name="_token"]').val(),
                    status: status 
                },
                success: function(response) {
                    alert(response.success);
                },
                error: function(xhr, status, error) {
                    alert("Terjadi kesalahan: " + error);
                }
            });
        });
    });