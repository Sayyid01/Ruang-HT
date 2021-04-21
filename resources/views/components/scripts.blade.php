<script src="{{ asset('dist/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('dist/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('dist/js/ruang-admin.min.js') }}"></script>
<script type="text/javascript">
    $('#inputLokasi').keyup(function() {
        var characterCount = $(this).val().length,
            current_count = $('#current_countLokasi'),
            maximum_count = $('#maximum_countLokasi'),
            count = $('#countLokasi');
        current_count.text(characterCount);
    });

    $('#inputFungsiAlat').keyup(function() {
        var characterCount = $(this).val().length,
            current_count = $('#current_countJenisHT'),
            maximum_count = $('#maximum_countJenisHT'),
            count = $('#countJenisHT');
        current_count.text(characterCount);
    });
</script>
@stack('js')