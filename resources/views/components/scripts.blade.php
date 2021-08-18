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
        //Clickable row
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });

        //update data lokasi
        $(document).on('click', 'button[data-role=updateModalLokasi]', function() {
            let id = $(this).data("id");
            let kantor = $('#' + id).children('td[data-target=kantor]').text();
            let alamat = $('#' + id).children('td[data-target=alamat]').text();
            let lokasi = $('#' + id).children('td[data-target=lokasi]').data('id');

            $('#id_lokasi_update').val(id);
            $('#kantor_update').val(kantor);
            $('#alamat_update').val(alamat);
            $('#lokasi_update').val(lokasi);
            $('#modalUpdateLokasi').modal('toggle');
        });

        //update data pengguna
        $(document).on('click', 'button[data-role=modalUpdatePengguna]', function() {
            let id = $(this).data("id");
            let nama_pengguna = $('#' + id).children('td[data-target=nama]').text();

            $('#id_pengguna_update').val(id);
            $('#updateNamaPengguna').val(nama_pengguna);
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
            let merk = $('#' + id).children('td[data-target=merk]').data("id");

            $('#id_ht').val(id);
            $('#updateSnHt').val(sn_ht);
            $('#updateSnBaterai').val(sn_baterai);
            $('#updateMerk').val(merk);
            $('#modalUpdateListHT').modal('toggle');
        });

        //update data merk alat
        $(document).on('click', 'button[data-role=modalUpdateMerkAlat]', function() {
            let id = $(this).data("id");
            let merk = $('#' + id).children('td[data-target=merk]').text();
            let jenis = $('#' + id).children('td[data-target=jenis]').data("value");

            console.log(id);
            console.log(merk);
            console.log(jenis);

            $('#id_merk').val(id);
            $('#updateMerk').val(merk);
            $('#updateJenis').val(jenis);
            $('#modalUpdateMerkAlat').modal('toggle');
        });

        //update data jenis alat
        $(document).on('click', 'button[data-role=modalUpdateJenisHt]', function() {
            let id = $(this).data("key-update");
            let jenis = $('#' + id).children('td[data-target=jenisAlat]').text();
            let fungsi = $('#' + id).children('td[data-target=fungsiAlat]').text();

            console.log(id);
            console.log(jenis);
            console.log(fungsi);

            $('#id_jenis').val(id);
            $('#updateJenisAlat').val(jenis);
            $('#updateFungsiAlat').val(fungsi);
            $('#modalUpdateJenisHt').modal('toggle');
        });


        //update assign data
        $(document).on('click', 'button[data-role=updateAssignData]', function() {
            let id = $(this).data("id");
            let pengguna = $('#' + id).children('td[data-target=pengguna]').data("value");

            console.log(id);
            console.log(pengguna);

            $('#idStatus').val(id);
            $('#updatePengguna').val(pengguna);
            $('#modalUpdateAssignData').modal('toggle');
        });

        //update data user
        $(document).on('click', 'button[data-role=modalUpdateUser]', function() {
            let id = $(this).data("id");
            let nama = $('#' + id).children('td[data-target=nama]').text();
            let email = $('#' + id).children('td[data-target=email]').text();

            console.log(id);
            console.log(nama);
            console.log(email);

            $('#id_user').val(id);
            $('#updatenama').val(nama);
            $('#updateemail').val(email);
            $('#modalUpdateUser').modal('toggle');
        });

        //update data admin
        $(document).on('click', 'button[data-role=modalUpdateAdmin]', function() {
            let id = $(this).data("id");
            let nama = $('#' + id).children('td[data-target=nama]').text();
            let email = $('#' + id).children('td[data-target=email]').text();

            console.log(id);
            console.log(nama);
            console.log(email);

            $('#id_user').val(id);
            $('#updatenama').val(nama);
            $('#updateemail').val(email);
            $('#modalUpdateAdmin').modal('toggle');
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

        //delete data Merk HT
        $(document).on('click', 'button[data-role=deleteMerkHt]', function() {
            let id = $(this).data("id");
            let column = this;

            $.ajax({
                type: "get",
                url: "listAlat-table/deleteMerkHt/" + id,
                success: function() {
                    $(column).closest("tr").remove();
                    console.log("alhamdulillah jalan");
                }
            })
        });

        //delete data Jenis HT
        $(document).on('click', 'button[data-role=deleteJenisHt]', function() {
            let id = $(this).data("id");
            let column = this;

            $.ajax({
                type: "get",
                url: "listAlat-table/deleteJenisHt/" + id,
                success: function() {
                    $(column).closest("tr").remove();
                    console.log("alhamdulillah jalan");
                }
            })
        });

        //delete data user
        $(document).on('click', 'button[data-role=deleteUser]', function() {
            let id = $(this).data("id");
            let column = this;

            $.ajax({
                type: "get",
                url: "dataUser/deleteUserData/" + id,
                success: function() {
                    $(column).closest("tr").remove();
                    console.log("alhamdulillah jalan");
                }
            })
        });

        //delete data admin
        $(document).on('click', 'button[data-role=deleteAdmin]', function() {
            let id = $(this).data("id");
            let column = this;

            $.ajax({
                type: "get",
                url: "dataAdmin/deleteAdminData/" + id,
                success: function() {
                    $(column).closest("tr").remove();
                    console.log("alhamdulillah jalan");
                }
            })
        });
    });
</script>
@stack('js')