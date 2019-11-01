<script type="text/javascript">
    $(document).ready(function () {
        $("[rel=tooltip]").tooltip({placement: 'right'});
    });
</script>
<?php
$form_attribute = array('method' => 'post', 'class' => 'myform', 'id' => 'myform');
echo form_open_multipart('admin/kanal/simpan_order', $form_attribute);
?>
<div class="row">
    <div class="col-md-6">
        <span class="badge bg-default" style="color:gray; opacity: 10">* Drag and drop baris kanal untuk mengubah posisi</span>
    </div>
    <div class="col-md-6">
        <div class="form-group pull-right">
            <input type="submit" name="save" value="Simpan Posisi" class="btn btn-success btn-sm">
        </div>
    </div>
</div>
<table class="table" id="datatable">
    <thead>
        <tr>
            <th style="text-align: center;width:1%;">Posisi</th>
            <th style="text-align: center;width:1%;">Icon</th>
            <th style="width: 20%;text-align: center;">Nama Kanal</th>
            <th style="width: 150px;text-align: center;">Meta Title</th>
            <th style="width: 150px;text-align: center;">Meta Description</th>
            <th style="width: 150px;text-align: center;">Keyword</th>
            <th style="width: 150px;text-align: center;">Slug</th>
            <th style="width: 80px;text-align: center;">Status</th>
            <th style="width: 150px;text-align: center;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $count = $total_row;
        foreach ($list as $key) {
            ?>
            <tr>
                <td style="text-align: center;">
                    <?= $no ?>
                    <input type="hidden" name="no[]" value="<?php echo $no ?>">
                </td>
                <td><img style="max-width: 25px;" src="<?= base_url() ?>uploads/cat-ico/<?php echo $key['icon'] ?>"></td>
                <td><?= $key['nama_kanal'] ?>
                    <input type="hidden" name="id[]" value="<?php echo $key['id_kanal'] ?>">
                </td>
                <td><?= $key['meta_title'] ?></td>
                <td><?= $key['meta_description'] ?></td>
                <td><?= $key['meta_keyword'] ?></td>
                <td style="text-align: center;"><?= $key['slug'] ?></td>
                <td style="text-align: center;"><?php
                    if ($key['is_aktif'] == 1) {
                        echo '<span class="badge bg-green">Visible</span>';
                    } else {
                        echo '<span class="badge bg-orange">Not Visible</span>';
                    }
                    ?></td>  
                <td style="text-align: center;">
                    <a href="#" class="btn btn-default" onclick="edit('<?= $key['id_kanal'] ?>')"><i class="icon-pencil"></i></a>
                    <!--<a href="#" class="btn btn-default" onclick="delete('<?= $key['id_kanal'] ?>')"><i class="icon-trash"></i></a>-->
                    <?PHP if ($key['is_aktif'] == 1) { ?>
                        <a class="btn btn-default" onclick="matiin('<?php echo $key['id_kanal'] ?>')" title="Matikan Kanal"><i class="icon-eye-blocked2"></i></a>
                    <?PHP } else { ?>
                        <a class="btn btn-default" onclick="idupin('<?php echo $key['id_kanal'] ?>')" title="Hidupkan Kanal"><i class="icon-eye4"></i></a>
                        <?PHP } ?>
                </td>
            </tr>
            <?php
            $no++;
        }
        ?>
    </tbody>
