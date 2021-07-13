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


    $(document).ready(function() {

        //update data lokasi
        $(document).on('click', 'button[data-role=updateModalLokasi]', function() {
            let id = $(this).data("id");
            let alamat = $('#' + id).children('td[data-target=alamat]').text();
            let lokasi = $('#' + id).children('td[data-target=lokasi]').text();

            $('#id_lokasi_update').val(id);
            $('#alamat_update').val(alamat);
            $('#lokasi_update').val(lokasi);
            $('#modalUpdateLokasi').modal('toggle');
        });

        //update data pengguna
        $(document).on('click', 'button[data-role=modalUpdatePengguna]', function() {
            let id = $(this).data("id");
            let nama_pengguna = $('#' + id).children('td[data-target=nama_pengguna]').text();
            let penanggung_jawab = $('#' + id).children('td[data-target=penanggung_jawab]').text();

            $('#id_pengguna_update').val(id);
            $('#updateNamaPengguna').val(nama_pengguna);
            $('#updatePenanggungJawab').val(penanggung_jawab);
            $('#modalUpdatePengguna').modal('toggle');
        });

        //update data pegawai
        $(document).on('click', 'button[data-role=modalUpdatePegawai]', function() {
            let id = $(this).data("id");
            let namaPegawai = $('#' + id).children('td[data-target=namaPegawai]').text();
            let jabatan = $('#' + id).children('td[data-target=jabatan]').text();
            let noPegawai = $('#' + id).children('td[data-target=no_pegawai]').text();
            let noTelpon = $('#' + id).children('td[data-target=no_telpon]').text();

            $('#updateIdPegawai').val(id);
            $('#updateNamaPegawai').val(namaPegawai);
            $('#updateJabatan').val(jabatan);
            $('#updateNoPegawai').val(noPegawai);
            $('#updateNoTelpon').val(noTelpon);
            $('#modalUpdatePegawai').modal('toggle');
        });

        //update data list HT
        $(document).on('click', 'button[data-role=modalUpdateListHT]', function() {
            let id = $(this).data("id");
            let sn_ht = $('#' + id).children('td[data-target=snHt]').text();
            let sn_baterai = $('#' + id).children('td[data-target=snBaterai]').text();
            let merk = $('#' + id).children('td[data-target=merk]').text();
            let jenis_ht = $('#' + id).children('td[data-target=jenisHt]').text();

            $('#id_ht').val(id);
            $('#updateSnHt').val(sn_ht);
            $('#updateSnBaterai').val(sn_baterai);
            $('#updateMerk').val(merk);
            $('#updateJenisHt').val(jenis_ht);
            $('#modalUpdateListHT').modal('toggle');
        });

        //update data alat
        $(document).on('click', 'button[data-role=modalUpdateListAlat]', function() {
            let id = $(this).data("id");
            let merk = $('#' + id).children('td[data-target=merk]').text();
            let jenis = $('#' + id).children('td[data-target=jenis]').text();
            let fungsi = $('#' + id).children('td[data-target=fungsi]').text();

            $('#id_alat').val(id);
            $('#updateMerk').val(merk);
            $('#updateJenis').val(jenis);
            $('#updateFungsi').val(fungsi);
            $('#modalUpdateListAlat').modal('toggle');
        });

        //update assign data
        $(document).on('click', 'button[data-role=updateAssignData]', function(){
            let id = $(this).data("id");
            let tanggalPenarikan = $('#' + id).children('td[data-target=tanggalPenarikan]').text();
            let pengguna = $('#' + id).children('td[data-target=pengguna]').text();

            console.log(id);

            $('#idStatus').val(id);
            $('#updateTanggalPenarikan').val(tanggalPenarikan);
            $('#updatePengguna').val(pengguna);
            $('#modalUpdateAssignData').modal('toggle');
        });

        // delete data pengguna
        $(document).on('click', 'button[data-role=deletePengguna]', function() {
            let id = $(this).data("id");
            let column = this;

            $.ajax({
                type: "get",
                url: "pengguna-table/deletePengguna/" + id,
                success: function() {
                    $(column).closest("tr").remove();
                    console.log("alhamdulillah jalan");
                }
            })
        });

        //delete data pegawai
        $(document).on('click', 'button[data-role=deletePegawai]', function() {
            let id = $(this).data("id");
            let column = this;

            $.ajax({
                type: "get",
                url: "pegawai-table/deletePegawai/" + id,
                success: function() {
                    $(column).closest("tr").remove();
                    console.log("alhamdulillah jalan");
                }
            })
        });

        //delete data list HT
        $(document).on('click', 'button[data-role=deleteHt]', function() {
            let id = $(this).data("id");
            let column = this;

            $.ajax({
                type: "get",
                url: "listHt-table/deleteHt/" + id,
                success: function() {
                    $(column).closest("tr").remove();
                    console.log("alhamdulillah jalan");
                }
            })
        });

        //delete data alat
        $(document).on('click', 'button[data-role=deleteAlat]', function() {
            let id = $(this).data("id");
            let column = this;

            $.ajax({
                type: "get",
                url: "listAlat-table/deleteAlat/" + id,
                success: function() {
                    $(column).closest("tr").remove();
                    console.log("alhamdulillah jalan");
                }
            })
        });
    });
</script>
@stack('js')