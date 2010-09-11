<?php

/** select_class.php
 * This class manage all html selects.
 * @author Vincent Audet Menard, Daniel Greenberg, Julien Jouvent Halle
 * @param String $case, String $default, String name
 * @version 10/10/2007
 */

class select_Class {

    var $name;
    var $case;
    var $on_change;
    var $default = Array();
    var $disabled = Array();
    var $str;
    var $size;
    var $multiple;

    function select_class($name, $case) {
        $this->name = $name;
        $this->case = $case;
    } // constructor

    function set_default($value = "---", $default = "---" ) {
        ($value=='')?($value='---'):($value);
        if ( $value != '---' && $default == '---' ) {
            $arr = $this->get_values();
            $default = $arr[$value];
        }
        $this->default[$value] = $default;
    }

    function set_disabled($value = "---", $default = "---" ) {
        $this->disabled[$value] = $default;
    }

    function set_on_change($script){
        $this->on_change = $script;
    }

    function set_multiple($bool = "true"){
        $this->multiple = $bool;
    }

    function set_size($size){
        if (is_numeric($size)) {
            $this->size = $size;
        } else {
            die('invalid call to set_size($int)');
        }
    }

    function get_html() {
        $str = '<select name="'.$this->name.'" id="'.$this->name.'" ';
        if ($this->on_change) {
            $str .= 'onchange="'.$this->on_change.'" ';
        }
        if ($this->size) {
            $str .= 'size="'.$this->size.'" ';
        }
        if ($this->multiple) {
            $str .= 'multiple ';
        }
        $str .= '>';
        if ( array_search('---',$this->default) ) {
            $str .= $this->make_option('---');
        }
        $str .= $this->add_options();
        $str .= '</select>';
        return $str;
    }

    function add_options() {
        $arr = $this->get_values(); 
        foreach ($arr as $value => $string ) 
            $str .= $this->make_option($value,$string);
        return $str;
    }

    function make_option( $value, $string = '' ) {
        ($string)?$string:($string = $value);
        ($this->default[$value] == $string )?($selected='selected="selected"'):($selected="");
        ($this->disabled[$value] == $string )?($disabled='disabled'):($disabled="");
        return '<option value="'.$value.'" '.$selected.' '.$disabled.' >'.$string.'</option>';
        //return '<option value="'.htmlentities($value).'" '.$selected.' >'.htmlentities($string).'</option>';
    }

    function get_values() {
        $arr = array();

        switch ($this->case) {
        case 'day':
            for ($i = 1; $i <= 31; $i++)
                ($i>=10)?($arr[$i]=$i):$arr['0'.$i]='0'.$i;
            break;

        case 'month':
            for ($i = 1; $i <= 12; $i++)
                ($i>=10)?($arr[$i]=$i):$arr['0'.$i]='0'.$i;
            break;	

        case 'year':
            for ($i = 2006; $i < (date("Y") + 1); $i++)
                $arr[$i]=$i;
            break;

        case 'year_future':
            for ($i = date("Y"); $i < (date("Y") + 4); $i++)
                $arr[$i]=$i;
            break;

        case 'year_long_future':
            for ($i = date("Y"); $i < (date("Y") + 11); $i++)
                $arr[$i]=$i;
            break;

        case 'year_long_past':
            for ($i = (date("Y")-1); $i > (date("Y") -110); $i--)
                $arr[$i]=$i;
            break;

        case 'gender':
            $arr = array("Homme", "Femme");	
            break;	

        case 'gender2':
            $arr = array("M.", "Mme.");
            break;

        case 'boolean_fr':
            $arr = array( "Oui", "Non");
            break;

        case 'boolean_en':
            $arr = array( "Yes", "No");
            break;
        }
        return $arr;
    }	
}
?>
