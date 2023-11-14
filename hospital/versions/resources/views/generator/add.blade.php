@extends('layouts.app')

@section('content')

<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Dashboard 1</h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <a href="#" target="_blank" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Prueba</a>
        <ol class="breadcrumb">
            <li><a href="#">Dashboard</a></li>
            <li class="active">Dashboard 1</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="white-box">
            <div class="row row-in">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="ibox ">
                        <div class="ibox-title" >
                            <h5>Add <small></small></h5>
                            <div class="ibox-tools">
                            </div>
                        </div>
                        <!-- BO : content  -->
                        <div class="col-sm-12 white-bg ">
                            <div class="">
                                <div class="box-header with-border">
                                    <h3 class="box-title">  </h3>
                                </div><!-- /.box-header -->

                                <!-- form start -->
                                <form action="<?php echo url('/') ?>/generator/add" id="" class="form-horizontal " method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="box-body">

                                        @if(Session::has('message'))
                                              <div class="alert alert-success">
                                                  <button type="button" class="close" data-close="alert"></button>
                                                   {{ Session::get('message') }}
                                              </div>
                                        @endif

                                        <div class="form-group">
                                            <label for="Module_name" class="col-sm-3 control-label"> Tables </label>
                                            <div class="col-sm-4">
                                                <select onchange="getField();" class="form-control" id="table_name_new" name="table_name">

                                                    <?php
                                                    for ($i = 0; $i < count($Tables); $i++) {
                                                        //if(!in_array($Tables[$i], array('ci_sessions', 'users'))){
                                                        ?>
                                                        <option value="<?php echo $Tables[$i]; ?>"><?php echo $Tables[$i] ?></option>
                                                    <?php //}
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12" id="tbl_result">

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-3" >
                                            </div>
                                            <div class="col-sm-6">
                                                <button type="reset" class="btn btn-default ">Reset</button>
                                                <button type="submit" disabled="disabled" id="generate-btn" class="btn btn-info">Generate</button>
                                            </div>
                                            <div class="col-sm-3" >
                                            </div>
                                        </div>
                                    </div><!-- /.box-body -->
                                    <div class="box-footer">
                                    </div><!-- /.box-footer -->
                                </form>
                            </div><!-- /.box -->
                            <br><br><br><br>
                        </div>
                        <!-- EO : content  -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
<script type="text/javascript">
    function checkAllCheckbox()
    {
        $(".checked").each(function () {
            if ($("#checkAll").prop("checked") == true)
            {
                if ($(this).prop("checked") == false)
                {
                    $(this).click();
                }
                $("#generate-btn").removeAttr("disabled");
            } else
            {
                $(this).click();
                $("#generate-btn").attr("disabled", "disabled");
            }
        });
    }

    function setTitleRadio(field)
    {
        $("#selected_field_radio").val(field);
    }

    function setTitleCheck(field)
    {
        $("#selected_field_check").val(field);
    }

    function setTitle(field, from)
    {
        $("#selected_field").val(field);
    }

    function close_all()
    {
        var selected_radio = $("#selected_radio").val();
        $("#" + selected_radio).hide();
    }

    function add_more_radio(id)
    {
        var rad_id = $("#radio_id").val();
        var selected_radio = $("#selected_radio").val();
        var accet_url = $("#accet_url").val();
        var selected_field = $("#selected_field_radio").val();
        var x = document.getElementById(selected_radio).rows.length;
        x = x + 1;
        $("#" + id).append('<tr id="radio_row_' + x + '"><td><input value="Radio" type="text" name="' + selected_field + '[radios][]"></td><td><img src="' + accet_url + '/img/button-cross_basic_red.png" width="25px" onclick="del_ratio_row(\'radio_row_' + x + '\');"></td></tr>');
    }

    function del_ratio_row(id)
    {
        $("#" + id).remove();
    }

    function select_radio(id, num)
    {
        $("#"+id).closest("tr").find(".top-display").css("display", "none");
        $("#" + id).show();
        $("#selected_radio").val(id);
        $("#radio_id").val(num);
    }
    // checkbox js start

    function close_all_select()
    {
        var selected_check = $("#selected_check").val();
        $("#" + selected_check).hide();
    }

    function add_more_check(id)
    {
        var chk_id = $("#check_id").val();
        var selected_check = $("#selected_check").val();
        var accet_url = $("#accet_url").val();
        var selected_field = $("#selected_field_check").val();
        var x = document.getElementById(selected_check).rows.length;
        x = x + 1;
        $("#" + id).append('<tr id="check_row_' + x + '"><td><input value="Checkbox" type="text" name="' + selected_field + '[checks][]"></td><td><img src="' + accet_url + '/img/button-cross_basic_red.png" width="25px" onclick="del_check_row(\'check_row_' + x + '\');"></td></tr>');
    }

    function del_check_row(id)
    {
        $("#" + id).remove();
    }

    function select_check(id, num)
    {
        $("#"+id).closest("tr").find(".top-display").css("display", "none");
        $("#" + id).show();
        $("#selected_check").val(id);
        $("#check_id").val(num);
    }
    // checkbox js end

    function show_tables(id)
    {
        $("#"+id).closest("tr").find(".top-display").css("display", "none");
        table_name_new = $("#table_name_new").val();
        $("#"+id+" select option:contains('"+table_name_new+"')").attr("disabled","disabled");

        $("#" + id).show();
        $("#"+id+" select:first").change();
    }

    function show_key_value(dropdown_id, key_id, value_id, field, id)
    {
        var dropdown_tbl = $("#" + dropdown_id).val();
        $.ajax({
            url: '<?php echo url('/')."/generator/getKeyValue"; ?>',
            type: "post",
            data: "dropdown_tbl=" + dropdown_tbl + '&field=' + field + '&id=' + id+"&_token="+"{{ csrf_token() }}",
            beforeSend: function () {
            },
            success: function (result) {
                var arr = result.split("==##==");
                $('#' + key_id).css('display', 'block');
                $('#' + value_id).css('display', 'block');

                $("#" + key_id).html(arr[0]);
                $("#" + value_id).html(arr[1]);
            },
            error: function (output)
            {
            }
        });
    }

    function getField()
    {
        var tbl_name = $('#table_name_new').val();
        $.ajax({
            url: '<?php echo url('/') . "/generator/getFields"; ?>',
            type: "post",
            data: "tbl_name=" + tbl_name+"&_token="+"{{ csrf_token() }}",
            beforeSend: function () {
            },
            success: function (result) {
                $("#tbl_result").html(result);
                $(".chosen-select").chosen();
                // Input checked after select
                $("input.checked").on('click', function () {
                    if($("input.checked:checked").length>0){
                        $("#generate-btn").removeAttr("disabled");
                    } else{
                        $("#generate-btn").attr("disabled", "disabled");
                    }
                    if ($(this).prop("checked")) {
                        var temp = $(this).parent().parent();
                        temp.css("background-color", "#FFFFCC");
                        var temp1 = temp.find('.default_input');
                        temp1.click();
                    } else
                    {
                        var temp = $(this).parent().parent();
                        temp.css("background-color", "#fff");
                        var temp1 = temp.find('input[type=radio],input[type=checkbox]');
                        temp1.removeAttr("checked");
                    }
                });
                // ./ Input checked after select /.

                // On radio check select checkbox
                $("input[type=radio]").click(function () {
                    var check = $(this).parent().parent().find("input[type=checkbox]");
                    check.prop("checked", true);
                    var temp = $(this).parent().parent();
                    temp.css("background-color", "#FFFFCC");

                    if($("input.checked:checked").length>0){
                        $("#generate-btn").removeAttr("disabled");
                    } else{
                        $("#generate-btn").attr("disabled", "disabled");
                    }
                });
                // ./ On radio check select checkbox /.
            },
            error: function (output)
            {
            }
        });
    }
</script>
@endsection
