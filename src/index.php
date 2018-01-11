<?php
addProvider('BtyBugHook\Forms\Providers\ModuleServiceProvider');

function get_field_data_preview($data){
    switch ($data['data_source']){
        case "related" :
            if(isset($data['data_source_table_name']) && isset($data['data_source_columns'])){
                $table = $data['data_source_table_name'];
                $column = $data['data_source_columns'];
                if (\Schema::hasColumn($table, $column)) {
                    $result = \DB::table($table)->pluck($column,'id');
                    return (count($result)) ? $result->toArray() : [];
                }
            }
            break;
        case "manual" :
            if(isset($data['json_data_manual']) && $data['json_data_manual']){
                return (count(explode(',',$data['json_data_manual']))) ? explode(',',$data['json_data_manual']) : [];
            }
            break;
    }

    return [];
}