</table> 
<?= form_close();
?>
<script type="text/javascript">

    $(document).ready(function () {
        $('#datatable').DataTable({
            rowReorder: true,
            paging: false,
            searching: false,
        });
    })
    function idupin(id) {
        swalInit({
            title: 'Konfirmasi !',
            text: 'Apakah anda yakin ingin mengaktifkan data ?',
            type: 'warning',
            confirmButtonText: 'Ya !',
            showCancelButton: true,
            cancelButtonText: 'Tidak !',
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: "<?= base_url() ?>admin/kanal/idupin",
                    type: "POST",
                    data: {
                        id: id
                    },
                    beforeSend: function (data) {
                        $.blockUI({
                            message: '<i class="icon-spinner4 spinner"></i>',
                            overlayCSS: {
                                backgroundColor: '#1b2024',
                                opacity: 0.8,
                                zIndex: 1200,
                                cursor: 'wait'
                            },
                            css: {
                                border: 0,
                                color: '#fff',
                                zIndex: 1201,
                                padding: 0,
                                backgroundColor: 'transparent'
                            }
                        });
                    },
                    error: function (data) {
                        $.unblockUI();
                        alert('Proses data gagal', 'info')
                    },
                    success: function (data) {
                        $.unblockUI();
                        var obj = JSON.parse(data);
                        if (obj[0]) {
                            swalInit({
                                type: 'success',
                                text: obj[2]
                            }).then(function (con) {
                                if (con.value) {
                                    load();
                                }
                            })
                        } else {
                            swalInit({
                                type: 'warning',
                                text: obj[2]
                            })
                        }
                    }
                });
            }
        });

    }
    function matiin(id) {
        swalInit({
            title: 'Konfirmasi !',
            text: 'Apakah anda yakin ingin menonaktifkan data ?',
            type: 'warning',
            confirmButtonText: 'Ya !',
            showCancelButton: true,
            cancelButtonText: 'Tidak !',
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: "<?= base_url() ?>admin/kanal/matiin",
                    type: "POST",
                    data: {
                        id: id
                    },
                    beforeSend: function (data) {
                        $.blockUI({
                            message: '<i class="icon-spinner4 spinner"></i>',
                            overlayCSS: {
                                backgroundColor: '#1b2024',
                                opacity: 0.8,
                                zIndex: 1200,
                                cursor: 'wait'
                            },
                            css: {
                                border: 0,
                                color: '#fff',
                                zIndex: 1201,
                                padding: 0,
                                backgroundColor: 'transparent'
                            }
                        });
                    },
                    error: function (data) {
                        $.unblockUI();
                        alert('Proses data gagal', 'info')
                    },
                    success: function (data) {
                        $.unblockUI();
                        var obj = JSON.parse(data);
                        if (obj[0]) {
                            swalInit({
                                type: 'success',
                                text: obj[2]
                            }).then(function (con) {
                                if (con.value) {
                                    load();
                                }
                            })
                        } else {
                            swalInit({
                                type: 'warning',
                                text: obj[2]
                            })
                        }
                    }
                });
            }
        });

    }
    var validator = $('.myform').validate({
        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-invalid-label',
        successClass: 'validation-valid-label',
        validClass: 'validation-valid-label',
        highlight: function (element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function (element, errorClass) {
            $(element).removeClass(errorClass);
        },
        errorPlacement: function (error, element) {
            if (element.parents().hasClass('form-check')) {
                error.appendTo(element.parents('.form-check').parent());
            } else if (element.parents().hasClass('form-group-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo(element.parent());
            } else if (element.parent().is('.uniform-uploader, .uniform-select') || element.parents().hasClass('input-group')) {
                error.appendTo(element.parent().parent());
            }
            // Other elements
            else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            swalInit({
                title: 'Konfirmasi !',
                text: 'Apakah anda yakin ingin menyimpan data ?',
                type: 'warning',
                confirmButtonText: 'Ya !',
                showCancelButton: true,
                cancelButtonText: 'Tidak !',
            }).then(function (result) {
                if (result.value) {
                    var data = new FormData(form);
                    $.ajax({
                        type: 'POST',
                        url: $("#myform").attr('action'),
                        data: data,
                        contentType: false,
                        processData: false,
                        beforeSend: function (data) {
                            $.blockUI({
                                message: '<i class="icon-spinner4 spinner"></i>',
                                overlayCSS: {
                                    backgroundColor: '#1b2024',
                                    opacity: 0.8,
                                    zIndex: 1200,
                                    cursor: 'wait'
                                },
                                css: {
                                    border: 0,
                                    color: '#fff',
                                    zIndex: 1201,
                                    padding: 0,
                                    backgroundColor: 'transparent'
                                }
                            });
                        },
                        error: function (data) {
                            $.unblockUI();
                            alert('Proses data gagal', 'info')
                        },
                        success: function (data) {
                            $.unblockUI();
                            var obj = JSON.parse(data);
                            if (obj[0]) {
                                swalInit({
                                    type: 'success',
                                    text: obj[2]
                                }).then(function (con) {
                                    if (con.value) {
                                        load();
                                    }
                                })
                            } else {
                                swalInit({
                                    type: 'warning',
                                    text: obj[2]
                                })
                            }
                        }
                    })
                }
            });
        }
    });
    function edit(id) {
        $.ajax({
            url: "<?= base_url() ?>admin/kanal/edit",
            type: "POST",
            data: {
                id: id
            },
            beforeSend: function (data) {
                $.blockUI({
                    message: '<i class="icon-spinner4 spinner"></i>',
                    overlayCSS: {
                        backgroundColor: '#1b2024',
                        opacity: 0.8,
                        zIndex: 1200,
                        cursor: 'wait'
                    },
                    css: {
                        border: 0,
                        color: '#fff',
                        zIndex: 1201,
                        padding: 0,
                        backgroundColor: 'transparent'
                    }
                });
            },
            error: function (data) {
                $.unblockUI();
                alert('Proses data gagal', 'info')
            },
            success: function (data) {
                $.unblockUI();
                $('#content').html(data);
            }
        });
    }
</script>