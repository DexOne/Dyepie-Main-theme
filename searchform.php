<?php
/**
 * Template for displaying search forms in dyepie
 *
 * @package dyepie
 * @subpackage search form
 * @since dyepie 1.0
 */
?>

<form class="col-md-12 row left_form" action="<?php echo home_url(); ?>" id="search-form" method="get">
    <input class="form-control col-md-10 form-control form_con" type="text" name="s" id="s" value="search .." onblur="if(this.value=='')this.value='search ..'" onfocus="if(this.value=='search ..')this.value=''"  autocomplete='off' />
    <button class="search_submit input-group-text btn_box col-md-2" id="submit basic-addon1" type="submit" value="go" >
        <i class="fas fa-search"></i>
    </button>
</form>

