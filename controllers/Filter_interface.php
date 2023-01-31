<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Filter_interface extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('filter_interface_model');
    }
    public function index()
    {
        $data['company']=$this->filter_interface_model->get();
        $this->load->view('filter_interface',$data);
    }
    public function table()
    {
        $select = [
            'name',
            'birthday',
            'gender',
            'dateadded'
        ];
        $where        = [];
        $aColumns     = $select;
        $sIndexColumn = 'id';
        $sTable       = db_prefix() . 'demo_staff';
        $join         = [];

        if ($this->input->post('gender')) {
            $genders  = $this->input->post('gender');
            $_genders = [];
            if (is_array($genders)) {
                foreach ($genders as $gender) {
                    if ($gender != '') {
                        array_push($_genders, $gender);
                    }
                }
            }
            if (count($_genders) > 0) {
                array_push($where, 'AND gender IN (' . implode(', ', $_genders) . ')');
            }
        }

        if($this->input->post('today')){
            $from_date = date("Y-m-d");
            $where[] = "AND date(dateadded) = date('$from_date')";
        }
        if($this->input->post('yesterday')){
            $from_date = date("Y-m-d", strtotime("-1 days"));
            $where[] = "AND date(dateadded) = date('$from_date')";
        }
        if($this->input->post('month')){
            $from_date = date("Y-m-d", strtotime("first day of this month"));
            $to_date = date("Y-m-d", strtotime("last day of this month"));
            $where[] = "AND date(dateadded) >= date('$from_date')";
            $where[] = "AND date(dateadded) <= date('$to_date')";
        }

        $result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, [
            'id',
            'name',
            'birthday',
            'gender',
            'dateadded'
        ]);

        $output  = $result['output'];
        $rResult = $result['rResult'];
        foreach ($rResult as $aRow) {
            $row = [];
            $row[] = $aRow['name'];
            $row[] = _d($aRow['birthday']);
            if($aRow['gender']==1){
                $row[] = "Nam";
            }else{
                $row[] = "Nữ";
            }
            $row[] = _d($aRow['dateadded']);
            $output['aaData'][] = $row;
        }
        echo json_encode($output);
        die();
    }

}