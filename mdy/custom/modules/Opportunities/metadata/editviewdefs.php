<?php
$viewdefs ['Opportunities'] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'custom/modules/Opportunities/edit_custom.js',
        ),
      ),
      'javascript' => '{$PROBABILITY_SCRIPT}',
      'useTabs' => true,
      'syncDetailEditViews' => false,
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'name',
          ),
          1 => 'account_name',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'date_closed',
          ),
          1 => 'sales_stage',
        ),
        2 => 
        array (
          0 => 'probability',
          1 => 
          array (
            'name' => 'tiempo_c',
            'label' => 'LBL_TIEMPO',
          ),
        ),
        3 => 
        array (
          0 => 'lead_source',
          1 => 
          array (
            'name' => 'causa_c',
            'label' => 'LBL_CAUSA',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'pais_c',
            'studio' => 'visible',
            'label' => 'LBL_PAIS',
          ),
          1 => 
          array (
            'name' => 'currency_id',
            'label' => 'LBL_CURRENCY',
          ),
        ),
        5 => 
        array (
          0 => '',
          1 => 
          array (
            'name' => 'amount',
          ),
        ),
        6 => 
        array (
          0 => 'description',
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'nestacionesint_c',
            'label' => 'LBL_NESTACIONESINT',
          ),
          1 => 
          array (
            'name' => 'nestacionesout_c',
            'label' => 'LBL_NESTACIONESOUT',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'provexterno_c',
            'studio' => 'visible',
            'label' => 'LBL_PROVEXTERNO',
          ),
          1 => '',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'necesidadesconin_c',
            'studio' => 'visible',
            'label' => 'LBL_NECESIDADESCONIN',
          ),
          1 => 
          array (
            'name' => 'solmdy_c',
            'studio' => 'visible',
            'label' => 'LBL_SOLMDY',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'propestajustada_c',
            'studio' => 'visible',
            'label' => 'LBL_PROPESTAJUSTADA',
          ),
          1 => '',
        ),
      ),
      'lbl_editview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'asistio_c',
            'studio' => 'visible',
            'label' => 'LBL_ASISTIO',
          ),
          1 => 
          array (
            'name' => 'razon_c',
            'studio' => 'visible',
            'label' => 'LBL_RAZON',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'nombrecliente_c',
            'label' => 'LBL_NOMBRECLIENTE',
          ),
          1 => 
          array (
            'name' => 'cargocliente_c',
            'label' => 'LBL_CARGOCLIENTE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'nombremdy_c',
            'label' => 'LBL_NOMBREMDY',
          ),
          1 => '',
        ),
      ),
      'LBL_PANEL_ASSIGNMENT' => 
      array (
        0 => 
        array (
          0 => 'assigned_user_name',
          1 => 
          array (
            'name' => 'team_name',
          ),
        ),
      ),
    ),
  ),
);
?>
