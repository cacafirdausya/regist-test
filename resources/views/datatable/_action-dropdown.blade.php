<div class="flex-container">
    @if (!empty($show_url_pdf))
        <div class="btn-wrapper">
            <a class="btn text-gray-600 p-0" style="text-decoration: none;" href="{{ $show_url_pdf }}">
                <i class="fa ri-file-line"></i>
            </a>
        </div>
    @endif

    @if (!empty($show_chart))
        <div class="btn-wrapper">
            <a class="btn text-gray-600 p-0 show-chart" style="text-decoration: none;" {!! $btn_matrix_attribute !!}>
                <i class="fa ri-file-chart-2-line"></i>
            </a>
        </div>
    @endif

    @if (!empty($drodown_action))
        <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="{{ $dropdown_id }}" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-600"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                aria-labelledby="{{ $dropdown_id }}">
                <div class="dropdown-header text-gray-600">Action:</div>
                @if (!empty($show_url_text_modal))
                    <a class="dropdown-item text-primary" onclick="{!! $show_url_text_modal !!}"><i
                            class="fa ri-edit-box-line mr-2 text-primary"
                            style="padding-right:10px !important;cursor: pointer;" data-toggle="tooltip"
                            title="Show Data" data-placement="top"></i>Show</a>
                @endif
                @if (!empty($show_url_text))
                    <a class="dropdown-item text-primary" href="{{ $show_url_text }}">
                        <i class="fa ri-edit-box-line mr-2 text-primary"
                            style="padding-right:10px !important;cursor: pointer;" data-toggle="tooltip"
                            title="Show Data" data-placement="top"></i>Show</a>
                @endif

                @if (!empty($form_text_url))
                    <a class="dropdown-item text-danger" onclick="{!! $form_text_url !!}">
                        <i class="fa ri-delete-bin-7-line mr-2 text-danger" style="padding-right:7px !important;"
                            title="Delete Data" data-placement="top"></i>Delete</a>
                @endif
            </div>
        </div>
    @endif

</div>

<style>
    .flex-container {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-wrapper {
        margin-right: 10px;
    }
</style>
