<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">

                    <div class="panel_s">
                        <div class="panel-body">
                            <?php echo 'Welcome '.$company ?><br>
                            <div class="_filters _hidden_inputs hidden">
                                <?php
                                echo form_hidden('today');
                                echo form_hidden('yesterday');
                                echo form_hidden('month');
                                ?>
                            </div>

                            <div class="pull-right btn-group btn-with-tooltip-group _filter_data" data-toggle="tooltip" data-title="<?php echo _l('filter_by'); ?>">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-filter" aria-hidden="true"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-left filter-menu" style="width: 250px">
                                    <li>
                                        <a href="#" data-cview="today" onclick="dt_custom_view('today','.table-demo_staff','today'); return false;">
                                            <?php echo 'Ngày tạo hôm nay'; ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" data-cview="yesterday" onclick="dt_custom_view('yesterday','.table-demo_staff','yesterday'); return false;">
                                            <?php echo 'Ngày tạo hôm qua'; ?></a>
                                    </li>

                                    <li>
                                        <a href="#" data-cview="month" onclick="dt_custom_view('month','.table-demo_staff','month'); return false;">
                                            <?php echo 'Ngày tạo tháng nay'; ?>
                                        </a>
                                    </li>

                                </ul>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <select name="gender[]" id="gender" class="selectpicker" data-live-search="true"
                                            multiple="true" data-width="100%" data-none-selected-text="Lọc theo giới tính">
                                        <option value="1">Nam</option>
                                        <option value="2">Nữ</option>
                                    </select>
                                </div>
                            </div><br>
                            <?php render_datatable(array(
                                'Tên nhân viên',
                                'Ngày sinh',
                                'Giới tính',
                                'Ngày tạo',
                            ),'demo_staff'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
<script>
    $(function(){
        var FilterFunnelServerParams = {
            "gender": "[name='gender[]']",
        }
        $.each($('._hidden_inputs._filters input'), function() {
            FilterFunnelServerParams[$(this).attr('name')] = '[name="' + $(this).attr('name') + '"]';
        });
        initDataTable('.table-demo_staff', admin_url+'filter_interface/table', [], [],FilterFunnelServerParams);
    });

    $('select[name="gender[]"]').on('change', function() {
        $(".table-demo_staff").DataTable().ajax.reload();
    });
</script>

