<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<head>

    <style>
        .pageNumber {
            position: relative;
            float: left;
            padding: 6px 12px;
            margin-left: -1px;
            line-height: 1.42857143;
            color: #000;
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #d2d6de;
            border-radius: 5px;
            margin-right: 5px;
        }

        button.active {
            color: #fff;
            cursor: default;
            background-color: #343a40;
            border-color: #343a40;
        }

        .users-list>li img {
            border-radius: 5%;
            max-width: 89%;
            height: auto;
        }
    </style>

</head>

<div class="content-wrapper">

    <?php 

        $data['data_breadcrumb'] = array();
        $data['data_breadcrumb'] = array(
        "Link" => 'Request_production',
        "Name" => 'ใบสั่งผลิต-ใบสั่งซ่อม',
        "Action" => 'หัวข้องาน'
    );

    $this->load->view('Tools/Breadcrumb-2',$data); 

    ?>

    <?php $this->load->view('Tools/Panel-message-1'); ?>

    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="ค้นหา" id="search_text">
                            </div>
                        </div>

                        <div class="col-md-3 col-xs-3 ">
                            <button type="button" class="btn btn-success btn-block" id="btn_add">
                                เพิ่มหัวข้องาน
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <input type="hidden" id="pageNumber" value="0">
                            <input type="hidden" id="usersPerPage" value="20">
                            <div class="table-responsive" style="font-size:14px;">
                                <table class="table table-hover" id="" show-filter="true">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center"> ID </th>
                                            <th class="text-left"> หัวข้องาน </th>
                                            <th class="text-left"> รายละเอียด </th>
                                            <th class="text-left"> เครื่องมือ </th>
                                        </tr>
                                    </thead>
                                    <tbody id="data_topic">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-left">

                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>

<div class="modal fade" id="addModal" role="dialog" data-toggle="modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header bg-success">
                <h4 class="modal-title ">เพิ่มหัวข้องาน</h4>
            </div>

            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> ชื่อหัวข้องาน <span class="badge badge-info right">1</span></label>
                                    <input type="text" class="form-control" id="add_field_topic"
                                        placeholder="กรุณากรอกข้อมูล ชื่อหัวข้องาน">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> รายละเอียด <span class="badge badge-info right">2</span></label>
                                    <input type="text" class="form-control" id="add_field_topic_description"
                                        placeholder="กรุณากรอกข้อมูล รายละเอียด">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="btn_add_submit">บันทึก</button>
                <button type="button" class="btn btn-light onclick=" javascript:clear_input_add()"
                    data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="editModal" role="dialog" data-toggle="modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header bg-warning">
                <h4 class="modal-title ">แก้ไขหัวข้องาน</h4>
            </div>
            <div class="modal-body">

                <input type="hidden" id=edit_field_id>

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> ชื่อหัวข้องาน <span class="badge badge-info right">1</span></label>
                                    <input type="text" class="form-control" id="edit_field_topic"
                                        placeholder="กรุณากรอกข้อมูล ชื่อหัวข้องาน">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>รายละเอียด <span class="badge badge-info right">2</span></label>
                                    <input type="text" class="form-control" id="edit_field_topic_description"
                                        placeholder="กรุณากรอกข้อมูล รายละเอียด">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" id="btn_edit_submit" class="btn btn-warning">บันทึก</button>
                <button type="button" class="btn btn-light" onclick="javascript:clear_input_edit()"
                    data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>