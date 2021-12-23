<?php
namespace App\Core_modules\Developer_tool\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Schema;

class ToolController extends Controller
{
    // protected $module_path = public_path('gen-modules');
    protected $table_name = '';
    protected $prefix;
    protected $table_columns = NULL;
    // protected $module_path = 'gen-modules';
    protected $module_name;
    protected $languages = array();
    protected $discard = array();
    protected $model_directory = NULL;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = DB::select('SHOW TABLES');
        $db_name = 'Tables_in_'.config('database.connections.mysql.database');
        $page['title'] = "Generate Module";
        return view("Developer_tool::index",compact('tables','page','db_name'));
    }

    public function generate(Request $request)
    {

        $this->filelist = array();
        $this->prefix = trim($request->prefix);
        $table = $request->table_check;
        $this->table_name = preg_replace('/' . $this->prefix . '/', '', $table, 1);
        $this->table_columns = Schema::getColumnListing($table);
        $this->function_init = str_replace(' ', '', str_plural(ucfirst($this->table_name)));
        $this->table_key = str_singular(strtoupper($this->table_name));

        $controller = ucfirst(str_singular($this->table_name));
        // dd($controller);
        $primary_key = $this->_get_primary_key();

        $this->module_name = strtolower($controller);

        // dd($this->_generate_column_fields($this->table_columns, $primary_key));
        //
        $this->_create_directories();
        $this->_generate_model_file($this->module_name);
        $this->_generate_controller_file($this->module_name);
        $this->_generate_route_file($this->module_name);

        $view_array = array(
                            '{PHP_START}'             => '{{ ',
                            '{PHP_END}'               => '}}',
                            '{PREFIX}'                => $this->prefix,
                            '{VIEWTABLE}'             => $this->module_name,
                            '{TABLE_FIELDS}'          => $this->_generate_view_fields($this->table_columns),
                            '{PRIMARY_KEY}'           => $primary_key,
                            '{FORMFIELDS}'            => $this->_generate_form_fields($this->table_columns, $primary_key),
                            // '{SEARCH_FIELDS}'           => $this->_generate_search_fields($this->table_columns),
                            '{EDITFIELDS}'            => $this->_generate_form_fields($this->table_columns, $primary_key,true),
                            // '{VALIDATION_RULES}'      => $this->_generate_validation_rules($this->table_columns),
                            // '{DATAFIELDS}'            => $this->_generate_data_fields($this->table_columns),
                            '{COLUMN_FIELDS}'         => $this->_generate_column_fields($this->table_columns, $primary_key),
                            //{'UPLOAD_VIEW_FUNCTION}'    => $upload_view_function,
                            '{TABLE_NAME}'            => $table,
                            '{MODULE}'                => str_plural($this->module_name),
                            '{MODULE_NAME}'           => str_plural(ucfirst($this->module_name)),
                            '{MODULE_URL}'            => str_plural(ucfirst($this->module_name)),
                            '{BREADCRUMB}'            => str_plural($this->module_name),
                            '{MODULE_TITLE}'          => ucfirst($this->module_name),
                            '{MODULE_UCFIRST}'        => str_plural($this->module_name),
                        );

        $file_content = file_get_contents(public_path('templates/index.tpl'));
        foreach ($view_array as $key => $value) {
            $file_content = str_replace($key, $value, $file_content);
        }
        $view_index_data= $file_content;
        // dd($model_data);
        // dd($this->model_directory);
        $view_index_file = $this->view_directory .  'index.blade.php';
        $this->write_file($view_index_file,$view_index_data);

        $file_content = file_get_contents(public_path('templates/add.tpl'));
        foreach ($view_array as $key => $value) {
            $file_content = str_replace($key, $value, $file_content);
        }
        $view_add_data= $file_content;
        // dd($model_data);
        // dd($this->model_directory);
        $view_add_file = $this->view_directory .  'add.blade.php';
        $this->write_file($view_add_file,$view_add_data);

        $this->filelist[] = $view_add_file;


        $file_content = file_get_contents(public_path('templates/edit.tpl'));
        foreach ($view_array as $key => $value) {
            $file_content = str_replace($key, $value, $file_content);
        }
        $view_edit_data= $file_content;
        // dd($model_data);
        // dd($this->model_directory);
        $view_edit_file = $this->view_directory .  'edit.blade.php';
        $this->write_file($view_edit_file,$view_edit_data);

        $this->filelist[] = $view_edit_file;


        echo '<b>' . strtoupper($this->module_name) . '</b><ul><li>';
        echo implode('</li><li>', $this->filelist);
        echo '</li></ul>';
    }

    private function _create_directories()
    {
        $module_directory = public_path('gen-modules/'.str_singular($this->module_name));

        $dataArray = array(
                        'PHP_TAG' => '<?php',
                        'FILE' => ucfirst($this->module_name));
        @mkdir($module_directory); // Create Main Module Directory
        // dd($module_directory);

        // Create Controller Folder
        $this->controller_directory = $module_directory . '/Controllers/';
        @mkdir($this->controller_directory);

        // Create Models Folder
        $this->model_directory = $module_directory . '/Model/';
        @mkdir($this->model_directory);

        // Create Route Folder
        $this->route_directory = $module_directory . '/routes/';
        @mkdir($this->route_directory);

        // Create Models Folder
        $this->view_directory = $module_directory . '/Views/';
        @mkdir($this->view_directory);

    }

    private function _generate_model_file($file)
    {
        $model_data = '';
        $table_array =  array(
                            '{PHP_TAG}'       => '<?php',
                            '{MODEL}'         => ucfirst($file),
                            '{TABLE_KEY}'     => $this->table_key,
                            '{TABLE_NAME}'    => $this->table_name,
                            '{FUNCTION_INIT}' => $this->function_init,
                            '{PREFIX}'        => $this->prefix,
                            '{TABLE_ALIAS}'   => str_plural($this->table_name),
                            '{MODEL_NAME_UCFIRST}' => ucfirst(str_singular($this->module_name)),
                            '{MODEL_FORM_FIELD}'    => $this->_get_model_form_fields($this->table_columns),

                        );

        $file_content = file_get_contents(public_path('templates/model.tpl'));
        foreach ($table_array as $key => $value) {
            $file_content = str_replace($key, $value, $file_content);
        }
        $model_data= $file_content;
        // dd($model_data);
        // dd($this->model_directory);
        $model_file = $this->model_directory . ucfirst($file) . '.php';
        $this->write_file($model_file,$model_data);

        $this->filelist[] = $model_file;
    }

    private function _generate_route_file($file)
    {
        $route_array =  array(
                            '{PHP_TAG}'       => '<?php',
                            '{UCFIRST_MODULE_NAME}' => ucfirst($file),
                            '{MODULE_NAME}' => $this->module_name,
                            '{ADMIN_MODULE_CONTROLLER}' => 'Admin'.ucfirst(str_singular($this->table_name)).'Controller',
                            '{PUBLIC_MODULE_CONTROLLER}' => ucfirst(str_singular($this->table_name)).'Controller',
                            '{MODULE}' => str_plural($this->module_name),

                        );
        $file_content = file_get_contents(public_path('templates/route.tpl'));
        foreach ($route_array as $key => $value) {
            $file_content = str_replace($key, $value, $file_content);
        }
        $route_data= $file_content;
        $model_file = $this->route_directory . 'web.php';
        $this->write_file($model_file,$route_data);

        $this->filelist[] = $model_file;
    }



    private  function write_file($path, $data, $mode = 'wb')
    {
        if ( ! $fp = @fopen($path, $mode))
        {
            return FALSE;
        }

        flock($fp, LOCK_EX);

        for ($result = $written = 0, $length = strlen($data); $written < $length; $written += $result)
        {
            if (($result = fwrite($fp, substr($data, $written))) === FALSE)
            {
                break;
            }
        }

        flock($fp, LOCK_UN);
        fclose($fp);

        return is_int($result);
    }

    private function _get_model_form_fields($fields)
    {
        $str = '';
        foreach ($fields as $key => $value) {
            $str .= "'".$value."',";
        }
        return $str;
    }

    private function _generate_controller_file($file)
    {
        $upload_path = null;
        $upload_function = null;
        $primary_key      = $this->_get_primary_key();
        $controller       = ucfirst(str_singular($this->table_name));
        $admin_controller_name = 'Admin'.$controller.'Controller.php';
        $public_controller_name =  $controller.'Controller.php';
        $controller_array = array(
                                '{PHP_TAG}' => '<?php',
                                '{CONTROLLER}' => $controller,
                                '{MODULE}' => str_plural($this->module_name),
                                '{MODULE_NAME}' => $this->module_name,
                                '{MODULE_UCFIRST}' => ucfirst($file),
                                '{MODEL_NAME_UCFIRST}' => ucfirst($file),
                                '{MODEL_NAME}' => $file,
                                '{ADMIN_CONTROLLER_NAME_UCFIRST}' => 'Admin'.$controller.'Controller',
                                '{PRIMARY_KEY}' => $primary_key,
                                '{FOLDER}' => $file,
                                '{MODEL}' => $file . "_model",
                                '{TABLE_NAME}' => $this->function_init,
                                '{TABLE_ALIAS}'   => str_plural($this->table_name),
                                '{LANG}' => $file,
                                '{POSTED_DATA}' => $this->_generate_posted_data($this->table_columns),
                                '{TABLE_KEY}' => $this->table_key,
                                '{UPLOAD_PATH}' => $upload_path,
                                '{UPLOAD_FUNCTION}' => $upload_function,
                                '{CONTROLLER_NAME}' => ucfirst(str_plural($this->module_name)),
                                '{CONTROLLER_NAME_UCFIRST}' => $controller.'Controller',

                            );
        $file_content = file_get_contents(public_path('templates/admincontroller.tpl'));
        foreach ($controller_array as $key => $value) {
            $file_content = str_replace($key, $value, $file_content);
        }
        $admin_controller_data= $file_content;

        $file_content = file_get_contents(public_path('templates/controller.tpl'));
        foreach ($controller_array as $key => $value) {
            $file_content = str_replace($key, $value, $file_content);
        }
        $public_controller_data= $file_content;

        //$controller_file = $this->controller_admin_directory . $file . '.php';
        // $public_controller_file  = $this->controller_directory . $file . '.php';
        // write_file($public_controller_file, $public_controller_data);

        $admin_controller_file  = $this->controller_directory . $admin_controller_name;
        $this->write_file($admin_controller_file, $admin_controller_data);

        $public_controller_file  = $this->controller_directory . $public_controller_name;
        $this->write_file($public_controller_file, $public_controller_data);


        $this->filelist[] = $admin_controller_file;
        $this->filelist[] = $public_controller_file;
    }

    private function _get_primary_key()
    {
        return 'id';
    }

    private function _generate_posted_data($fields)
    {
        $cols = '';

        foreach($fields as $row) {
            if ($row == 'id')
                continue;

            $cols = $cols . "\t\t\$data['" . $row . "'] = \$request->" . $row . ";\r\n";
        }
        return $cols;
    }


    private function _generate_view_fields($fields)
    {
        $cols = '';

        foreach($fields as $row) {
            if ($row == 'id')
                continue;
            $cols = $cols . "<th >" .ucfirst($row) . "</th>\r\n";
        }

        return $cols;
    }

        private function _generate_search_fields($fields)
    {
        $cols='<tr>';
        $i=2;
        foreach($fields as $row):
            if($row->primary_key!='1' && !in_array($row,$this->discard))
            {

                if(!preg_match('/text/is',$row->type,$match) && !preg_match('/image/is',$row,$match))
                {
                    $cols=$cols."<td><label><?=lang('".$row."')?></label>:</td>\r\n";
                    if(preg_match('/date/',$row->type,$match)){
                        $cols=$cols."<td><input type=\"text\" name=\"date[".$row."][from]\" id=\"search_".$row."_from\"  class=\"easyui-datebox\"/> ~ <input type=\"text\" name=\"date[".$row."][to]\" id=\"search_".$row."_to\"  class=\"easyui-datebox\"/></td>\r\n";
                    }
                    else if(!preg_match('/tinyint/',$row->type,$match)){
                        $cols=$cols."<td><input type=\"text\" name=\"search[".$row."]\" id=\"search_".$row."\"  class=\"form-control\"/></td>\r\n";
                    }
                    else
                    {
                        $cols=$cols."<td><input type=\"radio\" name=\"search[".$row."]\" id=\"search_".$row."1\" value=\"1\"/><?=lang('general_yes')?>
                                <input type=\"radio\" name=\"search[".$row."]\" id=\"search_".$row."0\" value=\"0\"/><?=lang('general_no')?></td>\r\n";


                    }
                if(($i%4)==0)
                {
                    $cols=$cols."</tr>\r\n<tr>\r\n";
                }
                echo $i=$i+2;

                }
            }
        endforeach;
        $cols=$cols.'</tr>';
        return $cols;
    }


    private function _generate_form_fields($fields,$primary_key,$edit=false,$table="")
    {
        $cols='';

        foreach($fields as $row):
            if($row!=$primary_key):
                $param="";
                if($edit){
                    $param="$".$this->module_name."->%%FIELD%%";
                }
                $cols = $cols.'<div class="form-group">
                                    <label for="'.$row.'">'.ucfirst($row).'</label>';
                                if($edit)
                                    $field= '<input type="text" value = "{{'.$param.'}}"  name="%%FIELD%%" id="%%FIELD%%" class="form-control" >';
                                else
                                    $field= '<input type="text" name="%%FIELD%%" id="%%FIELD%%" class="form-control" >';
                                // </div>';
                                $cols.=$field;
                            $cols.='</div>';
                // $cols=$cols.'<div class="row clearfix">
                //         <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                //             <label for="'.$row.'">'.ucfirst($row).'</label>
                //         </div>
                //         <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                //             <div class="form-group">
                //                 <div class="form-line">';
                //                 if($edit)
                //                     $field= '<input type="text" value = "{{'.$param.'}}"  name="%%FIELD%%" id="%%FIELD%%" class="form-control" >';
                //                 else
                //                     $field= '<input type="text" name="%%FIELD%%" id="%%FIELD%%" class="form-control" >';
                //                    $cols.=$field;
                //             $cols.='</div>
                //         </div>
                //     </div>
                // </div><!-- close row clearfix -->
                // ';
                $cols=str_replace('%%FIELD%%',$row,$cols);

            endif;
        endforeach;
        if($edit){
            $param="$".$this->module_name."->".$primary_key;
            $cols=$cols."\r\n".'<input type="hidden" name="'.$primary_key.'" id="'.$primary_key.'" value = "{{'.$param.'}}" />';
        }
        else
        {
            $cols=$cols."\r\n".'<input type="hidden" name="'.$primary_key.'" id="'.$primary_key.'"/>';
        }

        return $cols;
    }


    private function _generate_column_fields($fields,$primary_key){
        $cols = '';
        $field = '';

        foreach ($fields as $row) {
            // if($row->name!=$primary_key){
            if($row != 'id'){
                $field = '{ data: "%%FIELD%%",name: "%%FIELD%%"},';

                // }
                $cols.=$field;

                $cols=str_replace('%%FIELD%%',$row,$cols);
            }

        }


        $cols .= '';
        return $cols;

    }


}
